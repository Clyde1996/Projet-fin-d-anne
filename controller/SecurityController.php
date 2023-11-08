<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\ArticleManager;  // c'est lie avec le Article Manager dans le Model/managers
use Model\Managers\PostManager;    // c'est lie avec le Article Manager dans le Model/managers
use Model\Managers\UserManager;      // c'est lie avec le Article Manager dans le Model/managers
use Model\Managers\CategoryManager;  // c'est lie avec le Article Manager dans le Model/managers

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SecurityController extends AbstractController implements ControllerInterface{

    public function index(){
      header ("Location: index.php?ctrl=security&action=login");
    }

    

    public function registerForm(){
        return [
            "view"=> VIEW_DIR . "security/register.php"  // quand on click sur register form il nous retourne vers register ou on a notre formulaire de register 
        ];
    }

    public function register(){
        

        // si on clicl sur le submit dans le register php dans le formulaire ca va etre aplique le code 
        if($_POST["submit"]){

            $userManager = new UserManager(); 

            $session = new Session();

            // on filtre le formulaire dans le register.php contre les failles xss
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
            $email = filter_input(INPUT_POST, "email",  FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS); // le confirmation de password
        
            $usernameExist = $userManager->findUserByUsername($username);
            $emailExist = $userManager->findUserByEmail($email);

            if($username && $email && $pass1 && $pass2){
                if($usernameExist){ // si le username exist ca redrigie ver le forumalire de inscription et ca afiiche le message d'erreur
                    return [
                        "view" => VIEW_DIR."security/register.php",       // Rediriger vers le formulaire d'inscription 
                        $session->addFlash('error',"This username alredy exist") // Afficher un message d'erreur 
                    ];
                } elseif($emailExist){ // si le email exist ca redrigie ver le forumalire de inscription et ca afiiche le message d'erreur
                    return [
                        "view" => VIEW_DIR."security/register.php",       // Rediriger vers le formulaire d'inscription 
                        $session->addFlash('error',"This email alredy exist") // Afficher un message d'erreur 
                    ];
                }


                
                $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*.-]).{8,}$/";
                /* Je vérifie que le mot de passe est identique au second, qu'il contient au moins une Majuscule, minuscule, un chiffre, 
                un caractère spécial et qu'il est minimum 8 caractères (Regex) */
                if(($pass1 == $pass2 && preg_match($password_regex, $pass1))){  // on confirme que le $pass1 = $pass2, et le mot de passe ($pass1)  est egal ou superier a 8 caracteres
                    


                    //on selection le tableau user dans la base de donees que on puis ajouter un nuveau user 
                    $userManager->add([
                        'email' => $email,
                        'username' => $username,
                        'role' => json_encode(["ROLE_USER"]) , // par defaut ca s'ajouter un user apres on peut changer dans la base de donnes si on veut mettre admin
                        'password' => password_hash($pass1, PASSWORD_DEFAULT), // on hash le mot de passe avec son valeur = $pass1  et son filtre = PASSWORD_DEFAULT
                        
                    ]);

                    return [
                        "view" => VIEW_DIR."security/login.php",        // Rediriger vers le formulaire d'inscription 
                        $session->addFlash('success', "Added successfully") // Afficher un message d'erreu
                    ];
                }else {
                    return [
                        header("Location: index.php?ctrl=security&action=registerForm"),
                        Session::addFlash('error', "The password need a minimum of one uppercase, lowercase, digit, special character and a length of 8 characters")
                    ];
                }   
                
            }
        };
    }

    public function loginForm(){
        return [
            "view" => VIEW_DIR . "security/login.php"
        ];
    }

    public function login(){
        if($_POST["submit"]){
            $userManager = new UserManager(); // on se connecte dans la base de données
            $session = new Session(); // cette variable est pour afficher des messages
    
            // On filtre les entrées 
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $pass1 = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // on récupère l'email dans la base de données
            $user = $userManager->findUserByEmail($email);  
            

            if($user){
                /*on get le mot de pass de user*/ 
                $password = $user->getPassword();
                $checkPassword = password_verify($pass1, $password); // on vérifie que le $pass1 que vous avez écrit dans le formulaire correspond à celui de la BDD

                if ($user->getIsban() == 1) {
                    $session->addFlash('error', "Vous êtes banni. Vous ne pouvez pas vous connecter."); // Notification d'utilisateur banni
                    return [
                        "view" => VIEW_DIR . "security/login.php",
                    ];
                }


                if($checkPassword){
                    $session->setUser($user); 
                    $session->addFlash('success', "Connecté !"); // Notification de connexion
    
                    $this->redirectTo("home", "index", $session->getUser()->getId());
                } else {
                    $session->addFlash('error', "Mot de passe incorrect"); // Notification de mot de passe incorrect
                }
            } else {
                $session->addFlash('error', "Utilisateur inconnu"); // Notification d'utilisateur inconnu
            }

            

            
            
    
            return [
                "view" => VIEW_DIR . "security/login.php",
            ];
        }
    
        return [
            "view" => VIEW_DIR . "security/login.php",
        ];
    }


    public function logout() {
        $session = new Session();
        
        if ($session->getUser() //|| $session->isAdmin()
        ) {
            unset($_SESSION['user']); // Détruit la session

            return [
                "view" => VIEW_DIR."security/login.php",    // Renvoie vers le formulaire de connexion
                $session->addFlash('success', "Logged out successfully") // Notification 
            ];

        }
    }

    


    public function viewProfile($id){
        $userManager = new UserManager();

        return [
            "view" => VIEW_DIR . "security/viewProfile.php",
            "data" => [
                "user" => $userManager->findOneById($id)
            ]
        ];

    }

    /*Update Profile */
    public function updateProfile($id){
        $userManager = new UserManager();
        $session = new Session(); 

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       
    

        $userManager->updateProfile([
            'username' => $username,
            'email' => $email
        ]);

        return[
            "view" => VIEW_DIR . "security/viewProfile.php",
            $session->addFlash('success',"Le profil a été modifié avec succès."),
            "data" => [
                "user" => $userManager->findOneById($id)
            ]
        ];
    }

    /*Form User */
    public function formUpdateUser(){

        return[
            "view" => VIEW_DIR . "security/updateProfile.php"
        ];
    }

    public function resetPasswordForm() {
        return [
            "view" => VIEW_DIR . "security/resetPassword.php",
        ];
    }



    // public function resetPassword() {
    //     if ($_POST["submit"]) {
    //         $userManager = new UserManager(); // ou tout autre moyen d'accéder à la gestion des utilisateurs
    //         $session = new Session();
    
    //         // Récupérez l'adresse e-mail soumise dans le formulaire
    //         $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
    //         $mail = new PhpMailer();
    //         // Recherchez l'utilisateur avec l'e-mail fourni
    //         $user = $userManager->findUserByEmail($email);
    
    //         if ($user) {

    //             // Générez un jeton de réinitialisation de mot de passe
    //             // $resetToken = bin2hex(random_bytes(32)); // Générez un jeton aléatoire (on peut utiliser une autre méthode de génération)
    //             // $user->setResetToken($resetToken);
    //             // $user->setResetTokenExpiration(time() + 3600); // Expiration du jeton en 1 heure (on ajuste selon nos besoins)
    
    //             // // Sauvegardez le jeton et l'heure d'expiration dans la base de données (utilisez votre méthode de mise à jour)
    //             // $userManager->updateResetToken($user);
    
    //             // Envoyez un e-mail à l'utilisateur avec un lien contenant le jeton
    //             $resetLink ="http://localhost/klajdi_HAZIRAJ/wanderlust/Projet-fin-d-anne/index.php?ctrl=security&token=";
    
    //             // Envoi de l'e-mail
    //             $to = $user->getEmail(); // Adresse e-mail de l'utilisateur
    //             $subject = "Réinitialisation de mot de passe"; // Sujet de l'e-mail
    //             $message = "Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe : $resetLink"; // Message de l'e-mail
    
    //             $headers = "From: clyderadioo@gmail.com\r\n"; // Adresse e-mail de l'expéditeur
    
    //             if (mail($to, $subject, $message, $headers)) {
    //                 // L'e-mail a été envoyé avec succès
    //                 $session->addFlash('success', "Un e-mail a été envoyé avec le lien pour réinitialiser votre mot de passe.");
    //             } else {
    //                 // Une erreur s'est produite lors de l'envoi de l'e-mail
    //                 $session->addFlash('error', "Erreur lors de l'envoi de l'e-mail. Veuillez réessayer ultérieurement.");
    //             }
    //         } else {
    //             // L'adresse e-mail n'est pas associée à un utilisateur, affichez un message d'erreur
    //             $session->addFlash('error', "Aucun utilisateur n'a été trouvé avec cette adresse e-mail.");
    //         }
    //     }
    
    //     return [
    //         "view" => VIEW_DIR . "security/resetPassword.php",
    //     ];
    // }
    
    public function cgv(){                     

        return [                                                                
            "view" => VIEW_DIR."security/cgv.php",                           
        ];
    }


    // fonction pour changer le photo de profile
    public function updateProfileImage($id) {
        $userManager = new UserManager();
        $session = new Session();
       
        if (isset($_FILES['photo'])) {
           
         

            $tmpName = $_FILES['photo']['tmp_name'];
            $name = $_FILES['photo']['name'];
            $size = $_FILES['photo']['size'];
            $error = $_FILES['photo']['error'];
   
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
   
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];
            $maxSize = 7000000; // 7 Mo
   
            if ($size <= $maxSize) {
                if (in_array($extension, $extensions) && $error == 0) {
                    $uniqueName = uniqid('', true);
                    $file = $uniqueName . "." . $extension;
   
                    move_uploaded_file($tmpName, './public/img/' . $file);
   
                    $photo = $file;
   
                    // Mettez à jour l'image dans la base de données
                    $userManager->updateProfileImage($photo, $id);
                } else {
                    Session::addFlash("error", "Une erreur est survenue lors du téléchargement de l'image <br> Veuillez réessayer");
                    $this->redirectTo("photo", "remoteAddPhoto");
                }
            } else {
                Session::addFlash("error", "La taille de l'image est trop grande.");
                $this->redirectTo("photo", "remoteAddPhoto");
            }
        }
   
        return [
            "view" => VIEW_DIR . "security/viewProfile.php",

            "data" => [
                "user" => $userManager->findOneById($id),
            ],
           
        ];
        exit();
    }
    
    
    // fonction pour banir or unbanir les utilisateurs 
    public function banOrUnban($id) {
        $userManager = new UserManager();
        $session = new Session();
    
        if ($session->isAdmin()) {
            $user = $userManager->findOneById($id);
    
            if ($user->getIsban() == 0) {
                
                $userManager->banUser($id);
                // Redirect to the list of users
                header("Location: index.php?ctrl=home&action=index");
            }elseif($user->getIsban() == 1){
                $userManager->unbanUser($id);
                // Redirect to the list of users
                header("Location: index.php?ctrl=home&action=index");
            }

        }
    }
    

    // public function sendEmail() {
    //     // Créez une nouvelle instance de PHPMailer
    //     $mail = new PHPMailer();

    //     // Paramètres du serveur SMTP
    //     $mail->isSMTP();
    //     $mail->Host = 'smtp.gmail.com'; // Remplacez par le serveur SMTP de votre fournisseur de messagerie
    //     $mail->SMTPAuth = true;
    //     $mail->Username = 'clyderadioo@gmail.com'; // Remplacez par votre adresse e-mail
    //     $mail->Password = 'ybqgcwbmhkfhijcl'; // Remplacez par votre mot de passe
    //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Utilisez SSL ou TLS selon votre fournisseur
    //     $mail->Port = 587; // Port SMTP (consultez les paramètres de votre fournisseur)

    //     // Destinataire et expéditeur
    //     $mail->setFrom('votre_email@example.com', 'Votre Nom');
    //     $mail->addAddress('destinataire@example.com', 'Nom du Destinataire');

    //     // Contenu de l'e-mail
    //     $mail->isHTML(true);
    //     $mail->Subject = 'Sujet de l\'e-mail';
    //     $mail->Body = 'Contenu de l\'e-mail au format HTML';
    //     $mail->AltBody = 'Contenu de l\'e-mail en texte brut (pour les clients qui ne prennent pas en charge HTML)';

    //     // Envoyer l'e-mail
    //     if ($mail->send()) {
    //         echo 'E-mail envoyé avec succès.';
    //     } else {
    //         echo 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
    //     }
    // }
}    
?>
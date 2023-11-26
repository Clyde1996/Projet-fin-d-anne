<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\ArticleManager;  // c'est lie avec le Article Manager dans le Model/managers
use Model\Managers\PostManager;    // c'est lie avec le Article Manager dans le Model/managers
use Model\Managers\UserManager;      // c'est lie avec le Article Manager dans le Model/managers
use Model\Managers\CategoryManager;  // c'est lie avec le Article Manager dans le Model/managers
use Model\Managers\CommentManager;
use Model\Managers\FavorisManager;
use Model\Managers\TypeManager;
use Model\Managers\CollectionManager;
use Model\Managers\ImagesManager;
use PHPMailer\PHPMailerMaster\src\Exception;
use PHPMailer\PHPMailerMaster\src\PHPMailer;
use PHPMailer\PHPMailerMaster\src\SMTP; 

// use PHPMailer\PHPMailer\SMTP;

class SecurityController extends AbstractController implements ControllerInterface{

    public function index(){
      header ("Location: index.php?ctrl=security&action=login");
    }

    public function sendEmail(){
        if (isset($_POST["send"])) {
            $mail = new PHPMailer(true);
        
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'clyderadioo@gmail.com'; //gmail address
            $mail->Password = 'ybqgcwbmhkfhijcl'; // gmail password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
        
            
            $mail->setFrom('clyderadioo@gmail.com');    
        
            $mail->addAddress($_POST["email"]);
        
            $mail->isHTML(true);
        
            $mail->Subject = $_POST["subject"];
            $mail->Body = $_POST["message"];
        
            if ($mail->send()) {
                echo "
                <script>
                alert('Send Successfully');
                document.location.href = 'index.php'; // Corrected the typo here
                </script>";
            } else {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
    
    /*Contact Us*/ 
    
    public function contactUs(){
        return [
            "view"=> VIEW_DIR . "security/contactUs.php"  // quand on click sur register form il nous retourne vers register ou on a notre formulaire de register 
        ];
    }

    /*Register Form*/

    public function registerForm(){
        return [
            "view"=> VIEW_DIR . "security/register.php"  // quand on click sur register form il nous retourne vers register ou on a notre formulaire de register 
        ];
    }

    public function register(){
        $userManager = new UserManager(); 
        $session = new Session();
    
        // Vérifier si le formulaire a été soumis
        if(isset($_POST["submit"])){
    
            // Filtrer les données du formulaire
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
            $email = filter_input(INPUT_POST, "email",  FILTER_SANITIZE_EMAIL);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Vérifier si les champs requis sont renseignés
            if($username && $email && $pass1 && $pass2 && isset($_POST['accept-terms'])){
    
                // Vérifier si le nom d'utilisateur existe déjà
                $usernameExist = $userManager->findUserByUsername($username);
                if($usernameExist){
                    $session->addFlash('error', "This username already exists");
                    return ["view" => VIEW_DIR."security/register.php"];
                }
    
                // Vérifier si l'adresse e-mail existe déjà
                $emailExist = $userManager->findUserByEmail($email);
                if($emailExist){
                    $session->addFlash('error', "This email already exists");
                    return ["view" => VIEW_DIR."security/register.php"];
                }
    
                // Vérifier si les mots de passe correspondent et respectent les critères
                $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*.-]).{12,}$/";
                if($pass1 == $pass2 && preg_match($password_regex, $pass1)){
                    // Hasher le mot de passe
                    $hashedPassword = password_hash($pass1, PASSWORD_DEFAULT);
    
                    // Ajouter l'utilisateur à la base de données
                    $userManager->add([
                        'email' => $email,
                        'username' => $username,
                        'role' => json_encode(["ROLE_USER"]),
                        'password' => $hashedPassword,
                    ]);
    
                    $session->addFlash('success', "Registered successfully");
                    return ["view" => VIEW_DIR."security/login.php"];
                } else {
                    $session->addFlash('error', "The password needs at least one uppercase, lowercase, digit, special character, and a length of 8 characters");
                    return ["view" => VIEW_DIR."security/register.php"];
                }
            } else {
                // Un des champs de mot de passe est vide
                $session->addFlash('error', "Veuillez entrer les deux mots de passe");
                return ["view" => VIEW_DIR."security/register.php"];
            }
        }
    
        // Retourner la vue par défaut s'il y a des erreurs ou si le formulaire n'a pas été soumis
        return ["view" => VIEW_DIR."security/register.php"];
        
        exit;
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
        
        if ($session->getUser()) //|| $session->isAdmin()
        {
            unset($_SESSION['user']); // Détruit la session

            return [
                "view" => VIEW_DIR."security/login.php",    // Renvoie vers le formulaire de connexion
                $session->addFlash('success', "Logged out successfully") // Notification 
            ];

        }
    }

    


    public function viewProfile($id){

        $userManager = new UserManager();
        $session = new Session();

        // si le user est pas connecte rediriger vers le connexion
        if (!$session->getUser()) {
            // Rediriger vers la page de connexion
            header("Location: index.php?ctrl=security&action=loginForm");
            exit(); // Assurez-vous de quitter le script après la redirection
        }

        return [
            "view" => VIEW_DIR . "security/viewProfile.php",
            "data" => [
                "user" => $userManager->findOneById($id)
            ]
        ];

    }


   

    // Update Profile
    public function updateProfile(){
        $userManager = new UserManager();
        $session = new Session(); 
    
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        $userId = Session::getUser()->getId();
    
        // passwod regex
        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*.-]).{8,}$/";
    
        // On vérifie si un nouveau mot de passe est fourni
        if (!empty($newPassword)) {
            // si le mot de passe ne correspond pas a le password regex on affiche le message d'erreur
            if (!preg_match($password_regex, $newPassword)) {
                $session->addFlash('error', "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.");
                $this->redirectTo('security','formUpdateUser');
            }
    
            // On vérifie si le champ de confirmation du mot de passe correspond au nouveau mot de passe
            if ($newPassword !== $confirmPassword) {
                $session->addFlash('error', "Les mots de passe ne correspondent pas.");
                $this->redirectTo('security','formUpdateUser');
            }
    
            // Hasher le nouveau mot de passe
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
            // Mettre à jour le profil avec le nouveau mot de passe hashé
            $userManager->updateProfile($username, $email, $hashedPassword, $userId);
        } elseif (!empty($confirmPassword)) {
            // Si le champ de confirmation du mot de passe est fourni sans nouveau mot de passe
            $session->addFlash('error', "Veuillez fournir un nouveau mot de passe pour le changer.");
            $this->redirectTo('security','formUpdateUser');
        } else {
            // Si aucun nouveau mot de passe n'est fourni, mettre à jour le profil sans changer le mot de passe existant
            $userManager->updateProfileWithoutPassword($username, $email, $userId);
        }
    
        // Ajouter le message de succès
        $session->addFlash('success', "Le profil a été modifié avec succès.");
    
        // Rediriger vers la page de mise à jour du profil avec le message de succès
        $this->redirectTo('security','formUpdateUser');
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
    
    public function cgu(){                     

        return [                                                                
            "view" => VIEW_DIR."security/cgu.php",                           
        ];
    }


    // Fonction pour changer la photo de profil
    public function updateProfileImage($id) {
        $userManager = new UserManager();
        $session = new Session();
        
        // Vérifie si un fichier a été soumis via le formulaire
        if (isset($_FILES['photo'])) {
             // Récupère les informations sur le fichier
            $tmpName = $_FILES['photo']['tmp_name'];
            $name = $_FILES['photo']['name'];
            $size = $_FILES['photo']['size'];
            $error = $_FILES['photo']['error'];
            
            // Sépare le nom de fichier et son extension
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));
            
            // Définit les extensions de fichiers autorisées et la taille maximale du fichier
            $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif'];
            $maxSize = 5000000; // 5 Mo
            
            // Vérifie si la taille du fichier est inférieure ou égale à la taille maximale autorisée
            if ($size <= $maxSize) {
                // Vérifie si l'extension du fichier est autorisée et s'il n'y a pas d'erreur lors du téléchargement
                if (in_array($extension, $allowedExtensions) && $error == 0) {
                     // Génère un nom unique pour le fichier
                    $uniqueName = uniqid('', true);
                    $file = $uniqueName . "." . $extension;
    
                    // Validation du type de fichier en utilisant les types d'images autorisésr
                    $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];
                    $imageType = exif_imagetype($tmpName);
                    if (!in_array($imageType, $allowedTypes)) {
                        // Erreur si le type de fichier n'est pas autorisé
                        Session::addFlash("error", "Le type de fichier n'est pas autorisé.");
                        $this->redirectTo("photo", "remoteAddPhoto");
                    }
    
                    // Déplacement sécurisé du fichier vers le dossier de destination
                    $destinationPath = realpath('./public/img/') . '/' . $file;
                    if (move_uploaded_file($tmpName, $destinationPath)) {
                        // Mise à jour de l'image dans la base de données avec le nouveau nom de fichier
                        $photo = $file;
                        $userManager->updateProfileImage($photo, $id);
                    } else {
                          // Erreur en cas d'échec du téléchargement
                        Session::addFlash("error", "Une erreur est survenue lors du téléchargement de l'image.");
                        $this->redirectTo("photo", "remoteAddPhoto");
                    }
                } else {
                    // Erreur en cas d'extension non autorisée ou d'erreur lors du téléchargement
                    Session::addFlash("error", "Une erreur est survenue lors du téléchargement de l'image. Veuillez réessayer.");
                    $this->redirectTo("photo", "remoteAddPhoto");
                }
            } else {
                // Erreur si la taille du fichier dépasse la limite autorisée
                Session::addFlash("error", "La taille de l'image est trop grande.");
                $this->redirectTo("photo", "remoteAddPhoto");
            }
        }
        
        // Retourne les données pour afficher la vue du profil mis à jour
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
    

    // on supprimer l'account de user et tout ses commentaires et les articles
    public function deleteAccount($id){
        $userManager = new UserManager();
        $commentManager = new CommentManager();
        $articleManager = new ArticleManager();
        $favorisManager = new FavorisManager();
        $session = new Session();

      

        if ($session->getUser()) {

            $userManager->deleteAccount($id);
            $commentManager->deleteCommentsByUserId($id);
            $favorisManager->deleteFavorisByUserId($session->getUser()->getId());
            $articleManager->deleteArticlesByUserId($id);
            
            

            // on detruit le session avant la rideriction 

            $session->addFlash('success', "Votre Compte A ete supprimer avec succes !");
            session_destroy();

            // Rediriger vers la page de connexion
            header("Location: index.php?ctrl=security&action=loginForm");
            exit(); // Assurez-vous de quitter le script après la redirection

           
        }

        
        
    }

}    
?>
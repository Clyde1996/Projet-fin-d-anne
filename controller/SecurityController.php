<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\ArticleManager;  // c'est lie avec le Article Manager dans le Model/managers
use Model\Managers\PostManager;    // c'est lie avec le Article Manager dans le Model/managers
use Model\Managers\UserManager;      // c'est lie avec le Article Manager dans le Model/managers
use Model\Managers\CategoryManager;  // c'est lie avec le Article Manager dans le Model/managers

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


                

                if(($pass1 == $pass2) and strlen($pass1) >= 8){  // on confirme que le $pass1 = $pass2, et le mot de passe ($pass1)  est egal ou superier a 8 caracteres
                    


                    //on selection le tableau user dans la base de donees que on puis ajouter un nuveau user 
                    $userManager->add([
                        'email' => $email,
                        'username' => $username,
                        'role' => json_encode(["ROLE_USER"]) , // par defaut ca s'ajouter un user apres on peut changer dans la base de donnes si on veut mettre admin
                        'password' => password_hash($pass1, PASSWORD_DEFAULT) // on hash le mot de passe avec son valeur = $pass1  et son filtre = PASSWORD_DEFAULT
                    ]);

                    return [
                        "view" => VIEW_DIR."security/login.php",        // Rediriger vers le formulaire d'inscription 
                        $session->addFlash('success', "Ajouté avec succès") // Afficher un message d'erreu
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
                $password = $user->getPassword();
                $checkPassword = password_verify($pass1, $password); // on vérifie que le $pass1 que vous avez écrit dans le formulaire correspond à celui de la BDD
    
                if($checkPassword){
                    $session->setUser($user); 
                    $session->addFlash('success', "Connecté !"); // Notification de connexion
    
                    return [
                        "view" => VIEW_DIR . "home.php",
                    ];
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
                $session->addFlash('success', "Déconnecté avec succès") // Notification 
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

    

}    
?>
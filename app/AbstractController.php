<?php
    namespace App;

    abstract class AbstractController{

        // Fonction vide par défaut, elle sera éventuellement redéfinie dans les sous-classes

        public function index(){}

        // Fonction native du framework ! Cela signifie que cette fonction n'a pas été créée par nous, elle existe déjà en PHP.
        

        // Cette fonction nous redirige vers une autre page. 
        public function redirectTo($ctrl = null, $action = null, $id = null){

             // Vérifier si le contrôleur est différent de "home".
            if($ctrl != "home"){

                // Construire l'URL en ajoutant les parties spécifiées ($ctrl, $action et $id) dans l'ordre.
                // Les parties sont séparées par des "/". Par exemple : "/nomDuControleur/action/identifiant.html".

                $url = $ctrl ? "/".$ctrl : "";
                $url.= $action ? "/".$action : "";
                $url.= $id ? "/".$id : "";
                $url.= ".html";
            }
            // Si le contrôleur est "home", alors l'URL sera simplement "/".
            else $url = "/";
            // Rediriger l'utilisateur vers l'URL construite.
            header("Location: $url");
            die(); // Arrêter l'exécution du script après la redirection.

        }

        // Cette fonction restreint l'accès à certaines pages en fonction du rôle de l'utilisateur.
        public function restrictTo($role){

        // Vérifier si l'utilisateur n'est pas connecté (Session::getUser() renvoie null) 
        // ou s'il n'a pas le rôle spécifié ($role).
        // Si l'utilisateur n'est pas connecté ou n'a pas le rôle, le code à l'intérieur du "if" sera exécuté.
            
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){
                // Rediriger l'utilisateur vers la page de connexion en utilisant la fonction redirectTo().
                // L'utilisateur sera redirigé vers "/security/login.html".
                $this->redirectTo("security", "login");
            }
            // Si l'utilisateur est connecté et a le rôle spécifié, la fonction se termine ici sans rien faire d'autre.
            return;
        }

    }
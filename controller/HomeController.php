<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\ArticleManager;
    use Model\Managers\CommentManager;
    use Model\Managers\CategoryManager;  // c'est lie avec le Category dans le Model/managers
    use Model\Managers\ImagesManager; // c'est lie avec le  Images dans le Model/managers
    use Model\Managers\FavorisManager; // c'est lie avec le  Favoris dans le Model/managers
    
    
    class HomeController extends AbstractController implements ControllerInterface{

        public function index(){

            $categoryManager = new CategoryManager();
            $articleManager = new ArticleManager();

            return [
                "view" => VIEW_DIR."home.php",
                "data" => [
                    
                    "categories" => $categoryManager->findAll(["nom", "ASC"]),
                    "articles" => $articleManager ->findAll(["creationdate", "DESC"])
                ]
            ];

           
        }
            
        
   
        public function users(){
            $this->restrictTo("ROLE_USER");

            $manager = new UserManager();
            $users = $manager->findAll(['registerdate', 'DESC']); //registerdate

            return [
                "view" => VIEW_DIR."security/users.php",
                "data" => [
                    "users" => $users
                ]
            ];
        }

        public function forumRules(){
            
            return [
                "view" => VIEW_DIR."rules.php"
            ];
        }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/

        

        // public function homeCategories(){


        //     $categoryManager = new CategoryManager();

        //     $categoriesOrdered = $categoryManager->findAll(["nom", "ASC"]);
        //     return [
        //         "view" => VIEW_DIR."home.php",
        //         "data" => [
        //             "categories" => $categoriesOrdered
        //         ]
        //     ];
        // }
    }

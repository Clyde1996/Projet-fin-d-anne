<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\ArticleManager;  // c'est lie avec le Article Manager dans le Model/managers
    use Model\Managers\CommentManager;    // c'est lie avec le  Comment dans le Model/managers
    use Model\Managers\UserManager;      // c'est lie avec le  User dans le Model/managers
    use Model\Managers\CategoryManager;  // c'est lie avec le Category dans le Model/managers
    use Model\Managers\ImagesManager; // c'est lie avec le  Images dans le Model/managers
    use Model\Managers\FavorisManager; // c'est lie avec le  Favoris dans le Model/managers
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $articleManager = new ArticleManager();

            return [
                "view" => VIEW_DIR."forum/listArticles.php", //L'étiquette "view" est utilisée pour désigner le chemin de fichier
                "data" => [
                    "articles" => $articleManager->findAll(["creationdate", "DESC", "user", "title"])
                ]
            ];
        
        }


        /*List articles*/ 
        public function listArticles($id){

            // Demander l'accès à la couche modèle
            // Créer une nouvelle instance de articleManager 
            $articleManager = new ArticleManager();
            $categoryManager = new CategoryManager();

            
            // Renvoyer un tableau avec deux éléments
            // Le premier élément a pour clé "view" et contient le chemin du fichier à afficher
            // Le deuxième élément a pour clé "data" et contient la liste des sujets
            return [
                "view" => VIEW_DIR."forum/listarticles.php", 
                "data" => [                               
                    "articles" => $articleManager->findAll(),
                    "category" => $categoryManager->findOneByID($id)
                ]
                
                ];

        }

        /*Detail article*/

        public function detailArticle($id){

            // Demander l'accès à la couche modèle
            $articleManager = new ArticleManager();
            $commentManager = new CommentManager();
            $images = new ImagesManager();
            $user = new UserManager();
            

            return [
                "view" => VIEW_DIR."forum/detailarticle.php",
                "data" => [
                    "article"=>$articleManager->findOneById($id),
                    "comments" =>$commentManager->findCommentsByarticleId($id),
                    "images"=>$images->findImagesByArticleId($id),
                    "user"=>$user->findOneById($id)
                    
                ]
            ];

        }


        public function formArticle($id){

            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/addOrUpdateArticle.php",
                "data" => [
                    "category" => $categoryManager->findOneById($id)
                ]
            ];

        }



        public function addArticle($categoryId) {
            $articleManager = new ArticleManager();
            
        
            
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $userId = Session::getUser()->getId();
            // var_dump($title, $content, $categoryId, $userId);die;

        
         
            $articleId = $articleManager->add(['title' => $title, 'content'=> $content  , 'category_id' => $categoryId, 'user_id' => $userId]);
            
            $this->redirectTo("Forum", "detailArticle", $articleId);
        }

   


        public function deleteArticle($id){
            $articleManager = new ArticleManager();
            $session = new Session();    //pour ajouter une notification

            

            return[
                "view"=>VIEW_DIR."forum/listarticles.php",
                "data" => [
                    $session->addFlash('success',"Supprimé avec succès"),// Afficher la notification
                    $articleManager->delete($id),   // on a fait un requete pour delete sur manager et on peut utilise la 
                    // "categories" =>  $articleManager->findAll(["title", "ASC"]) // title c'est le nom dans la base de donees
                    "articles"=> $articleManager->findAll(["title", "ASC"])
                    
                ]
            ];

        }

   

        


        /*List Categories*/ 

        public function listCategories(){

            // Demander l'accès à la couche modèle
            // Créer une nouvelle instance de CategoryManager 
            $categoryManager = new CategoryManager();

            // Renvoyer un tableau avec deux éléments
            // Le premier élément a pour clé "view" et contient le chemin du fichier à afficher
            // Le deuxième élément a pour clé "data" et contient la liste des sujets

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAll()
                ]
            ];
        }

        public function detailCategory($id){   // le fonction fait le lien avec le view qui s'appelle detailCategory
            $categoryManager = new CategoryManager();
            $articleManager = new ArticleManager();
            $userManager = new UserManager();

            // $id = (filter_var($id, FILTER_VALIDATE_INT));  // Cette ligne de code vérifie si la variable $id est un entier valide en PHP. Si c'est le cas, la variable $id conserve sa valeur en tant qu'entier. Sinon, si $id n'est pas un entier valide, la variable $id est définie à false

            return [
                "view" => VIEW_DIR."forum/detailCategory.php",
                "data" => [
                    "category" => $categoryManager->findOneById($id),
                    "articles"=>$articleManager->findArticlesByCategoryId($id)
                ]
            ];
        }

        public function formCategory(){

            return[
                "view" => VIEW_DIR."forum/addOrUpdateCategory.php",
             
            ];
        }

        public function addCategory()  // Fonction pour ajouter une catégorie au form category 
        {
            $categoryManager = new CategoryManager();
            $session = new Session();  

            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // pour se proteger des hackeurs - des failles xss

            
            $categoryManager->add(['nom' => $nom]);
            return[
                "view" => VIEW_DIR."forum/listCategories.php",
                $session->addFlash('success',"Ajouté avec succès"), // Instancier pour ajouter une notification
                "data" => [
                    "categories" => $categoryManager->findAll(["nom", "ASC"])   // quand on ajoute un categorie sa retourne dans le liste des categories
                ]
               
            ];
            exit();
        }

        public function deleteCategory($id){
            $categoryManager = new CategoryManager();
            $session = new Session();    //pour ajouter une notification

            return[
                "view"=>VIEW_DIR."forum/listCategories.php",
                "data" => [
                    $session->addFlash('success',"Supprimé avec succès"),// Afficher la notification
                    $categoryManager->delete($id),
                    "categories" => $categoryManager->findAll(["nom", "ASC"])
                    
                ]
            ];

            exit(); // pour arreter l'execution du script 
        }

        public function updateCategory($id){
            $categoryManager = New CategoryManager();

        }

        


        /*List Users*/ 
        public function listUsers(){   // le function fait le lien avec le view qui s'appelle listUsers
            $userManager = new UserManager();

            return [
                "view" => VIEW_DIR."forum/listUsers.php",
                "data" => [
                    "users" => $userManager->findAll()
                ]
            ];
        }

        

        

        

   

        // add comment

        public function addComment($id){   // c'est le lien addComment que on a ajouter dans le listArticles 
            
            $commentManager = new CommentManager();
            $articleManager = new ArticleManager();
            $userManager = new UserManager();
            $session = new Session();
            
            date_default_timezone_set('Europe/Paris'); 
            $creationDate = date('Y-m-d H:i:s');
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){ 
                if(isset($_POST['text'])){
                    $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // flite qui protege contre les failles xss
                    $commentManager->add(['text'=> $text]);

                    return[
                        "view"=>VIEW_DIR."forum/detailArticle.php", // apres avoir ajouter le comment on returne dans le detailarticle
                        "data" => [
                            "comments"=> $commentManager->findAll(),
                            "article"=>$articleManager->findOneById($id)
                        ]
                    ];
                }

                $this->redirectTo("Forum", "detailArticle", $session->getArticle()->getId());
            } 
            
        }


         // Fonction pour supprimer une Catégorie 
        public function deleteComment($id){
            $commentManager = new CommentManager();
            $articleManager = new ArticleManager();

            $commentManager->delete($id);

          
        }

        // Fonction pour editer un article

        public function updateComment($id){
            $commentManager = new CommentManager();
            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_SPECIAL_CHARS);


            $commentManager->edit(['text' => $text], $id); // on edit le texte par $id
            

            // header("Location: index.php?ctrl=forum&action=listArticles"); // redirige vers un fois on fais la page on peut le rederiger
            exit();
        }

        // form pour ajouter le comment/ add comment 

        public function formComment(){ // c'est la form que on a cree dans le addOrUpdateComment, et ca s'appelle formComment!

            
            return[
                "view" => VIEW_DIR."forum/addcomment.php",
             
            ];
        }

        // form pour le modifier le comment / update comment
        public function updateFormComment($id){ // c'est la form que on a cree dans le addOrUpdateComment, et ca s'appelle formComment!
            $commentManager = new CommentManager();
            // $articleManager = new ArticleManager();

            return[
                "view" => VIEW_DIR."forum/updateComment.php",
                "data"=>['comment'=>$commentManager->findOneById($id)], 
             
            ];
        }



        

        public function addToFavoris($article) {
            $articleManager = new ArticleManager();
            $userManager = new UserManager();
            $categoryManager = new CategoryManager();
            $session = new Session();

            // Vérifiez si un utilisateur est connecté
            if ($session->getUser()->getId()) {
                $user = $session->getUser()->getId(); // Récupérez l'utilisateur à partir de la session
                
                $favorisManager = new FavorisManager();
        
                // Ajouter l'article aux favoris
                $favorisManager->insertIntoFavoris($article, $user);
        
                $this->redirectTo("Forum", "listFavoris", $session->getUser()->getId());
            } else {
                // L'utilisateur n'est pas connecté, gérez cette situation comme nécessaire
                return [
                    "error" => "L'utilisateur n'est pas connecté."
                ];
            }
        }

       


        public function listFavoris($id){

            $favorisManager = new FavorisManager;
            $articleManager = new ArticleManager();
            $userManager = new UserManager();
            $commentManager = new CommentManager();
            $session = new Session();


            if ($session->getUser()->getId()){
                $user = $session->getUser()->getId();
                return[
                    "view" => VIEW_DIR."forum/listFavoris.php",
                    "data"=>[
                        'favoris'=>$favorisManager->findArticlesFavorisByUserId( $session->getUser()->getId()),
                        'article'=>$articleManager->findOneByID($id)
                    ],
                ];
            }
            


        }

        

        

    }

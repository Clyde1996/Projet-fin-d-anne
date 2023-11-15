<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\FavorisManager;

    class FavorisManager extends Manager{ //la classe  favorisManager ca fait partie de Manager

        protected $className = "Model\Entities\Favoris";
        protected $tableName = "favoris";


        public function __construct(){
            parent::connect();
        }



        // on insert dans le table favoris le id de article et de user 
        public function insertIntoFavoris($article, $user) {
            $sql = "INSERT INTO favoris ( article_id, user_id) VALUES ( :article, :user)";
            
            $params = array(
                ':article' => $article,
                ':user' => $user
            );
        
            return DAO::insert($sql, $params);
        }
        
        public function deleteFavoris($article, $user) {
            $sql = "DELETE
            FROM
                favoris
            WHERE
                user_id = :user
                AND article_id = :article";
            
            $params = array(
                ':article' => $article,
                ':user' => $user
            );
        
            return DAO::insert($sql, $params);
        }

        public function deleteFavorisByUserId($user){
            $sql = "DELETE * 
            From
                favoris
            WHERE 
            user_id = :user";

            $params = array(
                ':article' => $article,
                ':user' => $user
            );

            return DAO::insert($sql, $params);
        }
     
        
        public function findArticlesFavorisByUserId($id){
            $sql = "SELECT 
            u.id_user,
            f.article_id,
            u.username,
            a.title
            FROM user u
            INNER JOIN favoris f ON u.id_user = f.user_id
            INNER JOIN article a ON a.id_article = f.article_id
            WHERE f.user_id = :id";

            return $this->getMultipleResults(
                        
            DAO::select($sql,[':id' => $id]),
            $this->className

            );
        }
        
    }
      
?>
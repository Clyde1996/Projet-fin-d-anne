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
        


        public function findArticlesFavorisByUserId($id){
            
            $sql = "SELECT *
            FROM ".$this->tableName." f 
            JOIN article AS a ON f.article_id = a.id_article
            JOIN user AS u ON f.user_id = u.id_user
            WHERE f.user_id = :id";
    
            return $this->getMultipleResults(
            
            DAO::select($sql,[':id' => $id]),
            $this->className

            );
        }
    
        
        
    }
      
?>
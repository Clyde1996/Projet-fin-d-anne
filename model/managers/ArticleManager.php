<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\ArticleManager;

    class ArticleManager extends Manager{ // La classe ArticleManager hérite de la classe Manager

        protected $className = "Model\Entities\Article"; // Définition de la classe des entités d'article
        protected $tableName = "article"; // Définition du nom de la table de la base de données pour les articles


        public function __construct(){
            parent::connect(); // ON appel du constructeur de la classe parente pour établir une connexion à la base de données
        }


        public function findarticlesByCategoryId($id){
            $sql = "SELECT *
            FROM ".$this->tableName." t
            WHERE t.category_id = :category";

            return $this->getMultipleResults(
            
            DAO::select($sql,[':category' => $id]),
            $this->className

            );
        }

        public function deleteArticlesByUserId($id){
            $sql = "DELETE FROM " . $this->tableName . " WHERE user_id = :id";
            $params = array(':id' => $id);
        
            return DAO::delete($sql, $params); 
        }
        

        public function findArticleByTypesId($id){
            $sql = "SELECT *
                    FROM article a 
                    INNER JOIN collection c ON a.id_article = c.article_id
                    INNER JOIN type t ON c.type_id = t.id_type
                    WHERE t.id_type = :id";
            
            return $this->getMultipleResults(
                DAO::select($sql, [':id' => $id]),
                $this->className
            );
        }
    

    }
?>
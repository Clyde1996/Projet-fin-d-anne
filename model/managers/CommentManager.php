<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\CommentManager;

    class CommentManager extends Manager{ //la commentManager  userManager ca fait partie de Manager

        protected $className = "Model\Entities\Comment";
        protected $tableName = "comment";


        public function __construct(){
            parent::connect();
        }

        public function findCommentsByarticleId($id){
            $sql = "SELECT *
            FROM ".$this->tableName." p
            WHERE p.article_id = :article";

            return $this->getMultipleResults(
            
            DAO::select($sql,[':article' => $id]),
            $this->className

            );
        }

        

        public function deleteCommentsByUserId($id){
            $sql = "DELETE FROM " . $this->tableName . " WHERE user_id = :id";
            $params = array(':id' => $id);
        
            return DAO::delete($sql, $params); 
        }

      

    }
?>
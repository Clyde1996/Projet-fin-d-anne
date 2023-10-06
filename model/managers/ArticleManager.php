<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\ArticleManager;

    class ArticleManager extends Manager{ //la classe  articleManager ca fait partie de Manager

        protected $className = "Model\Entities\Article";
        protected $tableName = "article";


        public function __construct(){
            parent::connect();
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
    }
?>
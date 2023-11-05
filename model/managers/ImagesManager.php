<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\ImagesManager;

    class ImagesManager extends Manager{ //la classe  ImagesManager ca fait partie de Manager

        protected $className = "Model\Entities\Images";
        protected $tableName = "images";


        public function __construct(){
            parent::connect();
        }



        public function findImagesByArticleId($id){
            $sql = "SELECT * FROM " . $this->tableName . " i INNER JOIN article a ON a.id_article = i.article_id 
            WHERE a.id_article = :id; ";
            
            return $this->getMultipleResults(
            
                DAO::select($sql,[':id' => $id]),
                $this->className
    
            );
        }

        // public function findarticlesByCategoryId($id){
        //     $sql = "SELECT *
        //     FROM ".$this->tableName." t
        //     WHERE t.category_id = :category";

        //     return $this->getMultipleResults(
            
        //     DAO::select($sql,[':category' => $id]),
        //     $this->className

        //     );
        // }


       

        
         

     

    
    }
?>
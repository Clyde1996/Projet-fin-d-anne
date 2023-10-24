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
            $sql = "SELECT * FROM" . $this->table . "i INNER JOIN article a  
            WHERE a.id_article = :id; ";
            
            return $this->getMultipleResults(
            
                DAO::select($sql,[':images' => $id]),
                $this->className
    
            );
        }

       

        
         

     

    
    }
?>
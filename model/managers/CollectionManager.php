<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\CollectionManager;
    

    class CollectionManager extends Manager{ //la classe  ImagesManager ca fait partie de Manager

        protected $className = "Model\Entities\Collection";
        protected $tableName = "collection";


        public function __construct(){
            parent::connect();
        }


        // public function findArticleByTypeID(){
        //     $sql = "SELECT * "
        // }

        
        // public function addArticleAndType(){
        //     $sql = "INSERT INTO"
        // }

       

    
    }
?>
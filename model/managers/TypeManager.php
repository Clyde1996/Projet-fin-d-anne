<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TypeManager;

    class TypeManager extends Manager{ //la classe  ImagesManager ca fait partie de Manager

        protected $className = "Model\Entities\Type";
        protected $tableName = "type";


        public function __construct(){
            parent::connect();
        }



        public function findTypesByArticleId($id){
            $sql = "SELECT *
            FROM ".$this->tableName." t
            INNER JOIN collection c ON c.type_id = t.id_type
            WHERE c.article_id = :article";

            return $this->getMultipleResults(
            
            DAO::select($sql,[':article' => $id]),
            $this->className

            );
        }
        

        public function findAllTypes(){
            $sql = "SELECT * FROM ".$this->tableName;
    
            return $this->getMultipleResults(
                DAO::select($sql),
                $this->className
            );
        }
        

        
         

     

    
    }
?>
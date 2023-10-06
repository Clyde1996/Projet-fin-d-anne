<?php
    namespace Model\Managers; // namespace 
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\CategoryManager;

    class CategoryManager extends Manager{ //la classe  CategoryManager ca fait partie de Manager

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";


        public function __construct(){
            parent::connect();
        }


    }
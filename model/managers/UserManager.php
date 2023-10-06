<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\UserManager;

    class UserManager extends Manager{ //la classe  userManager ca fait partie de Manager: ca veut dire il y a des functions que on a cree sur manager et ici on fait le lieson entre les deux pages et on peut utiliser les function dans View.

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }


    }
?>
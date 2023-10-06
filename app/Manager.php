<?php
    namespace App;

    abstract class Manager{

        protected function connect(){
            DAO::connect(); // connecter a la base do donees 
        }

        /**
         * get all the records of a table, sorted by optionnal field and order
         * 
         * @param array $order an array with field and order option
         * @return Collection a collection of objects hydrated by DAO, which are results of the request sent
         */
        public function findAll($order = null){

            $orderQuery = ($order) ?                 
                "ORDER BY ".$order[0]. " ".$order[1] :
                "";

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    ".$orderQuery;

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
       
        // function findOneById
        public function findOneById($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE a.id_".$this->tableName." = :id
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }

        //$data = ['username' => 'Squalli', 'password' => 'dfsyfshfbzeifbqefbq', 'email' => 'sql@gmail.com'];

        public function add($data){
            //$keys = ['username' , 'password', 'email']
            $keys = array_keys($data);
            //$values = ['Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com']
            $values = array_values($data);
            //"username,password,email"
            $sql = "INSERT INTO ".$this->tableName."
                    (".implode(',', $keys).") 
                    VALUES
                    ('".implode("','",$values)."')"; //La fonction implode est utilisée pour rassembler les éléments d'un tableau en une seule chaîne de caractères
                    //"'Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com'"
            /*
                INSERT INTO user (username,password,email) VALUES ('Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com') 
            */
            try{
                return DAO::insert($sql);
            }
            catch(\PDOException $e){
                echo $e->getMessage();
                die();
            }
        }
        
        // function delete
        public function delete($id){
            $sql = "DELETE FROM ".$this->tableName."
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::delete($sql, ['id' => $id]); 
        }

        // function update
        // public function edit($id){
        //     $sql = "Update" .$this->tableName."
        //     Set id_".$this->tableName." = :id
        //     ";
            
        // // }


// fonction pour modifier 
public function edit($data,$id= null){   // pas sur pour le $id = null 
    //$keys = ['username' , 'password', 'email']
    $keys = array_keys($data);
    //$values = ['Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com']
    $values = array_values($data);
    //"username,password,email"

    $sql = "UPDATE ".$this->tableName."
            SET  ".implode(',', $keys)."
            =
            '".implode("','",$values)."'
            WHERE id_".$this->tableName."= :id ";

            try{
                return DAO::update($sql,["id" => $id]);
            }
            catch(\PDOException $e){
                echo $e->getMessage();
                die();
            }
}

        // public function edit($data){
        //     //$keys = ['username' , 'password', 'email']
        //     $keys = array_keys($data);
        //     //$values = ['Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com']
        //     $values = array_values($data);
            
        //     //"username,password,email"
        //     $sql = "UPDATE ".$this->tableName."
        //          SET id_".$this->tableName." = :id
                    
        //             (".implode(',', $keys).") 
        //             VALUES
        //             ('".implode("','",$values)."')"; //La fonction implode est utilisée pour rassembler les éléments d'un tableau en une seule chaîne de caractères
        //             //"'Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com'"
        //     /*
        //         INSERT INTO user (username,password,email) VALUES ('Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com') 
        //     */
        //     try{
        //         return DAO::insert($sql);
        //     }
        //     catch(\PDOException $e){
        //         echo $e->getMessage();
        //         die();
        //     }
        // }



        

        private function generate($rows, $class){
            foreach($rows as $row){
                yield new $class($row);  // la fonction crée et renvoie des objets à partir des données du tableau, un à la fois, à l'aide du mot-clé yield. C'est utile lorsque vous avez beaucoup de données et que vous ne voulez pas toutes les traiter en même temps, mais seulement au fur et à mesure que vous en avez besoin.
            }
        }
        
        protected function getMultipleResults($rows, $class){

            if(is_iterable($rows)){
                return $this->generate($rows, $class);
            }
            else return null;
        }

        protected function getOneOrNullResult($row, $class){

            if($row != null){
                return new $class($row);
            }
            return false;
        }

        protected function getSingleScalarResult($row){

            if($row != null){
                $value = array_values($row);
                return $value[0];
            }
            return false;
        }


        public function findUserByUsername($username) {
            $sql = "SELECT *
                    FROM ".$this->tableName." u
                    WHERE u.username = :username";
                    
            return $this->getOneOrNullResult(DAO::select($sql, ['username' => $username], false), $this->className);
        }

        public function findUserByEmail($email) {
            $sql = "SELECT *
                    FROM ".$this->tableName." u
                    WHERE u.email = :email";
                    
            return $this->getOneOrNullResult(DAO::select($sql, ['email' => $email], false), $this->className);
        }
        

    
    }
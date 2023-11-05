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


        // public function updateProfile($id, $username, $email){
        //     $sql = "UPDATE user
        //     SET username = :username, email = :email
        //     WHERE id_user = :id_user  ";    

        //     return $this->execute($sql, [
        //         ':username' => $username,
        //         ':email' => $email,
        //         ':id_user' => $id
        //     ]);
        // }

      

        public function findArticlesFavorisByUserId($id){
            $sql = "SELECT 
            u.id_user,
            f.article_id,
            u.username,
            a.title
            FROM user u
            INNER JOIN favoris f ON u.id_user = f.user_id
            INNER JOIN article a ON a.id_article = f.article_id
            WHERE f.user_id = :id";

            return $this->getMultipleResults(
                        
            DAO::select($sql,[':id' => $id]),
            $this->className

            );
        }

        public function resetPassword($id) {
            $sql = "UPDATE " . $this->tableName . " SET password = :password WHERE email = :email"; // Ajout d'un point-virgule ici
        
            $params = [
                ':password' => $password,
                ':email' => $email
            ];
        
            return DAO::insert($sql, $params);
        }


        
        public function updateProfileImage($image, $id){
 
            $sql = "UPDATE ".$this->tableName." SET
                    image = :image
                    WHERE id_".$this->tableName." = :id
                    ";
 
            return DAO::update($sql, [':image' => $image, ':id' => $id]);
        }
         			         

    }


?>
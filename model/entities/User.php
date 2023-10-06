<?php
    namespace Model\Entities; // c'a permetre de appeler directement la calsse et pas le chemin fisique 

    use App\Entity; // comme demande un fischier qui est pas fisique 

    final class User extends Entity{ // entity pour la hidradation 
        // final class c'est la class final on peut pas faire le class qui extends article 

        private $id;
        private $email;
        private $role;
        private $username;
        private $password;
        private $dateInscription;

        public function __construct($data){         
                $this->hydrate($data);         // ca hydrate un un objet en recuperant les donnes dans la base de donnes 
                
            }


        public function getDateInscription()
        {
                return $this->dateInscription;
        }

        public function setDateInscription($dateInscription)
        {
                $this->dateInscription = $dateInscription;

                return $this;
        }

        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        public function getUsername()
        {
                return $this->username;
        }

        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
        }

        public function __toString(){

                $this->username = $username;
                return  $this;
        }

        public function hasRole($role) {
                if (isset($this->role)) {   // function pour le role de utilisateur
                        return in_array($role, json_decode($this->role));   // json_decode c'est pour instancer dans la base de donnes le role
                } else {
                        return false;
                }
        }

        public function getRole()
        {
                return $this->role;
        }

        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }
 
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }


        // public function setRole($role){

        //     // on indique ici que l'on va récuperer du Json que nous allons récuperer
        //     $this->role = json_decode($role);

        //     // si il n'y a pas de role attitré
        //     if(empty($this->$role)){

        //         // on attribut automaitquement le role User
        //         $this->role[]= "ROLE_USER";

        // }

       
    }
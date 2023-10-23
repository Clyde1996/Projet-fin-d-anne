<?php
    namespace Model\Entities; // c'a permetre de appeler directement la calsse et pas le chemin fisique 

    use App\Entity; // comme demande un fischier qui est pas fisique 

    final class Favoris extends Entity{ // entity pour la hidradation 
        // final class c'est la class final on peut pas faire le class qui extends article


        private $article;
        private $user;


        public function __construct($data){         
            $this->hydrate($data);         // ca hydrate un un objet en recuperant les donnes dans la base de donnes 
            
        }


      
        public function getArticle()
        {
                return $this->article;
        }

        public function setArticle($article)
        {
                $this->article = $article;

                return $this;
        }

        public function getUser()
        {
                return $this->user;
        }

        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }
    }

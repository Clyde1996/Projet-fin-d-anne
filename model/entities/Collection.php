<?php
    namespace Model\Entities; // c'a permetre de appeler directement la calsse et pas le chemin fisique 

    use App\Entity; // comme demande un fischier qui est pas fisique 

    final class Collection extends Entity{ // entity pour la hidradation 
        // final class c'est la class final on peut pas faire le class qui extends article

        private $article;
        private $type;



        public function __construct($data){         
            $this->hydrate($data);         // ca hydrate un un objet en recuperant les donnes dans la base de donnes 
            
        }


        public function getType()
        {
                return $this->type;
        }

        public function setType($type)
        {
                $this->type = $type;

                return $this;
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
    }

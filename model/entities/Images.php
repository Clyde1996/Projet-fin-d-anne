<?php
    namespace Model\Entities; // c'a permetre de appeler directement la calsse et pas le chemin fisique 

    use App\Entity; // comme demande un fischier qui est pas fisique 

    final class Images extends Entity{ // entity pour la hidradation 
        // final class c'est la class final on peut pas faire le class qui extends article

        private $id;
        private $article;
        private $url;
        private $description;


        public function __construct($data){         
            $this->hydrate($data);         // ca hydrate un un objet en recuperant les donnes dans la base de donnes 
            
        }

        

        public function getDescription()
        {
                return $this->description;
        }

        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }
 
        public function getUrl()
        {
                return $this->url;
        }

        public function setUrl($url)
        {
                $this->url = $url;

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

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }
    }

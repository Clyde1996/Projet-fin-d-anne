<?php
    namespace Model\Entities; // c'a permetre de appeler directement la calsse et pas le chemin fisique 

    use App\Entity; // comme demande un fischier qui est pas fisique 

    final class Comment extends Entity{ // entity pour la hidradation 
        // final class c'est la class final on peut pas faire le class qui extends article 

        private $id;
        private $article;
        private $user;
        private $text;
        private $creationDate;


        public function __construct($data){         
            $this->hydrate($data);         // ca hydrate un un objet en recuperant les donnes dans la base de donnes 
            
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

        public function getText()
        {
                return $this->text;
        }

        public function setText($text)
        {
                $this->text = $text;

                return $this;
        }

        // public function getCreationDate()
        // {
        //         $formattedDate = $this->creationdate->format("d/m/Y, H:i:s");
        //         return $formattedDate;
        // }

        public function getCreationdate()
        {       
                $creationdate = $this->creationdate->format("d/m/Y, H:i:s");

                return $creationdate;
                
        }

        public function setCreationDate($creationDate)
        {       
                
                $this->creationdate = new \DateTime($creationDate);

                return $this;
                
        }

        
    }

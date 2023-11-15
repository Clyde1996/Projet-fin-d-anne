<?php
    namespace Model\Entities; // c'a permetre de appeler directement la calsse et pas le chemin fisique 

    use App\Entity; // comme demande un fischier qui est pas fisique 

    final class Type extends Entity{ // entity pour la hidradation 
        // final class c'est la class final on peut pas faire le class qui extends article

        private $id;
        private $name;
        private $pictogram;


        public function __construct($data){         
            $this->hydrate($data);         // ca hydrate un un objet en recuperant les donnes dans la base de donnes 
            
        }

        

        public function getPictogram()
        {
                return $this->pictogram;
        }

        public function setPictogram($pictogram)
        {
                $this->pictogram = $pictogram;

                return $this;
        }

        public function getName()
        {
                return $this->name;
        }

        public function setName($name)
        {
                $this->name = $name;

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

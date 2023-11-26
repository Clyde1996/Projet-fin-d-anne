<?php
    namespace App;

    // Classe abstraite Entity
    abstract class Entity{

        // Méthode pour hydrater l'objet avec les données fournies
        protected function hydrate($data){

            foreach($data as $field => $value){


                //field = marque_id
                //fieldarray = ['marque','id']
                // Divise le nom du champ en utilisant le caractère "_" comme séparateur
                $fieldArray = explode("_", $field);

                // Vérifie si le champ fait référence à une relation avec une autre entité
                if(isset($fieldArray[1]) && $fieldArray[1] == "id"){
                    //On  Construit dynamiquement le nom de la classe du gestionnaire correspondant
                    $manName = ucfirst($fieldArray[0])."Manager";
                    $FQCName = "Model\Managers".DS.$manName;
                    
                    // Instancie la classe du gestionnaire et récupère l'objet associé à l'identifiant donné
                    $man = new $FQCName();
                    $value = $man->findOneById($value);
                }

                // Construction du nom de la méthode setter correspondante
                $method = "set".ucfirst($fieldArray[0]);
               
                // Vérifie si la méthode setter existe dans la classe courante
                if(method_exists($this, $method)){
                    // Appelle la méthode setter avec la valeur du champ
                    $this->$method($value);
                }

            }
        }

        // ON retourne le nom de la classe de l'objet
        public function getClass(){
            return get_class($this);
        }
    }
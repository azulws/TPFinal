<?php

    namespace DAO;

    use Models\Pet;
    use DAO\IPetDAO as IPetDAO;

    class PetDAO implements IPetDAO {
        private $fileName = ROOT . "/Data/pets.json";
        private $petList = array();

        public function Add(Pet $pet) {
            $this->RetrieveData();

            $pet->setId($this->GetNextId());
            $pet->setImage("");

            array_push($this->petList, $pet );
            
            $this->SaveData();
        }

        public function Remove($id) {
            $this->RetrieveData();

            $this->petList = array_filter($this->petList, function($pet) use($id) {
                return $pet->getId() != $id;
            });

            $this->SaveData();
        }

        public function GetAll() {
            $this->RetrieveData();

            return $this->petList;
        }

        public function GetAllByOwner($idOwner)
        {
            $this->RetrieveData();
            $pets = array_filter($this->petList, function($pet) use($idOwner) {
                return $pet->getOwner() == $idOwner;
            });

            $pets = array_values($pets);

            return $pets;
        }

        public function GetById($id) {
            $this->RetrieveData();

            $aux = array_filter($this->petList, function($pet) use($id) {
                return $pet->getId() == $id;
            });

            $aux = array_values($aux);

            return (count($aux) > 0) ? $aux[0] : array();
        }

        private function SaveData() {
            sort($this->petList);
            $arrayEncode = array();

            foreach($this->petList as $pet) {
                $value["id"] = $pet->getId();
                $value["name"] = $pet->getName();
                $value["owner"] = $pet->getOwner();
                $value["petType"] = $pet->getPetType()->getId();
                $value["description"] = $pet->getDescription();
                $value["image"] = $pet->getImage();

                array_push($arrayEncode, $value);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData() {
            $this->petList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayDecode as $value) {
                    $pet = new Pet();
                    $pet->setId($value["id"]);
                    $pet->setName($value["name"]);
                    $pet->setOwner($value["owner"]);
                    $pet->setDescription($value["description"]);
                    $pet->setImage($value["image"]);
                    
                    $petTypeDAO = new PetTypeDAO();
                    $petType = $petTypeDAO->Exist($value["petType"]);
                    $pet->setPetType($petType);

                    array_push($this->petList, $pet);
                }
            }
        }

        private function GetNextId() {
            $id = 0;
            foreach($this->petList as $pet) {
                $id = ($pet->getId() > $id) ? $pet->getId() : $id;
            }
            return $id + 1;
        }

        public function UploadImg()
        {
            $file_path= IMG_PATH . $_SESSION["loggedUser"]->getUserName().'/';

            if(!file_exists($file_path)){
                mkdir($file_path);
            }
            $file_name = $_FILES['petImg']['name'];
            $file_type = $_FILES['petImg']['type'];
            $file_size = $_FILES['petImg']['size'];
                
            
            if (!((strpos($file_type, "png") || strpos($file_type, "jpeg")) && ($file_size < 100000))) {
                echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
            }else{
                if (move_uploaded_file($_FILES['petImg']['tmp_name'], $file_path.$file_name)){
                        echo "El archivo ha sido cargado correctamente.";
                }else{
                        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                } 
        }

        $file = $file_path.$file_name;
        return $file;

        }

        public function Modify(Pet $modpet) {
            $this->RetrieveData();

            $this->petList = array_filter($this->petList, function($pet) use($modpet) {
                return $pet->getId() != $modpet->getId();
            });

            array_push($this->petList, $modpet);

            $this->SaveData();
        }
    }
    
?>
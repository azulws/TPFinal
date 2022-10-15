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

            array_push($this->petList, );
            
            $this->SaveData();
        }

        public function Remove($id) {
            $this->RetrieveData();

            $this->petList = array_filter($this->petList, function() use($id) {
                return $pet->getId() != $id;
            });

            $this->SaveData();
        }

        public function GetAll() {
            $this->RetrieveData();

            return $this->petList;
        }

        private function SaveData() {
            sort($this->petList);
            $arrayEncode = array();

            foreach($this->petList as $pet) {
                $value["id"] = $pet->getId();
                $value["name"] = $pet->getName();
                $value["idOwner"] = $pet->getIdOwner();
                $value["petType"] = $pet->getPetType()->getId();
                $value["description"] = $pet->getPrice();

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
                    $pet->setIdOwner($value["idOwner"]);
                    $pet->setDescription($value["description"]);
                    
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
    }
?>
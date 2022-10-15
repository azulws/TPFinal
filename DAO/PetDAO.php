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

        private function SaveData() {
            sort($this->petList);
            $arrayEncode = array();

            foreach($this->petList as $pet) {
                $value["id"] = $pet->getId();
                $value["name"] = $pet->getName();
                $value["owner"] = $pet->getOwner();
                $value["petType"] = $pet->getPetType()->getId();
                $value["description"] = $pet->getDescription();

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
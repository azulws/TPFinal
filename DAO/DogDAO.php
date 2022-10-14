<?php

    namespace DAO;

    use Models\Dog;

    class DogDAO implements IDogDAO {
        private $fileName = ROOT . "/Data/dogs.json";
        private $dogList = array();

        public function Add(Dog $dog) {
            $this->RetrieveData();

            $dog->setId($this->GetNextId());

            array_push($this->dogList, $dog);
            
            $this->SaveData();
        }

        public function Remove($id) {
            $this->RetrieveData();

            $this->dogList = array_filter($this->dogList, function($dog) use($id) {
                return $dog->getId() != $id;
            });

            $this->SaveData();
        }

        public function GetAll() {
            $this->RetrieveData();

            return $this->dogList;
        }

        private function SaveData() {
            sort($this->dogList);
            $arrayEncode = array();

            foreach($this->dogList as $dog) {
                $value["id"] = $dog->getId();
                $value["name"] = $dog->getName();
                $value["idOwner"] = $dog->getIdOwner();
                $value["dogType"] = $dog->getDogType()->getId();
                $value["description"] = $dog->getPrice();

                array_push($arrayEncode, $value);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData() {
            $this->dogList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayDecode as $value) {
                    $dog = new Dog();
                    $dog->setId($value["id"]);
                    $dog->setName($value["name"]);
                    $dog->setIdOwner($value["idOwner"]);
                    $dog->setDescription($value["description"]);
                    
                    $dogTypeDAO = new DogTypeDAO();
                    $dogType = $dogTypeDAO->Exist($value["dogType"]);
                    $dog->setDogType($dogType);

                    array_push($this->dogList, $dog);
                }
            }
        }

        private function GetNextId() {
            $id = 0;
            foreach($this->dogList as $dog) {
                $id = ($dog->getId() > $id) ? $dog->getId() : $id;
            }
            return $id + 1;
        }
    }
?>
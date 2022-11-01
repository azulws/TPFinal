<?php

    namespace DAO;

    use Models\PetType;
    use DAO\IPetTypeDAO as IPetTypeDAO;

    class JSONPetTypeDAO implements IPetTypeDAO {
        private $fileName = ROOT . "/Data/petTypes.json";
        private $petTypeList = array();

        public function Add(PetType $petType) {
            $this->RetrieveData();

            $petType->setId($this->GetNextId());

            array_push($this->petTypeList, $petType);

            $this->SaveData();
        }

        public function Remove($id) {
            $this->RetrieveData();

            $this->petTypeList = array_filter($this->petTypeList, function($petType) use($id) {
                return $petType->getId() != $id;
            });

            $this->SaveData();
        }

        public function GetAll() {
            $this->RetrieveData();
            return $this->petTypeList;
        }

        public function Exist($id) {
            $rta = null;
            $this->RetrieveData();

            foreach($this->petTypeList as $petType) {
                if($petType->getId() == $id) {
                    $rta = $petType;
                }
            }
            return $rta;
        }

        private function SaveData() {
            sort($this->petTypeList);
            $arrayEncode = array();

            foreach($this->petTypeList as $petType) {
                $value["id"] = $petType->getId();
                $value["breed"] = $petType->getBreed();
                $value["size"] = $petType->getSize();

                array_push($arrayEncode, $value);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData() {
            $this->petTypeList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayDecode as $value) {
                    $petType = new PetType();
                    $petType->setId($value["id"]);
                    $petType->setBreed($value["breed"]);
                    $petType->setSize($value["size"]);

                    array_push($this->petTypeList, $petType);
                }
            }
        }

        private function GetNextId() {
            $id = 0;

            foreach($this->petTypeList as $petType) {
                $id = ($petType->getId() > $id) ? $petType->getId() : $id;
            }

            return $id + 1;
        }
    }
?>
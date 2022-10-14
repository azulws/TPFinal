<?php

    namespace DAO;

    use Models\DogType;

    class DogTypeDAO implements IDogTypeDAO {
        private $fileName = ROOT . "/Data/dogTypes.json";
        private $dogTypeList = array();

        public function Add(DogType $dogType) {
            $this->RetrieveData();

            $dogType->setId($this->GetNextId());

            array_push($this->dogTypeList, $dogType);

            $this->SaveData();
        }

        public function Remove($id) {
            $this->RetrieveData();

            $this->dogTypeList = array_filter($this->dogTypeList, function($dogType) use($id) {
                return $dogType->getId() != $id;
            });

            $this->SaveData();
        }

        public function GetAll() {
            $this->RetrieveData();
            return $this->dogTypeList;
        }

        public function Exist($id) {
            $rta = null;
            $this->RetrieveData();

            foreach($this->dogTypeList as $dogType) {
                if($dogType->getId() == $id) {
                    $rta = $dogType;
                }
            }
            return $rta;
        }

        private function SaveData() {
            sort($this->dogTypeList);
            $arrayEncode = array();

            foreach($this->dogTypeList as $dogType) {
                $value["id"] = $dogType->getId();
                $value["breed"] = $dogType->getBreed();
                $value["size"] = $dogType->getSize();

                array_push($arrayEncode, $value);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData() {
            $this->dogTypeList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayDecode as $value) {
                    $dogType = new DogType();
                    $dogType->setId($value["id"]);
                    $dogType->setBreed($value["breed"]);
                    $dogType->setSize($value["size"]);

                    array_push($this->dogTypeList, $dogType);
                }
            }
        }

        private function GetNextId() {
            $id = 0;

            foreach($this->dogTypeList as $dogType) {
                $id = ($dogType->getId() > $id) ? $dogType->getId() : $id;
            }

            return $id + 1;
        }
    }
?>
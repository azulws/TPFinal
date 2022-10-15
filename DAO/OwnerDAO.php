<?php

    namespace DAO;

    use Models\Owner as Owner;
    use DAO\IOwnerDAO as IOwnerDAO;

    class OwnerDAO implements IOwnerDAO {
        private $fileName = ROOT . "/Data/owners.json";
        private $ownerList = array();

        public function Add(Owner $owner) {
            $this->RetrieveData();

            $owner->setIdOwner($this->GetNextId());

            array_push($this->ownerList, $owner);
            
            $this->SaveData();
        }

        public function Remove($id) {
            $this->RetrieveData();

            $this->ownerList = array_filter($this->ownerList, function($owner) use($id) {
                return $owner->getIdOwner() != $id;
            });

            $this->SaveData();
        }

        public function GetByUserName($userName) {
            $owner = null;
            $this->RetrieveData();

            $owners = array_filter($this->ownerList, function($owner) use ($userName) {
                return $owner->getUserName() == $userName;
            });

            $owners= array_values($owners);
            return (count($owners) > 0) ? $owners[0] : null;
        }
        
        public function GetAll() {
            $this->RetrieveData();

            return $this->ownerList;
        }

        private function SaveData() {
            sort($this->ownerList);
            $arrayEncode = array();

            foreach($this->ownerList as $owner) {
                $value["id"] = $owner->getIdOwner();
                $value["firstName"] = $owner->getFirstName();
                $value["lastName"] = $owner->getLastName();
                $value["userName"] = $owner->getUserName();
                $value["password"] = $owner->getPassword();

                array_push($arrayEncode, $value);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData() {
            $this->ownerList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayDecode as $value) {
                    $owner = new Owner();
                    $owner->setIdOwner($value["id"]);
                    $owner->setFirstName($value["firstName"]);
                    $owner->setLastName($value["lastName"]);
                    $owner->setUserName($value["userName"]);
                    $owner->setPassword($value["password"]);

                    array_push($this->ownerList, $owner);
                }
            }
        }

        private function GetNextId() {
            $id = 0;
            foreach($this->ownerList as $owner) {
                $id = ($owner->getIdOwner() > $id) ? $owner->getIdOwner() : $id;
            }
            return $id + 1;
        }
    }

    
?>
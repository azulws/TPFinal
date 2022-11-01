<?php

    namespace DAO;

    use Models\PetType;
    use DAO\IPetTypeDAO as IPetTypeDAO;
    use DAO\Connection as Connection;

    class PetTypeDAO implements IPetTypeDAO {
        private $connection;
        private $tableName = "PetType";

        public function Add(PetType $petType)
        {
            try{
                $query = "INSERT INTO ".$this->tableName." (id, size, breed) VALUES (:id, :size, :breed)";

                $parameters["id"] =  $pet->getId();
                $parameters["size"] = $pet->getSize();
                $parameters["breed"] = $pet->getBreed();
    

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove($id)
        {            
            try{
                $query = "DELETE FROM ".$this->tableName." WHERE (id = :id)";

                $parameters["id"] =  $id;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }  

        public function GetAll()
        {
            try{
                $petTypeList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $row)
                {
                    $petType = new PetType();
                    $petType->setId($row["id"]);
                    $petType->setSize($row["size"]);
                    $petType->setBreed($row["breed"]);

                    array_push($petTypeList, $petType);
                }

                return $petTypeList;
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function Exist($id) {
<<<<<<< HEAD
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
                $value["type"] = $petType->getType();
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
                    $petType->setType($value["type"]);
                    $petType->setSize($value["size"]);

                    array_push($this->petTypeList, $petType);
                }
=======
            try{
                $query = "SELECT * FROM ".$this->tableName ." WHERE(id==$id)";
                $petType= new PetType();
                $petType->setId($row["id"]);
                $petType->setSize($row["size"]);
                $petType->setBreed($row["breed"]);
                
                return $petType;
            }catch(Exception $ex){
                throw $ex;
>>>>>>> origin/base-de-datos
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
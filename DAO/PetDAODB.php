<?php

    namespace DAO;

    use Models\Pet;
    use DAO\IPetDAO as IPetDAO;
    use DAO\Conection as Conection;

    class PetDAODB implements IPetDAO {
        private $connection;
        private $tableName = "pets";

        public function Add(Pet $pet)
        {
            try{
                $query = "INSERT INTO ".$this->tableName." (id, name, Owner, petType, description, image, vaccination, video, size) VALUES (:id, :name, :Owner, :petType, :description, :image, :vaccination, :video, :size)";

                $parameters["id"] =  $pet->getId();
                $parameters["name"] = $pet->getName();
                $parameters["Owner"] = $pet->getOwner();
                $parameters["petType"] = $pet->getPetType();
                $parameters["description"] = $pet->getDescription();
                $parameters["image"] = $pet->getImage();
                $parameters["vaccination"] = $pet->setVaccination();
                $parameters["video"] = $pet->getVideo();
                $parameters["size"] = $pet->getSize();

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
                $petList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $row)
                {
                    $pet = new Pet();
                    $pet->setId($row["id"]);
                    $pet->setName($row["name"]);
                    $pet->setOwner($row["Owner"]);
                    $pet->setPetType($row["petType"]);
                    $pet->setDescription($row["description"]);
                    $pet->setImage($row["image"]);
                    $pet->setVaccination($row["vaccination"]);
                    $pet->setVideo($row["video"]);
                    $pet->setSize($row["size"]);

                    array_push($petList, $pet);
                }

                return $petList;
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAllByOwner($idOwner)
        {
            try{
                $pet = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE (idOwner = :idOwner)";

                $parameters["idOwner"] = $idOwner;

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, $parameters);

                foreach($results as $row)
                {
                    $pet = new Pet();
                    $pet->setId($row["id"]);
                    $pet->setName($row["name"]);
                    $pet->setOwner($row["Owner"]);
                    $pet->setPetType($row["petType"]);
                    $pet->setDescription($row["description"]);
                    $pet->setImage($row["image"]);
                    $pet->setVaccination($row["vaccination"]);
                    $pet->setVideo($row["video"]);
                    $pet->setSize($row["size"]);
                }

                return $pet;
            }catch(Exception $ex){
                throw $ex;
            }
        } 
        
        public function GetById($id)
        {
            try{
                $pet = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE (id = :id)";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, $parameters);

                foreach($results as $row)
                {
                    $pet = new Pet();
                    $pet->setId($row["id"]);
                    $pet->setName($row["name"]);
                    $pet->setOwner($row["Owner"]);
                    $pet->setPetType($row["petType"]);
                    $pet->setDescription($row["description"]);
                    $pet->setImage($row["image"]);
                    $pet->setVaccination($row["vaccination"]);
                    $pet->setVideo($row["video"]);
                    $pet->setSize($row["size"]);
                }

                return $user;
            }catch(Exception $ex){
                throw $ex;
            }
        } 

        public function Modify(Pet $modpet) {
            $this->RetrieveData();

            $this->petList = array_filter($this->petList, function($pet) use($modpet) {
                return $pet->getId() != $modpet->getId();
            });

            array_push($this->petList, $modpet);

            $this->SaveData();
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
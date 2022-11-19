<?php

    namespace DAO;

    use Models\Pet;
    use DAO\IPetDAO as IPetDAO;
    use DAO\Conection as Conection;

    class PetDAO implements IPetDAO {
        private $connection;
        private $tableName = "pet";

        public function Add(Pet $pet)
        {
            try{
                $query = "INSERT INTO ".$this->tableName." (id, name, idOwner, idPetType, description, petsize, image, vaccination, video) VALUES (:id, :name, :idOwner, :idPetType, :description,:petsize, :image, :vaccination, :video)";

                $pet->setImage("");
                $pet->setVaccination("");
                $pet->setVideo("");
                $parameters["id"] =  $pet->getId();
                $parameters["name"] = $pet->getName();
                $parameters["idOwner"] = $pet->getOwner()->getIdOwner();
                $parameters["idPetType"] = $pet->getPetType()->getId();
                $parameters["description"] = $pet->getDescription();
                $parameters["petsize"] = $pet->getSize();
                $parameters["image"] = $pet->getImage();
                $parameters["vaccination"] = $pet->getVaccination();
                $parameters["video"] = $pet->getVideo();

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

                    $ownerDAO = new OwnerDAO();
                    $owner = $ownerDAO->GetById($row["idOwner"]);
                    $pet->setOwner($owner);

                    $petTypeDAO = new PetTypeDAO();
                    $petType = $petTypeDAO->GetById($row["idPetType"]);
                    $pet->setPetType($petType);

                    $pet->setDescription($row["description"]);
                    $pet->setImage($row["image"]);
                    $pet->setVaccination($row["vaccination"]);
                    $pet->setVideo($row["video"]);
                    $pet->setSize($row["petsize"]);

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
                $petList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE (idOwner = :idOwner)";

                $parameters["idOwner"] = $idOwner;

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, $parameters);

                foreach($results as $row)
                {
                    $pet = new Pet();
                    $pet->setId($row["id"]);
                    $pet->setName($row["name"]);

                    $ownerDAO = new OwnerDAO();
                    $owner = $ownerDAO->GetById($row["idOwner"]);
                    $pet->setOwner($owner);

                    $petTypeDAO = new PetTypeDAO();
                    $petType = $petTypeDAO->Exist($row["idPetType"]);
                    $pet->setPetType($petType);

                    $pet->setDescription($row["description"]);
                    $pet->setImage($row["image"]);
                    $pet->setVaccination($row["vaccination"]);
                    $pet->setVideo($row["video"]);
                    $pet->setSize($row["petsize"]);

                    array_push($petList, $pet);              
                }

                return $petList;
            }catch(Exception $ex){
                throw $ex;
            }
        } 
        
        public function GetById($id)
        {
            $query = "select * from ". $this->tableName . "            
            WHERE id = '$id'";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 
                if(!empty($resultSet)){
                    $pet = new Pet();
                    $pet->setId($resultSet[0]["id"]);                   
                    $pet->setName($resultSet[0]["name"]);

                    $ownerDAO = new OwnerDAO();
                    $owner = $ownerDAO->GetById($resultSet[0]["idOwner"]);
                    $pet->setOwner($owner);

                    $petTypeDAO = new PetTypeDAO();
                    $petType = $petTypeDAO->Exist($resultSet[0]["idPetType"]);
                    $pet->setPetType($petType);

                    $pet->setDescription($resultSet[0]["description"]);
                    $pet->setImage($resultSet[0]["image"]);
                    $pet->setVaccination($resultSet[0]["vaccination"]);
                    $pet->setVideo($resultSet[0]["video"]);
                    $pet->setSize($resultSet[0]["petsize"]);
                    return $pet;                       
                
            }
            }
            catch(Exception $ex){
                throw $ex;
            }           
            
    
    }

        public function Modify(Pet $modpet) {
            try{
                $query = "UPDATE ".$this->tableName." SET  name = :name, description= :description, petsize= :petsize, image = :image,vaccination = :vaccination, video= :video where id = :id;" ;

                $parameters["id"] =  $modpet->getId();
                $parameters["name"] = $modpet->getName();
                $parameters["description"] = $modpet->getDescription();
                $parameters["petsize"] = $modpet->getSize();
                $parameters["image"] = $modpet->getImage();
                $parameters["vaccination"] = $modpet->getVaccination();
                $parameters["video"] = $modpet->getVideo();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }




    }
    
?>
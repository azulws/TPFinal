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
                $query = "INSERT INTO ".$this->tableName." (id, breed) VALUES (:id, :breed)";

                $parameters["id"] =  $pet->getId();
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
                    $petType->setBreed($row["breed"]);

                    array_push($petTypeList, $petType);
                }

                return $petTypeList;
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function Exist($id) {

                $query = "select * from ". $this->tableName . "            
                WHERE id = '$id'";
                    
                try{
                        $this->connection = Connection::GetInstance();
                        $resultSet = $this->connection->Execute($query); 
                        if(!empty($resultSet)){
                            $petType = new PetType();
                            $petType->setId($resultSet[0]["id"]);                   
                            $petType->setBreed($resultSet[0]["breed"]);
                            return $petType;                       
                        
                }
                }
                catch(Exception $ex){
                        throw $ex;
                }           
                    
            
            }
        
        }


    
?>
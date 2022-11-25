<?php
namespace DAO;

use Models\Owner as Owner;
use DAO\IOwnerDAO as IOwnerDAO;
use \Exception as Exception;
use DAO\Connection as Connection;

class OwnerDAO implements IOwnerDAO
{
    private $connection;
    private $tableName = "owner";

    public function Add(Owner $owner)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (firstName, lastName, userName,email, userPassword) VALUES (:firstName, :lastName, :userName, :email, :userPassword);";
                
                $parameters["firstName"] = $owner->getFirstName();
                $parameters["lastName"] = $owner->getLastName();
                $parameters["userName"] = $owner->getUserName();
                $parameters["email"] = $owner->getEmail();

                $parameters["userPassword"] = $owner->getPassword();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $ownerList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $owner = new Owner();
                    $owner->setIdOwner($row["idOwner"]);
                    $owner->setFirstName($row["firstName"]);
                    $owner->setLastName($row["lastName"]);
                    $owner->setUserName($row["userName"]);
                    $owner->setEmail($row["email"]);
                    $owner->setPassword($row["userPassword"]);

                    array_push($ownerList, $owner);
                }

                return $ownerList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Remove($id)
        {
            try
            {
                $query = "DELETE * FROM ".$this->tableName."WHERE id =". $id. ";";
                
                $this->connection = Connection::GetInstance();

                $this->connection->Execute($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByUserName($userName)
        {
            $query = "select * from ". $this->tableName . "            
            WHERE userName = '$userName'";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 
                if(!empty($resultSet)){
                    $owner = new Owner();
                    $owner->setIdOwner($resultSet[0]["idOwner"]);                   
                    $owner->setFirstName($resultSet[0]["firstName"]);
                    $owner->setLastName($resultSet[0]["lastName"]);
                    $owner->setUserName($resultSet[0]["userName"]);
                    $owner->setEmail($resultSet[0]["email"]);

                    $owner->setPassword($resultSet[0]["userPassword"]);
                    return $owner;                       
                
            }
            }
            catch(Exception $ex){
                throw $ex;
            }           
            
    
    }

    public function GetByEmail($email)
    {
        $query = "select * from ". $this->tableName . "            
        WHERE email = '$email'";
        
        try{
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query); 
            if(!empty($resultSet)){
                $owner = new Owner();
                $owner->setIdOwner($resultSet[0]["idOwner"]);                   
                $owner->setFirstName($resultSet[0]["firstName"]);
                $owner->setLastName($resultSet[0]["lastName"]);
                $owner->setUserName($resultSet[0]["userName"]);
                $owner->setEmail($resultSet[0]["email"]);

                $owner->setPassword($resultSet[0]["userPassword"]);
                return $owner;                       
            
        }
        }
        catch(Exception $ex){
            throw $ex;
        }           
        

}

    public function GetById($id)
        {
            $query = "select * from ". $this->tableName . "            
            WHERE idOwner = '$id'";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 
                if(!empty($resultSet)){
                    $owner = new Owner();
                    $owner->setIdOwner($resultSet[0]["idOwner"]);                   
                    $owner->setFirstName($resultSet[0]["firstName"]);
                    $owner->setLastName($resultSet[0]["lastName"]);
                    $owner->setUserName($resultSet[0]["userName"]);
                    $owner->setEmail($resultSet[0]["email"]);
                    $owner->setPassword($resultSet[0]["userPassword"]);
                    return $owner;                       
                
            }
            }
            catch(Exception $ex){
                throw $ex;
            }           
            
    
    }

}

    
?>
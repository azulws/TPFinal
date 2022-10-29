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
                $query = "INSERT INTO ".$this->tableName." (firstName, lastName, userName, userPassword) VALUES (:firstName, :lastName, :userName, :userPassword);";
                
                $parameters["firstName"] = $owner->getFirstName();
                $parameters["lastName"] = $owner->getLastName();
                $parameters["userName"] = $owner->getUserName();
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
            $ownerList = $this->GetAll();

            $owners = array_filter($ownerList, function($owner) use ($userName) {
                return $owner->getUserName() == $userName;
            });

            $owners= array_values($owners);
            return (count($owners) > 0) ? $owners[0] : null;
        }
        
        




}


?>
<?php
namespace DAO;

use Models\Keeper as Keeper;
use DAO\IKeeperDAO as IKeeperDAO;
use \Exception as Exception;
use DAO\Connection as Connection;

class KeeperDAO implements IKeeper
{
    private $connection;
    private $tableName = "keeper";

    public function Add(Keeper $keeper)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (firstName, lastName, userName, userPassword) VALUES (:firstName, :lastName, :userName, :userPassword);";
        
                $parameters["firstName"] = $keeper->getFirstName();
                $parameters["lastName"] = $keeper->getLastName();
                $parameters["userName"] = $keeper->getUserName();
                $parameters["userPassword"] = $keeper->getPassword();
            

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
                $keeperList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $keeper = new Keeper();
                    $keeper->setIdkeeper($row["idKeeper"]);
                    $keeper->setFirstName($row["firstName"]);
                    $keeper->setLastName($row["lastName"]);
                    $keeper->setUserName($row["userName"]);
                    $keeper->setPassword($row["userPassword"]);
                    $keeper->setRemuneration($resultSet[0]["remuneration"]);
                    $keeper->setReputation($resultSet[0]["reputation"]);
                    $keeper->setAvailability($this->GetAvailabilityById($row["idKeeper"]));
                    $keeper->setSizes($this->GetSizesById($row["idKeeper"]));

                    array_push($keeperList, $keeper);
                }

                return $keeperList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function setAvailability(keeper $keeper){

            $this->RemoveAvailabilityById($keeper->getIdKeeper());
            $dateList = $keeper->getAvailability();

            try{
            foreach($dateList as $date){
                $query = "insert into availability(fecha, idKeeper)
                values(:fecha , :idKeeper)"; 
        
                $parameters["fecha"] = $date;
                $parameters["idKeeper"] = $keeper->getIdKeeper();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        private function RemoveAvailabilityById($idKeeper){
            try
            {
                $query = "delete  from availability          
                WHERE idKeeper = '$idKeeper'";
                
                $this->connection = Connection::GetInstance();

                $this->connection->Execute($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        public function SetSizes(keeper $keeper){

            $this->RemoveSizesById($keeper->getIdKeeper());
            $sizesList = $keeper->getSizes();

            try{
            foreach($sizesList as $size){
                $query = "insert into size_x_keeper(idPetSize, idKeeper)
                values(:idPetSize , :idKeeper)"; 
        
                if($size == "SMALL"){
                    $parameters["idPetSize"]= 1;
                }else if($size == "MEDIUM"){
                    $parameters["idPetSize"]= 2;
                }else{
                    $parameters["idPetSize"]= 3;
                }
                $parameters["idKeeper"] = $keeper->getIdKeeper();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        private function RemoveSizesById($idKeeper){
            try
            {
                $query = "delete  from size_x_keeper 
                WHERE idKeeper = '$idKeeper'";
                
                $this->connection = Connection::GetInstance();

                $this->connection->Execute($query);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

        }

        

        private function GetAvailabilityById($idKeeper){

            try
            {
                $dateList = array();

                $query = "select fecha from availability          
                WHERE idKeeper = '$idKeeper' ORDER BY fecha";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    array_push($dateList, $row["fecha"]);
                }

                return $dateList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        private function GetSizesById($idKeeper){

            try
            {
                $sizeList = array();

                $query = "select petsize 
                from petsize ps
                join size_x_keeper sk on ps.id = sk.idPetSize
                WHERE idKeeper = '$idKeeper'";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    array_push($sizeList, $row["petsize"]);
                }

                return $sizeList;
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
                    $keeper = new Keeper();
                    $keeper->setIdKeeper($resultSet[0]["idKeeper"]);                   
                    $keeper->setFirstName($resultSet[0]["firstName"]);
                    $keeper->setLastName($resultSet[0]["lastName"]);
                    $keeper->setPassword($resultSet[0]["userPassword"]);
                    $keeper->setRemuneration($resultSet[0]["remuneration"]);
                    $keeper->setReputation($resultSet[0]["reputation"]);
                    $keeper->setAvailability($this->GetAvailabilityById($resultSet[0]["idKeeper"]));
                    $keeper->setSizes($this->GetSizesById($resultSet[0]["idKeeper"]));
                    return $keeper;                       
                
            }
            }
            catch(Exception $ex){
                throw $ex;
            }           
            
    
    }

    public function GetById($id)
        {
            $query = "select * from ". $this->tableName . "            
            WHERE idkeeper = '$id'";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 
                if(!empty($resultSet)){
                    $keeper = new Keeper();
                    $keeper->setIdKeeper($resultSet[0]["idKeeper"]);                   
                    $keeper->setFirstName($resultSet[0]["firstName"]);
                    $keeper->setLastName($resultSet[0]["lastName"]);
                    $keeper->setUserName($resultSet[0]["userName"]);
                    $keeper->setPassword($resultSet[0]["userPassword"]);
                    $keeper->setRemuneration($resultSet[0]["remuneration"]);
                    $keeper->setReputation($resultSet[0]["reputation"]);
                    $keeper->setAvailability($this->GetAvailabilityById($resultSet[0]["idKeeper"]));
                    $keeper->setSizes($this->GetSizesById($resultSet[0]["idKeeper"]));
                    return $keeper;                       
                
            }
            }
            catch(Exception $ex){
                throw $ex;
            }           
            
    
    }

    public function Modify(Keeper $keeper) {
        try{
            $query = "UPDATE ".$this->tableName." SET  firstName = :firstName, lastName = :lastName, userName = :userName, userPassword = :userPassword ,remuneration = :remuneration, reputation= :reputation where idKeeper = :idKeeper;" ;

            $parameters["idKeeper"] =  $keeper->getIdKeeper();
            $parameters["firstName"] = $keeper->getFirstName();
            $parameters["lastName"] = $keeper->getLastName();
            $parameters["userName"] = $keeper->getUserName();
            $parameters["userPassword"] = $keeper->getPassword();
            $parameters["remuneration"] = $keeper->getRemuneration();
            $parameters["reputation"] = $keeper->getReputation();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }catch(Exception $ex){
            throw $ex;
        }
    }


}

    
?>
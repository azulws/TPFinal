<?php

    namespace DAO;

    use Models\Reservation;
    use DAO\IReservationDAO as IReservationDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\PetDAO as PetDAO;
    use Models\eState;
    use DAO\QueryType as QueryType;

    class ReservationDAO implements IReservationDAO {
        private $connection;
        private $tableName = "reservation";

        public function Add(reservation $reservation) {
            $query = "CALL reservation_Add(:idKeeper,:idPet,:startDate,:endDate,:price)";
            
            try{    
                $parameters["idKeeper"] = $reservation->getKeeper()->getIdKeeper();
                $parameters["idPet"] = $reservation->getPet()->getId();
                $parameters["startDate"] = $reservation->getStartDate();
                $parameters["endDate"] = $reservation->getEndDate();
                $parameters["price"] = $reservation->getPrice();
                
                $this->connection = Connection::GetInstance();

                $resultSet= $this->connection->Execute($query, $parameters);

                if(!empty($resultSet)){
                    $id=$resultSet[0]["last_insert_id()"];
                    return $id;
                }
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove($id) {
            $query = "DELETE FROM ".$this->tableName." WHERE (id = :id)";

            try{
                $parameters["id"] =  $id;
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll() {
            $query = "SELECT r.id,r.idKeeper,r.idPet,r.startDate,r.endDate,r.idState,r.price,s.state FROM ".$this->tableName." r 
            INNER JOIN state s on r.idState=s.id";

            try{
                $reservationList = array();

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $row)
                {
                    $reservation = new Reservation();
                    $reservation->setId($row["id"]);

                    $keeperDAO= new KeeperDAO();
                    $keeper= $keeperDAO->GetById($row["idKeeper"]);
                    $reservation->setKeeper($keeper);

                    $petDAO= new PetDAO();
                    $pet= $petDAO->GetById($row["idPet"]);
                    $reservation->setPet($pet);

                    $reservation->setStartDate($row["startDate"]);
                    $reservation->setEndDate($row["endDate"]);
                    $reservation->setState($row["state"]);
                    $reservation->setPrice($row["price"]);

                    array_push($reservationList, $reservation);
                }

                return $reservationList;
            }catch(Exception $ex){
                throw $ex;
            }
        }

        
        public function Modify(reservation $modreservation) {
            $query = "UPDATE ".$this->tableName." SET  startDate = :startDate, endDate= :endDate, idState= :idState, price = :price where id = :id;" ;
            
            try{
                $parameters["id"] =  $modreservation->getId();
                $parameters["startDate"] = $modreservation->getStartDate();
                $parameters["endDate"] = $modreservation->getEndDate();
                if($modreservation->getState() == "PENDING"){
                    $parameters["idState"]=1;
                }else if($modreservation->getState() == "CANCELED"){
                    $parameters["idState"]=2;
                }else{
                    $parameters["idState"]=3;
                }
                $parameters["price"] = $modreservation->getPrice();
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }
        
        public function GetAllByOwner($idOwner)
        {
            $query = "SELECT r.id,r.idKeeper,r.idPet,r.startDate,r.endDate,r.idState,r.price,s.state FROM ".$this->tableName." r
            JOIN pet on pet.id=r.idPet JOIN state s on s.id=r.idState WHERE pet.idOwner = :idOwner";
            
            try{
                $reservationList = array();

                $parameters["idOwner"] = $idOwner;

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, $parameters);

                foreach($results as $row)
                {
                    $reservation = new Reservation();
                    $reservation->setId($row["id"]);

                    $keeperDAO = new KeeperDAO();
                    $keeper = $keeperDAO->GetById($row["idKeeper"]);
                    $reservation->setKeeper($keeper);

                    $petDAO = new PetDAO();
                    $pet = $petDAO->GetById($row["idPet"]);
                    $reservation->setPet($pet);

                    $reservation->setStartDate($row["startDate"]);
                    $reservation->setEndDate($row["endDate"]);
                    $reservation->setState($row["state"]);
                    $reservation->setPrice($row["price"]);

                    array_push($reservationList, $reservation);              
                }

                return $reservationList;
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAllByKeeper($idKeeper)
        {
            $query = "SELECT r.id,r.idKeeper,r.idPet,r.startDate,r.endDate,r.idState,r.price,s.state FROM ".$this->tableName." r
            JOIN pet on pet.id=r.idPet JOIN owner on pet.idOwner=owner.idOwner JOIN state s on s.id=r.idState WHERE r.idKeeper = :idKeeper";
            try{
                $reservationList = array();
    
                $parameters["idKeeper"] = $idKeeper;

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, $parameters);

                foreach($results as $row)
                {
                    $reservation = new Reservation();
                    $reservation->setId($row["id"]);

                    $keeperDAO= new KeeperDAO();
                    $keeper= $keeperDAO->GetById($row["idKeeper"]);
                    $reservation->setKeeper($keeper);

                    $petDAO= new PetDAO();
                    $pet= $petDAO->GetById($row["idPet"]);
                    $reservation->setPet($pet);

                    $reservation->setStartDate($row["startDate"]);
                    $reservation->setEndDate($row["endDate"]);
                    $reservation->setState($row["state"]);
                    $reservation->setPrice($row["price"]);
                    
                    array_push($reservationList, $reservation);           
                }

                return $reservationList;
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetById($id) {
            $query = "select r.id,r.idKeeper,r.idPet,r.startDate,r.endDate,r.idState,r.price,s.state from ". $this->tableName ." r
            INNER JOIN state s on r.idState=s.id WHERE r.id = '$id'";
            
            try{
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query); 
                if(!empty($resultSet)){
                    $reservation = new Reservation();
                    $reservation->setId($resultSet[0]["id"]);                   

                    $keeperDAO = new KeeperDAO();
                    $keeper = $keeperDAO->GetById($resultSet[0]["idKeeper"]);
                    $reservation->setKeeper($keeper);

                    $petDAO = new PetDAO();
                    $pet = $petDAO->GetById($resultSet[0]["idPet"]);
                    $reservation->setPet($pet);

                    $reservation->setStartDate($resultSet[0]["startDate"]);
                    $reservation->setEndDate($resultSet[0]["endDate"]);
                    $reservation->setState($resultSet[0]["state"]);
                    $reservation->setPrice($resultSet[0]["price"]);
                    return $reservation;                       
                
                }
            }
            catch(Exception $ex){
                throw $ex;
            }           
        }

    }
    
?>
<?php

    namespace DAO;

    use Models\Reservation;
    use DAO\IReservationDAO as IReservationDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\PetDAO as PetDAO;
    use Models\eState;

    class ReservationDAO implements IReservationDAO {
        private $connection;
        private $tableName = "reservation";

        public function Add(reservation $reservation) {
            try{
                $query = "INSERT INTO ".$this->tableName." (idKeeper, idPet, startDate, endDate, price) VALUES (:idKeeper, :idPet, :startDate, :endDate, :price)";

                $parameters["idKeeper"] = $reservation->getKeeper()->getIdKeeper();
                $parameters["idPet"] = $reservation->getPet()->getId();
                $parameters["startDate"] = $reservation->getStartDate();
                $parameters["endDate"] = $reservation->getEndDate();
                $parameters["price"] = $reservation->getPrice();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove($id) {
            try{
                $query = "DELETE FROM ".$this->tableName." WHERE (id = :id)";

                $parameters["id"] =  $id;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll() {
            try{
                $reservationList = array();

                $query = "SELECT * FROM ".$this->tableName;

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
            try{
                $query = "UPDATE ".$this->tableName." SET  startDate = :startDate, endDate= :endDate, state= :state, price = :price where id = :id;" ;

                $parameters["id"] =  $modreservation->getId();
                $parameters["startDate"] = $modreservation->getStartDate();
                $parameters["endDate"] = $modreservation->getEndDate();
                $parameters["state"] = $modreservation->getState();
                $parameters["price"] = $modreservation->getPrice();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }
        
        /*public function GetAllByOwner($idOwner)
        {
            $this->RetrieveData();
            $reservations = array_filter($this->reservationList, function($reservation) use($idOwner) {
                return $reservation->getPet()->GetOwner()->getIdOwner() == $idOwner;
            });

            $reservations = array_values($reservations);

            return $reservations;
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
        }  */

        public function GetAllByKeeper($idKeeper)
        {
            try{
                $reservationList = array();

                $query = "SELECT * FROM ".$this->tableName." WHERE (idKeeper = :idKeeper)";

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
            $query = "select * from ". $this->tableName . "            
            WHERE id = '$id'";
            
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
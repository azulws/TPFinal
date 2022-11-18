<?php

    namespace DAO;

    use Models\Reservation;
    use DAO\IReservationDAO as IReservationDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\PetDAO as PetDAO;
    use Models\eState;

    class ReservationDAODB implements IReservationDAO {
        private $connection;
        private $tableName = "reservations";

        public function Add(reservation $reservation) {
            $reservation->setState("PENDING");
            return $reservation->getId();
            try{
                $query = "INSERT INTO ".$this->tableName." (id, keeper, pet, startDate, endDate, state, price) VALUES (:id, :keeper, :pet, :startDate, :endDate, :state, :price)";

                $parameters["id"] =  $pet->getId();
                $parameters["keeper"] = $pet->getKeeper();
                $parameters["pet"] = $pet->getPet();
                $parameters["startDate"] = $pet->getStartDate();
                $parameters["endDate"] = $pet->getEndDate();
                $parameters["state"] = $pet->getState();
                $parameters["price"] = $pet->setPrice();

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
                    $reservation->setName($row["keeper"]);
                    $reservation->setOwner($row["pet"]);
                    $reservation->setPetType($row["startDate"]);
                    $reservation->setDescription($row["endDate"]);
                    $reservation->setImage($row["state"]);
                    $reservation->setVaccination($row["price"]);

                    array_push($reservationList, $reservation);
                }

                return $reservationList;
            }catch(Exception $ex){
                throw $ex;
            }
        }

        
        public function Modify(reservation $modreservation) {
            $this->RetrieveData();

            $this->reservationList = array_filter($this->reservationList, function($reservation) use($modreservation) {
                return $reservation->getId() != $modreservation->getId();
            });

            array_push($this->reservationList, $modreservation);

            $this->SaveData();
        }
        
        public function GetAllByOwner($idOwner)
        {
            $this->RetrieveData();
            $reservations = array_filter($this->reservationList, function($reservation) use($idOwner) {
                return $reservation->getPet()->GetOwner()->getIdOwner() == $idOwner;
            });

            $reservations = array_values($reservations);

            return $reservations;
        }   

        public function GetAllByKeeper($idKeeper)
        {
            $this->RetrieveData();
            $reservations = array_filter($this->reservationList, function($reservation) use($idKeeper) {
                return $reservation->getKeeper()->getIdKeeper() == $idKeeper;
            });

            $reservations = array_values($reservations);

            return $reservations;
        }

        public function GetById($id) {
            $this->RetrieveData();

            $aux = array_filter($this->reservationList, function($reservation) use($id) {
                return $reservation->getId() == $id;
            });

            $aux = array_values($aux);

            return (count($aux) > 0) ? $aux[0] : array();
        }


    }
    
?>
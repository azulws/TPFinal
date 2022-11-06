<?php

    namespace DAO;

    use Models\Reservation;
    use DAO\IReservationDAO as IReservationDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\PetDAO as PetDAO;
    use Models\eState;

    class ReservationDAO implements IReservationDAO {
        private $fileName = ROOT . "/Data/reservations.json";
        private $reservationList = array();

        public function Add(reservation $reservation) {
            $this->RetrieveData();

            $reservation->setId($this->GetNextId());
            $reservation->setPrice("");
            $reservation->setState("PENDING");


            array_push($this->reservationList, $reservation );
            
            $this->SaveData();
            return $reservation->getId();
        }

        public function Modify(reservation $modreservation) {
            $this->RetrieveData();

            $this->reservationList = array_filter($this->reservationList, function($reservation) use($modreservation) {
                return $reservation->getId() != $modreservation->getId();
            });

            array_push($this->reservationList, $modreservation);

            $this->SaveData();
        }

        public function Remove($id) {
            $this->RetrieveData();

            $this->reservationList = array_filter($this->reservationList, function($reservation) use($id) {
                return $reservation->getId() != $id;
            });

            $this->SaveData();
        }

        public function GetAll() {
            $this->RetrieveData();

            return $this->reservationList;
        }

        public function GetAllByKeeper($idKeeper)
        {
            $this->RetrieveData();
            $reservations = array_filter($this->reservationList, function($reservation) use($idKeeper) {
                return $reservation->getKeeper()->getId() == $idKeeper;
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

        private function SaveData() {
            sort($this->reservationList);
            $arrayEncode = array();

            foreach($this->reservationList as $reservation) {
                $value["id"] = $reservation->getId();
                $value["keeper"] = $reservation->getKeeper()->getIdKeeper();
                $value["Pet"] = $reservation->getPet()->getId();
                $value["startDate"] = $reservation->getStartDate();
                $value["endDate"] = $reservation->getEndDate();
                $value["price"] = $reservation->getPrice();
                $value["state"] = $reservation->getState();
                


                array_push($arrayEncode, $value);
            }
            $jsonContent = json_encode($arrayEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData() {
            $this->reservationList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayDecode as $value) {
                    $reservation = new reservation();
                    $reservation->setId($value["id"]);
                    $reservation->setStartDate($value["startDate"]);
                    $reservation->setEndDate($value["endDate"]);
                    $reservation->setPrice($value["price"]);
                    
                    $keeperDAO = new keeperDAO();
                    $keeper = $keeperDAO->GetById($value["keeper"]);
                    $reservation->setKeeper($keeper);
                    $petDAO = new petDAO();
                    $pet = $petDAO->GetById($value["Pet"]);
                    $reservation->setPet($pet);
                    $reservation->setState($value["state"]);

                    array_push($this->reservationList, $reservation);
                }
            }
        }


        private function GetNextId() {
            $id = 0;
            foreach($this->reservationList as $reservation) {
                $id = ($reservation->getId() > $id) ? $reservation->getId() : $id;
            }
            return $id + 1;
        }


    }
    
?>
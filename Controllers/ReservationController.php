<?php

    namespace Controllers;

    use DAO\PetDAO;
    use DAO\KeeperDAO;
    use DAO\OwnerDAO;
    use Models\Pet;
    use Models\Keeper;
    use DAO\ReservationDAO;
    use Models\Reservation as Reservation;
    use Models\eState;

    

    class ReservationController {
        private $reservationDAO;
        private $petDAO;
        private $keeperDAO;

        public function __construct() {
            $this->reservationDAO = new ReservationDAO();
            $this->petDAO = new PetDAO();
            $this->keeperDAO = new KeeperDAO();
        }

        public function ShowAddView($message = "") {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "add-reservation.php");
        }


        public function ShowRecordKeeperView() {
            require_once(VIEWS_PATH . "validate-session.php");
            $reservationList = $this->reservationDAO->GetAllByKeeper($_SESSION["loggedUser"]->getIdKeeper());
            require_once(VIEWS_PATH . "keeper-reservations.php");
        }

        public function ShowRecordOwnerView() {
            require_once(VIEWS_PATH . "validate-session.php");
            $reservationList = $this->reservationDAO->GetAllByOwner($_SESSION["loggedUser"]->getIdOwner());
            require_once(VIEWS_PATH . "owner-reservations.php");
        }

        

        public function ShowDetailView($id)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $reservation = $this->reservationDAO->GetById($id);
            $keeper = $reservation->getKeeper();
            $pet = $reservation->getPet();

            require_once(VIEWS_PATH . "reservation-detail.php");
        }

        public function CalculatePrice($startDate, $endDate, $idKeeper)
        {
            $keeperController = new KeeperController();
            $keeper = $keeperController->keeperDAO->GetById($idKeeper);
            $dates = $keeperController->checkAllDates($keeper->getAvailability(),$startDate , $endDate);
            return count($dates) * $keeper->getRemuneration();
        }   


        public function Add($idKeeper, $idPet, $startDate ,$endDate) {
            require_once(VIEWS_PATH . "validate-session.php");

            
            $keeper = $this->keeperDAO->GetById($idKeeper);
            $pet = $this->petDAO->GetById($idPet);


            if($keeper) {
                $reservation = new Reservation();
                $reservation->setKeeper($keeper);
                $reservation->setPet($pet);
                $reservation->setStartDate($startDate);
                $reservation->setEndDate($endDate);
                $price = $this->CalculatePrice($reservation->getStartDate(), $reservation->getEndDate(), $keeper->getIdKeeper());
                $reservation->setPrice($price);

                $idReservation = $this->reservationDAO->Add($reservation);

                
            } else {
                $this->ShowAddView("El keeper no existe");
            }
            $this->ShowDetailView($idReservation);
        }

        public function Remove($id) {
            require_once(VIEWS_PATH . "validate-session.php");

            $this->reservationDAO->Remove(intval($id));

            $this->ShowRecordOwnerView();
        }

        public function Confirm($state , $id) {         //modifica remuneracion
            $reservation = $this->reservationDAO->GetById($id);
            $reservation->setState($state);

            $this->reservationDAO->Modify($reservation);

            $this->ShowRecordKeeperView();
        }

    }

?>
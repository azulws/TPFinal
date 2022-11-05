<?php

    namespace Controllers;

    use DAO\PetDAO;
    use DAO\KeeperDAO;
    use DAO\OwnerDAO;
    use Models\Pet;
    use Modles\Keeper;
    use Models\State;
    use Controllers\Keeper;

    class ReservationController {
        private $reservationDAO;
        private $petDAO;
        private $keeperDAO;

        public function __construct() {
            $this->reservationDAO = new reservationDAO();
            $this->petDAO = new PetDAO();
            $this->keeperDAO = new KeeperDAO();
        }

        public function ShowAddView($message = "") {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "add-reservation.php");
        }

        public function ShowRecordView() {
            require_once(VIEWS_PATH . "validate-session.php");
            $petList = $this->petDAO->GetAllByOwner($_SESSION["loggedUser"]->getIdOwner());
            require_once(VIEWS_PATH . "pet-list.php");
        }

        public function ShowRequestView($id)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $reservation = $this->reservationDAO->GetById($id);
            require_once(VIEWS_PATH . "reservation-request.php");
        }

        public function ShowDetailView($id)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $reservation = $this->reservationDAO->GetById($id);
            $keeper = $this->keeperDAO->GetById($idKeeper);
            $pet = $this->petDAO->GetById($idPet);
            require_once(VIEWS_PATH . "reservation-detail.php");
        }



        public function Add($idKeeper, $idPet, $startDate ,$endDate) {
            require_once(VIEWS_PATH . "validate-session.php");

            
            $keeper = $this->keeperDAO->GetById($idKeeper);
            $pet = $this->petDAO->GetById($idPet);


            if($keeper) {
                $reservation = new Reservation();
                $reservation->setKeeper($keeper);
                $reservation->setPet($pet);
                $reservation->setStartDate($startDate)
                $reservation->setEndDate($endDate);

                $this->reservationDAO->Add($reservation);

                
            } else {
                $this->ShowAddView("El keeper no existe");
            }
            $this->ShowListView();
        }

        public function Remove($id) {
            require_once(VIEWS_PATH . "validate-session.php");

            $this->reservationDAO->Remove(intval($id));

            $this->ShowListView();
        }

    }

?>
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
        private $petController;
        private $keeperController;

        public function __construct() {
            $this->reservationDAO = new ReservationDAO();
            $this->petController = new PetController();
            $this->keeperController = new KeeperController();

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
            //$keeperController = new KeeperController();
            $keeper = $this->keeperController->keeperDAO->GetById($idKeeper);
            $dates = $this->keeperController->checkAllDates($keeper->getAvailability(),$startDate , $endDate);
            return count($dates) * $keeper->getRemuneration();
        }   

        public function RaceValidation($idKeeper , $idPet, $startDate, $endDate)
        {
            $keeper = $this->keeperController->keeperDAO->GetById($idKeeper);
            $pet = $this->petController->petDAO->GetById($idPet);
            $allReservationList = $this->reservationDAO->GetAllByKeeper($keeper->getIdKeeper());

            $actualDate=$startDate;
            foreach($allReservationList as $reservation){
                $dates = $this->keeperController->checkAllDates($keeper->getAvailability(),$startDate , $endDate);
                foreach($dates as $d){
                    //var_dump($this->getPetByDay($d));
                    if(!$this->getPetByDay($d)){
                        return true;
                    }else if($pet->getPetType()->getBreed()!=$this->getPetByDay($d)){
                        return false;
                    }
                }
            }

            return true;
        }



        public function getPetByDay($date){
            $all=$this->reservationDAO->getAll();
            foreach($all as $a){
                if($a->getStartDate()==$date){
                    return $a->getPet()->getPetType()->getBreed();
                }
            }
        }

        public function Add($idPet, $startDate, $endDate ,$idKeeper) {
            //require_once(VIEWS_PATH . "validate-session.php");
            if($startDate>=date("Y-m-d")){
                $keeper = $this->keeperController->keeperDAO->GetById($idKeeper);

                $pet = $this->petController->petDAO->GetById($idPet);
                $sizes = $keeper->getSizes();
                $flag = 0;

                

                foreach($sizes as $size)
                {
                    if($size == $pet->getSize()){
                        $flag = 1;
                    }
                }
                if($this->RaceValidation($idKeeper , $idPet, $startDate, $endDate)){
                if($flag == 1 ) {
                    $reservation = new Reservation();
                    $reservation->setKeeper($keeper);
                    $reservation->setPet($pet);
                    $reservation->setStartDate($startDate);
                    $reservation->setEndDate($endDate);
                    $price = $this->CalculatePrice($reservation->getStartDate(), $reservation->getEndDate(), $keeper->getIdKeeper());
                    $reservation->setPrice($price);

                    $idReservation = $this->reservationDAO->Add($reservation);
                    $this->ShowDetailView($idReservation);
                    
                } else {
                    $this->keeperController->ShowCheckDatesView($idPet, 'the size of the pet does not match with the keeper');
                }
                }else{
                    $this->petController->ShowListView('animal distinto');
                }
            }else{
                $this->keeperController->ShowCheckDatesView($idPet, 'fecha mala');
            }
            
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
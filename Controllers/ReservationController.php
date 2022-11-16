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
            $keeper = $this->keeperController->keeperDAO->GetById($idKeeper);
            $dates = $this->keeperController->checkAllDates($keeper->getAvailability(),$startDate , $endDate);
            return count($dates) * $keeper->getRemuneration();
        }   

        public function RaceValidation($idKeeper , $idPet, $startDate, $endDate)
        {
            $keeper = $this->keeperController->keeperDAO->GetById($idKeeper);
            $pet = $this->petController->petDAO->GetById($idPet);

            $allConfirmList=$this->getAllStateReservations($keeper->getIdKeeper(),"ACCEPTED");

            foreach($allConfirmList as $reservation){
                $arrayValidate = $this->createArrayReservation($reservation->getStartDate(),$reservation->getEndDate());
                if(in_array($startDate,$arrayValidate)||in_array($endDate,$arrayValidate)||($startDate<$reservation->getStartDate()&&$endDate>$reservation->getEndDate())){
                    if($pet->getPetType()->getBreed()!=$reservation->getPet()->getPetType()->getBreed()){
                        return false;
                    }
                }
            }

            return true;
        }

        public function createArrayReservation($startDate,$endDate){        //genera un arreglo para validar los dias entre inicio y fin
            $array= array();
            $date=$startDate;
            for($date;$date<=$endDate;$date){
                array_push($array,$date);
                $nextDate=strtotime("+1 day",strtotime($date));
                $nextDate=date("Y-m-d",$nextDate);
                $date=$nextDate;
            }
            return $array;
        }

        public function getAllStateReservations($idKeeper,$state){                           //devuelve un array con las reservas en estado "ACCEPTED"
            $allReservationList = $this->reservationDAO->GetAllByKeeper($idKeeper);
            $confirmList= array();
            foreach($allReservationList as $reservation){
                if($reservation->getState()==$state){
                    array_push($confirmList,$reservation);
                }
            }
            return $confirmList;
        }

        public function Add($idPet, $startDate, $endDate ,$idKeeper) {
            if($startDate>=date("Y-m-d")){              //confirmacion de seguridad para validar que la fecha de inicio de la reserva es mayor a la fecha actual
                $keeper = $this->keeperController->keeperDAO->GetById($idKeeper);

                $pet = $this->petController->petDAO->GetById($idPet);
                $sizes = $keeper->getSizes();
                $flag = 0;
                $flag2 = 0;
                
                $allReservationList = $this->reservationDAO->GetAllByKeeper($idKeeper); 
                foreach($allReservationList as $reservation){
                    if($reservation->getState()!="CANCELED"){       //permito crear reservas cuando ya hay una reserva en esas fechas pero el estado es CANCELED
                        $arrayValidate = $this->createArrayReservation($reservation->getStartDate(),$reservation->getEndDate());
                    
                        if(in_array($startDate,$arrayValidate)||in_array($endDate,$arrayValidate)||($startDate<$reservation->getStartDate()&&$endDate>$reservation->getEndDate())){
                            if($pet==$reservation->getPet()){
                                $flag2 = 1;
                            }
                        }
                    }
                }

                foreach($sizes as $size)                
                {
                    if($size == $pet->getSize()){
                        $flag = 1;
                    }
                }
                if($flag2 !=1){                     //confirmo si ya tiene reservas con ese rango de fechas
                    if($this->RaceValidation($idKeeper , $idPet, $startDate, $endDate)){        //confirmo si es el mismo tipo de animal
                        if($flag == 1 ) {                           //confirmo si cuida ese tamaño de animal
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
                    $this->petController->ShowListView('ya hay reserva para el rango de fechas con este animal');
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

        public function Confirm($state , $id) {         //modifica el estado de la reserva a confirmado y cancela las reservas para la misma fecha con otro tipo de animal
            $reservation = $this->reservationDAO->GetById($id);
            $reservation->setState($state);

            $this->reservationDAO->Modify($reservation);
            
            $allPendingList=$this->getAllStateReservations($reservation->getKeeper()->getIdKeeper(),"PENDING");
            foreach($allPendingList as $reservationPending){
                $arrayValidate = $this->createArrayReservation($reservation->getStartDate(),$reservation->getEndDate());
                $startDate=$reservationPending->getStartDate();
                $endDate=$reservationPending->getEndDate();
                if(in_array($startDate,$arrayValidate)||in_array($endDate,$arrayValidate)||($startDate<$reservation->getStartDate()&&$endDate>$reservation->getEndDate())){
                    if($reservation->getPet()->getPetType()->getBreed()!=$reservationPending->getPet()->getPetType()->getBreed()){
                        $reservationPending->setState("CANCELED");
                        $this->reservationDAO->Modify($reservationPending);
                    }
                }
            }

            $this->ShowRecordKeeperView();
        }

    }

?>
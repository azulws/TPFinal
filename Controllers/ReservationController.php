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

    //email
    use Email\PHPMailer\PHPMailer as PHPMailer;
    use Email\PHPMailer\SMTP;
    use Email\PHPMailer\Exception;  

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
            if($startDate>=date("Y-m-d") && $startDate<=$endDate){              //confirmacion de seguridad para validar que la fecha de inicio de la reserva es mayor a la fecha actual
                $keeper = $this->keeperController->keeperDAO->GetById($idKeeper);

                $pet = $this->petController->petDAO->GetById($idPet);

                if($this->validateRepeatedDates($keeper,$pet,$startDate,$endDate)){                     //confirmo si ya tiene reservas con ese rango de fechas
                    if($this->RaceValidation($idKeeper , $idPet, $startDate, $endDate)){        //confirmo si es el mismo tipo de animal
                        if($this->validateSize($keeper,$pet)) {                           //confirmo si cuida ese tamaño de animal
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

        public function validateSize($keeper,$pet){
            $sizes = $keeper->getSizes();
            foreach($sizes as $size)                
            {
                if($size == $pet->getSize()){
                    return true;
                }
            }
            return false;
        }

        public function validateRepeatedDates($keeper,$pet,$startDate,$endDate){
            $allReservationList = $this->reservationDAO->GetAllByKeeper($keeper->getIdKeeper()); 
            foreach($allReservationList as $reservation){
                if($reservation->getState()!="CANCELED"){       //permito crear reservas cuando ya hay una reserva en esas fechas pero el estado es CANCELED
                    $arrayValidate = $this->createArrayReservation($reservation->getStartDate(),$reservation->getEndDate());
                    
                    if(in_array($startDate,$arrayValidate)||in_array($endDate,$arrayValidate)||($startDate<$reservation->getStartDate()&&$endDate>$reservation->getEndDate())){
                        if($pet==$reservation->getPet()){
                            return false;
                        }
                    }
                }
            }
            return true;
        }

        public function Remove($id) {
            require_once(VIEWS_PATH . "validate-session.php");
            
            $this->reservationDAO->Remove(intval($id));

            $this->ShowRecordOwnerView();
        }

        public function Confirm($state , $id) {         //modifica el estado de la reserva a confirmado y cancela las reservas para la misma fecha con otro tipo de animal
            $reservation = $this->reservationDAO->GetById($id);
            
            $reservation->setState($state);
            
            if($state == "ACCEPTED"){
                //var_dump("mail enviado: ".$reservation->getPet()->getOwner()->getEmail());
                //$this->SendMail($reservation);
            }

            $this->reservationDAO->Modify($reservation);

            $this->cancelOtherTypeSameDate($reservation);

            $this->ShowRecordKeeperView();
        }

        public function cancelOtherTypeSameDate($reservation){
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
        }

        public function SendMail($reservation){ 
            $mail = new PHPMailer(true); //mail
            try {
                    //Server settings
                    $mail->SMTPDebug = 0;                      //poner 2 aca es como poner un var dump, sino pongan 0 y no muestra nada
                    
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp-mail.outlook.com';                     //aca va el host, averiguar en google cual es dependiendo del @ del email
                    $mail->SMTPAuth   = true;                                   //no toquen nada aca
                    $mail->Username   = 'CaninosYa@outlook.com';                     // aca ponemos nuestro mail para enviar mails
                    $mail->Password   = 'YaCaninos123';                               //si usamos gmail, habilitar autenticacion en dos pasos y crear una clave para la app, todo en seguridad y privacidad de gmail esta
                    $mail->SMTPSecure = 'TLS';            //si la pagina tiene un candadito, ssl, si no lo tiene, tsl
                    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                
                    //Recipients
                    $mail->setFrom('CaninosYa@outlook.com', 'Caninos Ya');
                    $email= $reservation->getOwner()->getEmail();
                    $mail->addAddress($email,$reservation->getPet()->getOwner()->getUserName());     // aca pondriamos el owner $email y el owner $name, o $username
                            //Name is optional
                            //$reservation->getPet()->getOwner()->getMail()
                
                
                    //Content
                    $mail->isHTML(true);    //Set email format to HTML
                    $namePet=$reservation->getPet()->getName();
                    $startDate=$reservation->getStartDate();
                    $price= $this->CalculatePrice($reservation->getStartDate(), $reservation->getEndDate(), $reservation->getKeeper()->getIdKeeper());
                    $mail->Subject = 'reserva '.$namePet.' at '.$startDate;
                    $mail->Body    = 'pet: '.$namePet.
                    ' startDate: '.$startDate.
                    ' endDate: '.$reservation->getEndDate().
                    ' keeper: '.$reservation->getKeeper()->getUserName().
                    ' price: '.$price; //esto es html asi que podemos agregar imagenes y pavaditas si llegamos con el tiempo

                    $mail->send();
                    echo 'mensaje enviado!';  
                } catch (Exception $e) {
                    echo "error al enviar. Mailer Error: {$mail->ErrorInfo}";
                }
            }
    }

?>
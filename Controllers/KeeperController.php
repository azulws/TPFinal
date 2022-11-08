<?php
    namespace Controllers;

    use DAO\KeeperDAO as KeeperDAO;
    use Models\Keeper as Keeper;


    class KeeperController
    {
        public $keeperDAO;

        public function __construct()
        {
            $this->keeperDAO = new keeperDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-view.php");
        }

        public function ShowCheckDatesView($idPet, $message ='')
        {
            require_once(VIEWS_PATH."validate-session.php");
            $pet = $idPet;
            require_once(VIEWS_PATH."check-dates.php");
        }


        public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $keeperList = $this->keeperDAO->GetAll();
            require_once(VIEWS_PATH."keeper-list.php");
        }

        public function ShowAvailabilityView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $keeper = $this->keeperDAO->getByUserName($_SESSION["loggedUser"]->getUserName()); //traigo al usuario para ver su lista de disponibilidad
            $array = $keeper->getAvailability();
            $availabilityList = $this->getCurrentDates($array);
            require_once(VIEWS_PATH."availability.php");
        }

        public function ShowKeepersAvailablesView($array ,$startDate, $endDate , $idPet)
        {
            require_once(VIEWS_PATH."validate-session.php");
            $keeperListCheck=$array;
            $initialDate = $startDate;
            $finalDate = $endDate;
            $pet = $idPet;
            require_once(VIEWS_PATH."keeper-available.php");
        }

        public function ShowEditSizesView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $sizesList = $_SESSION["loggedUser"]->getSizes();
            require_once(VIEWS_PATH."edit-sizes.php");
        }

        public function Add($firstName,$lastName,$userName,$password)
        {
            $keeper = new Keeper();
            $keeper->setFirstName($firstName);
            $keeper->setLastName($lastName);
            $keeper->setUserName($userName);
            $keeper->setPassword($password);
            
            if($this->keeperDAO->GetByUserName($keeper->getUserName())){
                $this->ShowAddView("Ya existe un usuario con ese Username",null);
            }
            else{
                $this->keeperDAO->Add($keeper);
                $_SESSION["loggedUser"]=$keeper;
                $this->ShowAddView();
            }

        }
/*
        public function Add($firstName,$lastName,$userName,$password)  funcion anterior, no tocar en caso de q la de arriba no ande XD
        
        {
            if($this->keeperDAO->GetByUserName($userName)==NULL){
                $keeper = new Keeper();
                $keeper->setFirstName($firstName);
                $keeper->setLastName($lastName);
                $keeper->setUserName($userName);
                $keeper->setPassword($password);
                $this->keeperDAO->Add($keeper);
            }
            $this->ShowAddView();
        }
*/
        public function Modify($remuneration) {         //modifica remuneracion
            $keeper = $this->keeperDAO->getByUserName($_SESSION["loggedUser"]->getUserName());
            $keeper->setRemuneration($remuneration);

            $this->keeperDAO->Modify($keeper);

            $this->ShowListView();
        }

        public function EditSize($size)
        {
            $_SESSION["loggedUser"]->setSizes($size);
            $this->keeperDAO->Modify($_SESSION["loggedUser"]);

            $this->ShowEditSizesView();

        
        }

        public function addAvailability($date){         //modifica disponibilidad
            $keeper = $this->keeperDAO->getByUserName($_SESSION["loggedUser"]->getUserName());
            $dateList= $keeper->getAvailability();
            if($date>=date("Y-m-d")){
            if(!in_array($date,$dateList)){
                array_push($dateList,$date);
                    sort($dateList);
                $keeper->setAvailability($dateList);

                $this->keeperDAO->Modify($keeper);
            }
            }

            $this->ShowAvailabilityView();
        }

        public function RemoveAvailability($date){
            $keeper = $this->keeperDAO->getByUserName($_SESSION["loggedUser"]->getUserName());
            $dateList= $keeper->getAvailability();
            $newList= array();
            foreach($dateList as $d){
                if($d != $date){
                    array_push($newList,$d);
                }
            }
            $keeper->setAvailability($newList);

            $this->keeperDAO->Modify($keeper);

            $this->ShowAvailabilityView();
        }

        public function KeepersAvailables($startDate,$endDate, $idPet){                    //devuelve lista de keepers con la disponibilidad de inicio a fin
            $keeperList= $this->keeperDAO->getAll() ;
            $keeperListCheck = array();
            foreach($keeperList as $keeper){
                $availability= $keeper->getAvailability();
                if($this->allDatesOnArray($availability,$startDate,$endDate) != null){
                    array_push($keeperListCheck,$keeper);
                }
            }
            
            $this->ShowKeepersAvailablesView($keeperListCheck, $startDate, $endDate, $idPet);
        }


        public function allDatesOnArray($availability,$startDate,$endDate){  //verifica si todas las fechas del keeper estan en el rango de inicio a fin
            $arrayDatesCheckeds=$this->checkAllDates($availability,$startDate,$endDate);
            $date=$startDate;
            for($date;$date<=$endDate;$date){
                if(in_array($date,$arrayDatesCheckeds)){
                    $nextDate=strtotime("+1 day",strtotime($date));
                    $nextDate=date("Y-m-d",$nextDate);
                    $date=$nextDate;
                }else{
                    return false;
                }
            }
            return true;
        }
        
        public function checkAllDates($array,$startDate,$endDate){  //devuelve un arreglo con las fechas entre inicio y fin que dispone el arreglo del keeper
            $arrayDatesChecked=array();
            foreach($array as $a){
                if(($a>=$startDate) && ($a<=$endDate)){
                    array_push($arrayDatesChecked,$a);
                }
            }
            return $arrayDatesChecked;
        }

        public function getCurrentDates($array){            //retorna un arreglo con las fechas del dia de hoy en adelante
            $availabilityList= array();
            foreach($array as $availability){
                if($availability>=date("Y-m-d"))
                    array_push($availabilityList,$availability);
            }
            return $availabilityList;
        }

        public function Remove($id)
        {
            $this->keeperDAO->Remove($id);

            $this->ShowListView();
        }
    }
?>
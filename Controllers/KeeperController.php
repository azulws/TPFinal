<?php
    namespace Controllers;

    use DAO\KeeperDAO as KeeperDAO;
    use Models\Keeper as Keeper;

    class KeeperController
    {
        private $keeperDAO;

        public function __construct()
        {
            $this->keeperDAO = new keeperDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-view.php");
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
            $availabilityList = $keeper->getAvailability();
            require_once(VIEWS_PATH."availability.php");
        }

        public function ShowCheckDatesView($array)
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."check-dates.php");
        }

        public function Add($firstName,$lastName,$userName,$password)  
        
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

        public function Modify($remuneration) {         //modifica remuneracion
            $keeper = $this->keeperDAO->getByUserName($_SESSION["loggedUser"]->getUserName());
            $keeper->setRemuneration($remuneration);

            $this->keeperDAO->Modify($keeper);

            $this->ShowListView();
        }

        public function addAvailability($date){         //modifica disponibilidad
            $keeper = $this->keeperDAO->getByUserName($_SESSION["loggedUser"]->getUserName());
            $dateList= $keeper->getAvailability();
            if(!in_array($date,$dateList)){
                array_push($dateList,$date);
                $keeper->setAvailability($dateList);

                $this->keeperDAO->Modify($keeper);
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

        public function checkDates($startDate,$endDate){
            $keeperList= array();
            foreach($this->keeperDAO->getAll() as $keeper){
                $keeperA= $keeper->getAvailability();
                if($this->checkAllDates($keeperA,$startDate,$endDate)){
                    array_push($keeperList,$keeper);
                }
            }
            
            $this->ShowCheckDatesView($keeperList);
        }

        public function checkAllDates($array,$startDate,$endDate){
            $date=$startDate;
            if(in_array($startDate,$array) && in_array($endDate,$array)){
                for($date;$date>=$endDate;strtotime($date."+ 1 days")){
                    if(!in_array($date,$array)){
                        return false;
                    }
                }
            }
            return true;
        }

        public function Remove($id)
        {
            $this->keeperDAO->Remove($id);

            $this->ShowListView();
        }
    }
?>
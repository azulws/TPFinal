<?php
    namespace Controllers;
    
    use DAO\AvailabilityDAO as AvailabilityDAO;
    use Models\Availability as Availability;
    use Models\User as User;

    class AvailabilityController{
        private $availabilityDAO;

        public function __construct()
        {
            $this->availabilityDAO = new AvailabilityDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."availability.php");
        }

        public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $availabilityList = $this->availabilityDAO->GetAll();
            sort($availabilityList);
            require_once(VIEWS_PATH."availability.php");
        }

        public function Add($date,$user)  
        
        {
            if($this->availabilityDAO->GetByDate($date)==null){
                $availability = new Availability();
                $availability->setDate($date);
                $availability->setKeeperList($user);

                $this->availabilityDAO->Add($availability);
            }
            
            $this->ShowListView();
        }

        public function Remove($id)
        {
            $this->keeperDAO->Remove($id);

            $this->ShowListView();
        }
    }
?>
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
            require_once(VIEWS_PATH."availability.php");
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
            $keeper = new keeper();
            $keeper->setIdKeeper($_SESSION["loggedUser"]->getIdKeeper());
            $keeper->setFirstName($_SESSION["loggedUser"]->getFirstName());
            $keeper->setLastName($_SESSION["loggedUser"]->getLastName());
            $keeper->setUserName($_SESSION["loggedUser"]->getUserName());
            $keeper->setPassword($_SESSION["loggedUser"]->getPassword());
            $keeper->setRemuneration($remuneration);
            $keeper->setAvailability($_SESSION["loggedUser"]->getPassword());
            $this->keeperDAO->Modify($keeper);

            $this->ShowListView();
        }

        public function addAvailability($date){         //modifica disponibilidad
            $keeper = new keeper();
            $keeper->setIdKeeper($_SESSION["loggedUser"]->getIdKeeper());
            $keeper->setFirstName($_SESSION["loggedUser"]->getFirstName());
            $keeper->setLastName($_SESSION["loggedUser"]->getLastName());
            $keeper->setUserName($_SESSION["loggedUser"]->getUserName());
            $keeper->setPassword($_SESSION["loggedUser"]->getPassword());
            $keeper->setRemuneration($_SESSION["loggedUser"]->getRemuneration());
            var_dump($_SESSION["loggedUser"]);
            var_dump($_SESSION["loggedUser"]->getAvailability());
            $dateList= $_SESSION["loggedUser"]->getAvailability();
            var_dump($dateList);
            array_push($dateList,$date);
            $keeper->setAvailability($dateList);
            
            $this->keeperDAO->Modify($keeper);

            $this->ShowAvailabilityView();
        }

        public function RemoveAvailability($date){
            $keeper = new keeper();
            $keeper->setIdKeeper($_SESSION["loggedUser"]->getIdKeeper());
            $keeper->setFirstName($_SESSION["loggedUser"]->getFirstName());
            $keeper->setLastName($_SESSION["loggedUser"]->getLastName());
            $keeper->setUserName($_SESSION["loggedUser"]->getUserName());
            $keeper->setPassword($_SESSION["loggedUser"]->getPassword());
            $keeper->setRemuneration($_SESSION["loggedUser"]->getRemuneration());
            $dateList= $_SESSION["loggedUser"]->getAvailability();
            unset($dateList[$date]); 
            $keeper->setAvailability($dateList);
            
            $this->keeperDAO->Modify($keeper);

            $this->ShowAvailabilityView();
        }

        public function Remove($id)
        {
            $this->keeperDAO->Remove($id);

            $this->ShowListView();
        }
    }
?>
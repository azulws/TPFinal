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

        public function Modify($remuneration) {
            $keeper = new keeper();
            $keeper->setFirstName($_SESSION["loggedUser"]->getFirstName());
            $keeper->setLastName($_SESSION["loggedUser"]->getLastName());
            $keeper->setUserName($_SESSION["loggedUser"]->getUserName());
            $keeper->setPassword($_SESSION["loggedUser"]->getPassword());
            $keeper->setRemuneration($remuneration);

            $this->keeperDAO->Modify($keeper);

            $this->ShowListView();
        }

        public function Remove($id)
        {
            $this->keeperDAO->Remove($id);

            $this->ShowListView();
        }
    }
?>
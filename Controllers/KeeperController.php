<?php
    namespace Controllers;

    use DAO\KeeperDAO as KeeperDAO;


    class KeeperController
    {
        private $keeperDAO;

        public function __construct()
        {
            $this->keeperDAO = new keeperDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."add-beertype.php"); //MODIFICAR
        }

        /*public function ShowListView()
        {
            $keeperList = $this->keeperDAO->GetAll();
            require_once(VIEWS_PATH."beertype-list.php"); //para mostrar una lista de los keepers?
        }*/

        public function Add($firstName,$lastName,$userName,$password,$idKeeper,$remuneration,$reputation)  
        
        {
            $keeper = new Keeper();
            $keeper->setFirstName($firstName);
            $keeper->setLastName($lastName);
            $keeper->setUserName($userName);
            $keeper->setPassword($password);
            $keeper->setIdKeeper($idKeeper);
            $keeper->setRemuneration($remuneration);
            $keeper->setReputation($reputation);

            $this->keeperDAO->Add($keeper);

            $this->ShowAddView();
        }

        public function Remove($id)
        {
            $this->keeperDAO->Remove($id);

            $this->ShowListView();
        }
    }
?>
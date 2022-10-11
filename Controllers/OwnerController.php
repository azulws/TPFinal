<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use Models\Owner as Owner;
    use Models\Person as Person;


    class OwnerController
    {
        private $OwnerDAO;

        public function __construct()
        {
            $this->OwnerDAO = new OwnerDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."add-owner.php"); //MODIFICAR
        }

        /*public function ShowListView()
        {
            $keeperList = $this->keeperDAO->GetAll();
            require_once(VIEWS_PATH."beertype-list.php"); //para mostrar una lista de los keepers?
        }*/

        public function Add($firstName,$lastName,$userName,$password)  
        
        {
            $owner = new Owner();
            $owner->setFirstName($firstName);
            $owner->setLastName($lastName);
            $owner->setUserName($userName);
            $owner->setPassword($password);

            $this->OwnerDAO->Add($owner);

            $this->ShowAddView();
        }

        public function Remove($id)
        {
            $this->keeperDAO->Remove($id);

            $this->ShowListView();
        }
    }
?>
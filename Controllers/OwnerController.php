<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use Models\Owner as Owner;


    class OwnerController
    {
        private $OwnerDAO;

        public function __construct()
        {
            $this->OwnerDAO = new OwnerDAO();
        }

        public function ShowAddView($message = "")
        {
            require_once(VIEWS_PATH."add-view.php"); 
        }

        public function ShowMenuView()
        {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "home-owner.php");
        }

        public function Add($firstName,$lastName,$userName,$email,$password)
        {
            $owner = new Owner();
            $owner->setFirstName($firstName);
            $owner->setLastName($lastName);
            $owner->setUserName($userName);
            $owner->setEmail($email);
            $owner->setPassword($password);

            $keeperController = new KeeperController();
            
            if($this->OwnerDAO->GetByUserName($owner->getUserName()) || $keeperController->keeperDAO->GetByUserName($userName)){
                $this->ShowAddView("Ya existe un usuario con ese Username",null);
            }else if($this->OwnerDAO->GetByEmail($owner->getEmail()) || $keeperController->keeperDAO->GetByEmail($email)){
                $this->ShowAddView("Ya existe un usuario con ese Email",null);
            }
            else{
                $this->OwnerDAO->Add($owner);
                /*$_SESSION["loggedUser"]=$owner;*/
                header("location:../index.php");
            }

        }

  public function Remove($id)
        {
            $this->keeperDAO->Remove($id);

            $this->ShowListView();
        }
    }
?>
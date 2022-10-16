<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use Models\Owner as Owner;
    use Models\User as User;


    class OwnerController
    {
        private $OwnerDAO;

        public function __construct()
        {
            $this->OwnerDAO = new OwnerDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."add-view.php"); 
        }

        public function ShowMenuView()
        {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "home-owner.php");
        }

        /*public function ShowListView()
        {
            $ownerList = $this->ownerDAO->GetAll();
            require_once(VIEWS_PATH."owner-list.php"); //para mostrar una lista de los owners?
        }*/

        public function Add($firstName,$lastName,$userName,$password)  
        {
            if($this->OwnerDAO->GetByUserName($userName)==NULL){
               $owner = new Owner();
            $owner->setFirstName($firstName);
            $owner->setLastName($lastName);
            $owner->setUserName($userName);
            $owner->setPassword($password);

            $this->OwnerDAO->Add($owner);
            }

            $this->ShowAddView(); 
                
        }

        public function Remove($id)
        {
            $this->keeperDAO->Remove($id);

            $this->ShowListView();
        }

        public function Login($userName, $password) {
            $owner = $this->OwnerDAO->GetByUserName($userName);
    
            if(($owner != null) && ($owner->getPassword() === $password)) {
                $_SESSION["loggedUser"] = $owner;
                $this->ShowMenuView();
            } else {
                echo "Usuario Incorrecto";
                require_once(VIEWS_PATH."loguin-owner.php");
                
            }
    
        }
    
        public function Logout() {
            session_destroy();
    
            require_once(VIEWS_PATH."home.php");
        }
    }
?>
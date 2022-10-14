<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use DAO\KeeperDAO as KeeperDAO;

    class HomeController
    {
        /*public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }  
        */
        private $ownerDAO;
        private $keeperDAO;

        public function __construct() {
            $this->ownerDAO = new OwnerDAO();
            $this->keeperDAO = new KeeperDAO();
        }

        public function Index($message = "") {
            require_once(VIEWS_PATH . "home.php");
        }

        public function ShowAddView() {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "home-owner.php"); //pantalla para el usuario
        }

        public function Login($userName, $password,$userType) {
            if($userType=="owner"){
                $user = $this->ownerDAO->GetByUserName($userName);
            }else if($userType=="keeper"){
                $user = $this->keeperDAO->GetByUserName($userName);
            }
            if(($user != null) && ($user->getPassword() === $password)) {
                $_SESSION["loggedUser"] = $user;
                $this->ShowAddView();                                               
            } else {
                $this->Index("Usuario y/o contraseña incorrecta");
            }
        }

        public function Logout() {
            session_destroy();

            $this->Index();
        }      
    }

?>
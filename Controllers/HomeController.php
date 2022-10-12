<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;

    class HomeController
    {
        /*public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }  
        */
        private $ownerDAO;

        public function __construct() {
            $this->ownerDAO = new OwnerDAO();
        }

        public function Index($message = "") {
            require_once(VIEWS_PATH . "home.php");
        }

        public function ShowAddView() {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . ".php"); //pantalla para el usuario
        }

        public function Login($userName, $password) {
            $user = $this->ownerDAO->GetByUserName($userName);

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
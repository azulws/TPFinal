<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use Models\Keeper as Keeper;
    use Models\Owner as Owner;
    
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

        public function ShowHomeOwnerView() {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "home-owner.php"); //pantalla para el usuario
        }

        public function ShowHomeKeeperView() {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "home-keeper.php"); //pantalla para el usuario
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH."add-view.php");
        }
        
        public function Login($userName, $password,$userType) {
            if($userType=="owner"){
                $user = $this->ownerDAO->GetByUserName($userName);
            }else if($userType=="keeper"){
                $user = $this->keeperDAO->GetByUserName($userName);
            }
            if(($user != NULL) && ($user->getPassword() == $password)) {
                $_SESSION["loggedUser"] = $user;
                if($userType=="owner"){
                    $this->ShowHomeOwnerView();
                }else{
                    $this->ShowHomeKeeperView();
                }                                              
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
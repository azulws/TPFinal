<?php
    namespace Controllers;

    use DAO\OwnerDAO as OwnerDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use Models\Keeper as Keeper;
    use Models\Owner as Owner;
    
    class HomeController
    {

        public function __construct() {
        }

        public function Index($message = "") {
            require_once(VIEWS_PATH . "home.php");                      //home del tp = pantalla de login
        }

        public function ShowAddView(){
            require_once(VIEWS_PATH."add-view.php");
        }
        
        public function Login($userName, $password,$userType) {       //busqueda en el dao correspondiente del usuario logueando
            if($userType=="owner"){
                $ownerList = new OwnerDAO();
                $user = $ownerList->GetByUserName($userName);
            }else if($userType=="keeper"){                              
                $keeperList= new KeeperDAO();                    
                $user = $keeperList->GetByUserName($userName);
            }
            if(($user != NULL) && ($user->getPassword() == $password)) {
                $_SESSION["loggedUser"] = $user;
                $this->showHomeView();
            } else {
                $this->Index("Usuario y/o contraseña incorrecta");
            }
        }

        public function ShowHomeView() {
            require_once(VIEWS_PATH . "validate-session.php");
            if($_SESSION["loggedUser"] instanceof Owner){
                require_once(VIEWS_PATH . "home-owner.php");            //pantalla para el usuario owner
            }else if($_SESSION["loggedUser"] instanceof Keeper){
                require_once(VIEWS_PATH . "home-keeper.php");           //pantalla para el usuario keeper
            }
        }

        public function Logout() {
            session_destroy();

            $this->Index();
            

        }      
    }

?>
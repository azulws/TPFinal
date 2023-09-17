<?php

    namespace Controllers;

    use DAO\PetTypeDAO;
    use Models\PetType;

    class PetTypeController {
        private $petTypeDAO;

        public function __construct() {
            $this->petTypeDAO = new PetTypeDAO();
        }

        public function ShowAddView() {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "add-pettype.php");
        }

        public function ShowListView() {
            require_once(VIEWS_PATH . "validate-session.php");
            $petTypeList = $this->petTypeDAO->GetAll();
            require_once(VIEWS_PATH . "pettype-list.php");
        }

        public function Add($size, $breed) {
            require_once(VIEWS_PATH . "validate-session.php");

            $petType = new PetType();
            $petType->setBreed($breed);

            $this->petTypeDAO->Add($petType);

            $this->ShowListView();
        }

        public function Remove($id) {
            require_once(VIEWS_PATH ."validate-session.php");

            $this->petTypeDAO->Remove(intval($id));

            $this->ShowListView();
        }

        public function GetAll(){
            return $this->petTypeDAO->GetAll();
        }

        public function Exist($id){
            return $this->petTypeDAO->Exist(intval($id));
        }

    }
?>
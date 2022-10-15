<?php

    namespace Controllers;

    use DAO\PetDAO;
    use DAO\PetTypeDAO;
    use Models\Pet;
    use Models\PetType;

    class PetController {
        private $petDAO;

        public function __construct() {
            $this->petDAO = new PetDAO();
        }

        public function ShowAddView($message = "") {
            require_once(VIEWS_PATH . "validate-session.php");
            require_once(VIEWS_PATH . "add-pet.php");
        }

        public function ShowListView() {
            require_once(VIEWS_PATH . "validate-session.php");
            $petList = $this->petDAO->GetAll();
            require_once(VIEWS_PATH . "pet-list.php");
        }

        public function Add($name, $owner, $petType, $description) {
            require_once(VIEWS_PATH . "validate-session.php");

            $petTypeDAO = new PetTypeDAO();
            $type = $petTypeDAO->Exist(intval($petType));

            if($type) {
                $pet = new pet();
                $pet->setName($name);
                $pet->setOwner($Owner);
                $pet->setPetType($type);
                $pet->setDescription($description);

                $this->petDAO->Add($pet);

                $this->ShowListView();
            } else {
                $this->ShowAddView("El tipo de mascota ingresado no existe");
            }
        }

        public function Remove($id) {
            require_once(VIEWS_PATH . "validate-session.php");

            $this->petDAO->Remove(intval($id));

            $this->ShowListView();
        }

    }
?>
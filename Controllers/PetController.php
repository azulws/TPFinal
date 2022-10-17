<?php

    namespace Controllers;

    use DAO\PetDAO;
    use DAO\PetTypeDAO;
    use Models\Pet;
    use Models\PetType;

    class PetController {
        private $petDAO;
        private $petTypeDAO;

        public function __construct() {
            $this->petDAO = new PetDAO();
            $this->petTypeDAO = new PetTypeDAO();
        }

        public function ShowAddView($message = "") {
            require_once(VIEWS_PATH . "validate-session.php");
            $petTypeList = $this->petTypeDAO->getAll();
            require_once(VIEWS_PATH . "add-pet.php");
        }

        public function ShowListView() {
            require_once(VIEWS_PATH . "validate-session.php");
            $petList = $this->petDAO->GetAllByOwner($_SESSION["loggedUser"]->getIdOwner());
            require_once(VIEWS_PATH . "pet-list.php");
        }

        public function ShowAddImgView($id)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $pet = $this->petDAO->GetById($id);
            require_once(VIEWS_PATH . "add-img.php");
        }


        public function Add($name, $description, $petType) {
            require_once(VIEWS_PATH . "validate-session.php");

            $petTypeDAO = new PetTypeDAO();
            $type = $petTypeDAO->Exist(intval($petType));
            $idOwner = $_SESSION["loggedUser"]->getIdOWner();

            if($type) {
                $pet = new pet();
                $pet->setName($name);
                $pet->setPetType($type);
                $pet->setOwner($idOwner);
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

        public function UploadImg()
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $this->petDAO->UploadImg();
            $this->ShowListView();
        }

}
?>
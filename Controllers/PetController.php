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
            $petList = $this->petDAO->GetAllByOwner($_SESSION["loggedUser"]->getIdOwner());
            require_once(VIEWS_PATH . "pet-list.php");
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

        public function UploadImg($petImg)
        {
            $nombre_archivo = $_FILES['petImg']['name'];
            $tipo_archivo = $_FILES['petImg']['type'];
            $tamano_archivo = $_FILES['petImg']['size'];
                
            
            if (!((strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 100000))) {
                echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
            }else{
                if (move_uploaded_file($_FILES['petImg']['tmp_name'],  $nombre_archivo)){
                        echo "El archivo ha sido cargado correctamente.";
                }else{
                        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                } 
        }
    }
}
?>
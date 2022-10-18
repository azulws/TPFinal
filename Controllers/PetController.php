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

        public function ShowModifyView($id)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $pet = $this->petDAO->GetById($id);
            $petTypeList = $this->petTypeDAO->getAll();
            require_once(VIEWS_PATH . "modify-pet.php");
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


        public function Modify($id, $name , $description, $petType) {
            require_once(VIEWS_PATH . "validate-session.php");

            $petTypeDAO = new PetTypeDAO();
            $type = $petTypeDAO->Exist(intval($petType));
            $idOwner = $_SESSION["loggedUser"]->getIdOWner();

            if($type) {
                $pet = new pet();
                $pet->setId($id);
                $pet->setName($name);
                $pet->setPetType($type);
                $pet->setOwner($idOwner);
                $pet->setDescription($description);

                $this->petDAO->Modify($pet);

                $this->ShowListView();
            } else {
                $this->ShowAddView("El tipo de mascota ingresado no existe");
            }
        }


        public function UploadImg($id)
        {   
        
            $pet = $this->petDAO->GetById(intval($id));
            $file_path= IMG_PATH . $_SESSION["loggedUser"]->getUserName().'/';



            if(!file_exists($file_path)){
                mkdir($file_path);
            }
            $file_namePet = $_FILES['petImg']['name'];
            $file_typePet = $_FILES['petImg']['type'];
            $file_sizePet = $_FILES['petImg']['size'];
                
            
            if (!((strpos($file_typePet, "png") || strpos($file_typePet, "jpeg"))  && ($file_sizePet < 100000))) {
                echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
            }else{
                if (move_uploaded_file($_FILES['petImg']['tmp_name'], $file_path.$file_namePet)){
                        echo "El archivo ha sido cargado correctamente.";
                }else{
                        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                }
            }
            
                $file_nameVac = $_FILES['vaccination']['name'];
                $file_typeVac = $_FILES['vaccination']['type'];
                $file_sizeVac = $_FILES['vaccination']['size'];
                    
                
                if (!((strpos($file_typeVac, "png") || strpos($file_typeVac, "jpeg"))  && ($file_sizeVac < 100000))) {
                    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
                }else{
                    if (move_uploaded_file($_FILES['vaccination']['tmp_name'], $file_path.$file_nameVac)){
                            echo "El archivo ha sido cargado correctamente.";
                    }else{
                            echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                    }    
                }

                $pet->setImage($file_namePet);
                $pet->setVaccination($file_nameVac);
                $this->petDAO->Modify($pet);

            
        }


}
?>
<?php

    namespace Controllers;

    use DAO\PetDAO;
    use Models\Pet;
    use Models\PetType;

    class PetController {
        public $petDAO;
        private $petTypeController;

        public function __construct() {
            $this->petDAO = new PetDAO();
            $this->petTypeController = new PetTypeController();
        }

        public function ShowAddView($message = "") {
            require_once(VIEWS_PATH . "validate-session.php");
            $petTypeList = $this->petTypeController->petTypeDAO->getAll();
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
            $petTypeList = $this->petTypeController->petTypeDAO->getAll();
            require_once(VIEWS_PATH . "modify-pet.php");
        }

        public function ShowAddImgView($id)
        {
            require_once(VIEWS_PATH . "validate-session.php");
            $pet = $this->petDAO->GetById($id);
            require_once(VIEWS_PATH . "add-img.php");
        }




        public function Add($name, $description, $petType ,$size) {
            require_once(VIEWS_PATH . "validate-session.php");

            
            $type = $this->petTypeController->petTypeDAO->Exist(intval($petType));

            if($type) {
                $pet = new pet();
                $pet->setName($name);
                $pet->setPetType($type);
                $pet->setOwner($_SESSION["loggedUser"]);
                $pet->setDescription($description);
                $pet->setSize($size);

                $this->petDAO->Add($pet);

                
            } else {
                $this->ShowAddView("El tipo de mascota ingresado no existe");
            }
            $this->ShowListView();
        }

        public function Remove($id) {
            require_once(VIEWS_PATH . "validate-session.php");


            $this->petDAO->Remove(intval($id));

            $this->ShowListView();
        }


        public function Modify($id, $name , $size, $description) {
            require_once(VIEWS_PATH . "validate-session.php");

            
                $pet = $this->petDAO->GetById(intval($id));
                $pet->setId($id);
                $pet->setName($name);
                $pet->setPetType($type);
                $pet->setOwner($_SESSION["loggedUser"]);
                $pet->setDescription($description);

                $this->petDAO->Modify($pet);

                $this->ShowListView();
            
            }
        


        public function UploadImg($id , $petImg, $vaccination , $video)
        {    

            $pet = $this->petDAO->GetById(intval($id));
            $file_path= IMG_PATH . $_SESSION["loggedUser"]->getUserName().'/';

            if(!file_exists($file_path)){
                mkdir($file_path);
            }

            if($_FILES['petImg']['size'] != 0){

            $file_namePet = $_FILES['petImg']['name'];
            $file_typePet = $_FILES['petImg']['type'];
            $file_sizePet = $_FILES['petImg']['size'];

            if (!((strpos($file_typePet, "png") || strpos($file_typePet, "jpeg"))  && ($file_sizePet < 10000000))) {
                echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
            }else{
                if (move_uploaded_file($_FILES['petImg']['tmp_name'], $file_path.$file_namePet)){
                        echo "El archivo ha sido cargado correctamente.";
                        $pet->setImage($file_namePet);
                }else{
                        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                }
            }
            }
            if($_FILES['vaccination']['size'] != 0){
            
                $file_nameVac = $_FILES['vaccination']['name'];
                $file_typeVac = $_FILES['vaccination']['type'];
                $file_sizeVac = $_FILES['vaccination']['size'];
                    
                
                if (!((strpos($file_typeVac, "png") || strpos($file_typeVac, "jpeg"))  && ($file_sizeVac < 10000000))) {
                    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
                }else{
                    if (move_uploaded_file($_FILES['vaccination']['tmp_name'], $file_path.$file_nameVac)){
                            echo "El archivo ha sido cargado correctamente.";
                            $pet->setVaccination($file_nameVac);
                    }else{
                            echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                    }    
                }   
            }
            if(($_FILES['video']['tmp_name'] != 0)){
            
                $file_nameVid = $_FILES['video']['name'];
                $file_typeVid = $_FILES['video']['type'];
                $file_sizeVid = $_FILES['video']['size'];
                    
                
                if (!((strpos($file_typeVid, "mp4") || strpos($file_typeVid, "mpeg"))  && ($file_sizeVid < 150000000))) {
                    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
                }else{
                    if (move_uploaded_file($_FILES['video']['tmp_name'], $file_path.$file_nameVid)){
                            echo "El archivo ha sido cargado correctamente.";
                            $pet->setVideo($file_nameVid);
                    }else{
                            echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                    }    
                }   
            }
            
            $this->petDAO->Modify($pet);
            $this->ShowListView();       
        }   


}
?>
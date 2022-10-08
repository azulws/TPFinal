<?php
    namespace Controllers;

    use DAO\BeerTypeDAO as BeerTypeDAO;
    use Models\BeerType as BeerType;

    class BeerTypeController
    {
        private $beerTypeDAO;

        public function __construct()
        {
            $this->beerTypeDAO = new BeerTypeDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."add-beertype.php");
        }

        public function ShowListView()
        {
            $beerTypeList = $this->beerTypeDAO->GetAll();
            require_once(VIEWS_PATH."beertype-list.php");
        }

        public function Add($name, $description)
        {
            $beerType = new BeerType();
            $beerType->setName($name);
            $beerType->setDescription($description);

            $this->beerTypeDAO->Add($beerType);

            $this->ShowAddView();
        }

        public function Remove($id)
        {
            $this->beerTypeDAO->Remove($id);

            $this->ShowListView();
        }
    }
?>
<?php
    namespace Controllers;

    use DAO\BeerDAO as BeerDAO;
    use DAO\BeerTypeDAO as BeerTypeDAO;    
    use Models\Beer as Beer;
    use Models\BeerType as BeerType;

    class BeerController
    {
        private $beerDAO;
        private $beerTypeDAO;

        public function __construct()
        {
            $this->beerDAO = new BeerDAO();
            $this->beerTypeDAO = new BeerTypeDAO();
        }

        public function ShowAddView()
        {
            $beerTypeList = $this->beerTypeDAO->GetAll();

            require_once(VIEWS_PATH."add-beer.php");
        }

        public function ShowListView()
        {
            $beerList = $this->beerDAO->GetAll();
            $beerTypeList = $this->beerTypeDAO->GetAll();

            //For each beer for which we only have the beerTypeId, we get the complete beerType object and we assign it to it
            foreach($beerList as $beer)
            {
                $beerTypeId = $beer->getBeerType()->getId();
                $beerTypes = array_filter($beerTypeList, function($beerType) use($beerTypeId){                    
                    return $beerType->getId() == $beerTypeId;
                });

                $beerTypes = array_values($beerTypes); //Reordering array

                $beerType = (count($beerTypes) > 0) ? $beerTypes[0] : new BeerType(); //If beerType does not exist, we create an empty object to avid null reference

                $beer->setBeerType($beerType);
            }
            
            require_once(VIEWS_PATH."beer-list.php");
        }

        public function Add($code, $name, $beerTypeId, $description, $density, $price)
        {
            $beerType = new BeerType();
            $beerType->setId($beerTypeId);
                        
            $beer = new Beer();
            $beer->setBeerType($beerType);
            $beer->setCode($code);
            $beer->setName($name);
            $beer->setDescription($description);
            $beer->setDensity($density);
            $beer->setPrice($price);

            $this->beerDAO->Add($beer);

            $this->ShowAddView();
        }

        public function Remove($code)
        {
            $this->beerDAO->Remove($code);            

            $this->ShowListView();
        }
    }
?>
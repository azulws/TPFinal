<?php
    namespace DAO;

    use DAO\IBeerDAO as IBeerDAO;
    use Models\Beer as Beer;
    use Models\BeerType as BeerType;

    class BeerDAO implements IBeerDAO
    {
        private $beerList = array();
        private $fileName = ROOT."Data/beers.json";

        function Add(beer $beer)
        {
            $this->RetrieveData();

            $beer->setId($this->GetNextId());

            array_push($this->beerList, $beer);

            $this->SaveData();
        }

        function GetAll()
        {
            $this->RetrieveData();

            return $this->beerList;
        }

        function GetById($id)
        {
            $this->RetrieveData();

            $beers = array_filter($this->beerList, function($beer) use($id){
                return $beer->getId() == $id;
            });

            $beers = array_values($beers); //Reorderding array

            return (count($beers) > 0) ? $beers[0] : null;
        }

        function Remove($code)
        {
            $this->RetrieveData();

            $this->beerList = array_filter($this->beerList, function($beer) use($code){
                return $beer->getCode() != $code;
            });

            $this->SaveData();
        }

        private function RetrieveData()
        {
             $this->beerList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $beerType = new BeerType();                     
                     $beerType->setId($content["beerTypeId"]);

                     $beer = new beer();
                     $beer->setId($content["id"]);
                     $beer->setBeerType($beerType);
                     $beer->setCode($content["code"]);
                     $beer->setName($content["name"]);                       
                     $beer->setDescription($content["description"]);
                     $beer->setDensity($content["density"]);                     
                     $beer->setPrice($content["price"]);

                     array_push($this->beerList, $beer);
                 }
             }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->beerList as $beer)
            {
                $valuesArray = array();
                $valuesArray["id"] = $beer->getId();
                $valuesArray["beerTypeId"] = $beer->getBeerType()->getId();
                $valuesArray["code"] = $beer->getCode();
                $valuesArray["name"] = $beer->getName();
                $valuesArray["description"] = $beer->getDescription();
                $valuesArray["density"] = $beer->getDensity();
                $valuesArray["price"] = $beer->getPrice();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->beerList as $beer)
            {
                $id = ($beer->getId() > $id) ? $beer->getId() : $id;
            }

            return $id + 1;
        }
    }
?>
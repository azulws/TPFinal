<?php
    namespace DAO;

    use DAO\IBeerTypeDAO as IBeerTypeDAO;
    use Models\BeerType as BeerType;

    class BeerTypeDAO implements IBeerTypeDAO
    {
        private $beerTypeList = array();
        private $fileName = ROOT."Data/beerTypes.json";

        function Add(BeerType $beerType)
        {
            $this->RetrieveData();

            $beerType->setId($this->GetNextId());

            array_push($this->beerTypeList, $beerType);

            $this->SaveData();
        }

        function GetAll()
        {
            $this->RetrieveData();

            return $this->beerTypeList;
        }

        function GetById($id)
        {
            $this->RetrieveData();

            $beerTypes = array_filter($this->beerTypeList, function($beerType) use($id){
                return $beerType->getId() == $id;
            });

            $beerTypes = array_values($beerTypes); //Reorderding array

            return (count($beerTypes) > 0) ? $beerTypes[0] : null;
        }

        function Remove($id)
        {
            $this->RetrieveData();

            $this->beerTypeList = array_filter($this->beerTypeList, function($beerType) use($id){
                return $beerType->getId() != $id;
            });

            $this->SaveData();
        }

        private function RetrieveData()
        {
             $this->beerTypeList = array();

             if(file_exists($this->fileName))
             {
                 $jsonToDecode = file_get_contents($this->fileName);

                 $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();
                 
                 foreach($contentArray as $content)
                 {
                     $beerType = new beerType();
                     $beerType->setId($content["id"]);
                     $beerType->setName($content["name"]);
                     $beerType->setDescription($content["description"]);

                     array_push($this->beerTypeList, $beerType);
                 }
             }
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->beerTypeList as $beerType)
            {
                $valuesArray = array();
                $valuesArray["id"] = $beerType->getId();
                $valuesArray["name"] = $beerType->getName();
                $valuesArray["description"] = $beerType->getDescription();
                array_push($arrayToEncode, $valuesArray);
            }

            $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $fileContent);
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->beerTypeList as $beerType)
            {
                $id = ($beerType->getId() > $id) ? $beerType->getId() : $id;
            }

            return $id + 1;
        }
    }
?>
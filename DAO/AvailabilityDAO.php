<?php
    namespace DAO;

    use DAO\IAvailabilityDAO as IAvailabilityDAO;

    class Avialability implements IAvailability{
        private $avialabilityList= Array();
        private $fileName = ROOT . "/Data/avialability.json";

        public function Add(Avialability $avialability){
            $this->retrieveData();

            array_push($this->avialabilityList,$avialability);

            $this->saveData();
        }

        public function GetAll(){
            $this->retrieveData();
            return $this->avialabilityList;
        }

        public function GetByDate($date) {
            $avialability = null;
            $this->RetrieveData();

            $avialabilitys = array_filter($this->avialabilityList, function($avialability) use ($date) {
                return $avialability->getDate() == $date;
            });

            $avialabilitys= array_values($avialabilitys);
            return (count($avialabilitys) > 0) ? $avialabilitys[0] : null;
        }

        private function saveData(){
            $arrayToEncode= array();

            foreach($this->keeperList as $keeper){
                $value["date"]= $keeper->getDate();
                $value["keeperList"] = $keeper->getKeeperList();

                array_push($arrayToEncode, $value);
            }
            $jsonContent= json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName,$jsonContent);
        }

        private function retrieveData(){
            $this->avialabilityList= array();

            if(file_exists($this->fileName)){
                $jsonToDecode = file_get_contents($this->fileName);
                $arrayDecode = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

                foreach($arrayDecode as $value){
                    $avialability = new Avialability();
                    $avialability->setDate($value["date"]);
                    $avialability->setKeeperList($value["keeperList"]);

                    array_push($this->avialabilityList,$avialability);
                }
            }
        }

    }

?>
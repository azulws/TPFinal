<?php
    namespace DAO;

    use Models\Availability as Availability;
    use DAO\IAvailabilityDAO as IAvailabilityDAO;

    class AvailabilityDAO implements IAvailabilityDAO{
        private $avialabilityList= array();
        private $fileName = ROOT . "/Data/avialability.json";

        public function Add(Availability $avialability){
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

        public function GetDatesByUser($date,$user) {
            $avialability = null;
            $this->RetrieveData();

            $avialabilitys = array_filter($this->avialabilityList, function($avialability) use ($date,$user){
                return $avialability->getDate() == $date && $avialability->getKeeperName()==$user;
            });

            $avialabilitys= array_values($avialabilitys);
            return (count($avialabilitys) > 0) ? $avialabilitys[0] : null;
        }

        public function GetByUserName($userName) {
            $avialability = null;
            $this->RetrieveData();

            $avialabilitys = array_filter($this->avialabilityList, function($avialability) use ($userName) {
                return $avialability->getKeeperName() == $userName;
            });

            $avialabilitys= array_values($avialabilitys);
            return (count($avialabilitys) > 0) ? $avialabilitys[0] : null;
        }

        private function Remove($date){
            $this->RetrieveData();

            $this->avialabilityList = array_filter($this->avialabilityList, function($avialabilityList) use($date) {
                return $avialability->getDate() != $date;
            });

            $this->SaveData();
        }

        private function saveData(){
            $arrayToEncode= array();

            foreach($this->avialabilityList as $avialability){
                $value["date"]= $avialability->getDate();
                $value["keeperName"] = $avialability->getKeeperName();

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
                    $avialability = new Availability();
                    $avialability->setDate($value["date"]);
                    $avialability->setKeeperName($value["keeperName"]);

                    array_push($this->avialabilityList,$avialability);
                }
            }
        }

    }

?>
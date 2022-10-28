<?php
    namespace DAO;

    use Models\Availability as Availability;
    use DAO\IAvailabilityDAO as IAvailabilityDAO;

    class AvailabilityDAO implements IAvailabilityDAO{
        private $availabilityList= array();
        private $fileName = ROOT . "/Data/availability.json";

        public function Add(Availability $availability){
            $this->retrieveData();

            array_push($this->availabilityList,$availability);

            $this->saveData();
        }

        public function GetAll(){
            $this->retrieveData();
            return $this->availabilityList;
        }

        public function GetByDate($date) {
            $availability = null;
            $this->RetrieveData();

            $availabilitys = array_filter($this->availabilityList, function($availability) use ($date) {
                return $availability->getDate() == $date;
            });

            $availabilitys= array_values($availabilitys);
            return (count($availabilitys) > 0) ? $availabilitys[0] : null;
        }

        public function GetDatesByUser($date,$user) {
            $availability = null;
            $this->RetrieveData();

            $availabilitys = array_filter($this->availabilityList, function($availability) use ($date,$user){
                return $availability->getDate() == $date && $availability->getKeeperName()==$user;
            });

            $availabilitys= array_values($availabilitys);
            return (count($availabilitys) > 0) ? $availabilitys[0] : null;
        }

        public function GetByUserName($userName) {
            $availability = null;
            $this->RetrieveData();

            $availabilitys = array_filter($this->availabilityList, function($availability) use ($userName) {
                return $availability->getKeeperName() == $userName;
            });

            $availabilitys= array_values($availabilitys);
            return (count($availabilitys) > 0) ? $availabilitys[0] : null;
        }

        public function RemoveDateByUser($date,$user){
            $this->RetrieveData();

            $this->availabilityList = array_filter($this->availabilityList, function($availability) use($date,$user) {
                if($availability->getKeeperName() == $user){
                    return $availability->getDate() != $date;
                }          
            });

            $this->SaveData();
        }

        private function saveData(){
            $arrayToEncode= array();

            foreach($this->availabilityList as $availability){
                $value["date"]= $availability->getDate();
                $value["keeperName"] = $availability->getKeeperName();

                array_push($arrayToEncode, $value);
            }
            $jsonContent= json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName,$jsonContent);
        }

        private function retrieveData(){
            $this->availabilityList= array();

            if(file_exists($this->fileName)){
                $jsonToDecode = file_get_contents($this->fileName);
                $arrayDecode = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

                foreach($arrayDecode as $value){
                    $availability = new Availability();
                    $availability->setDate($value["date"]);
                    $availability->setKeeperName($value["keeperName"]);

                    array_push($this->availabilityList,$availability);
                }
            }
        }

    }

?>
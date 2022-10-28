<?php
    namespace Models;

    class Availability{
        private $date;
        private $keeperName;

        public function getDate(){
            return $this->date;
        }
        public function setDate($date){
            $this->date= $date;
        }

        public function getKeeperName(){
            return $this->keeperName;
        }
        public function setKeeperName($keeperName){
            $this->keeperName=$keeperName;
        }
    }
?>
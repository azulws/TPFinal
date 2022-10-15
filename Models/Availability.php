<?php
    namespace Models;

    class Avialability{
        private $date;
        private $keeperList;

        public function getDate(){
            return $this->date;
        }
        public function setDate($date){
            $this->date= $date;
        }

        public function getKeeperList(){
            return $this->keeperList;
        }
        public function setKeeperList($keeperList){
            $this->keeperListe=$keeperList;
        }
    }
?>
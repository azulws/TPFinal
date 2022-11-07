<?php
namespace Models;

use Models\Person as Person;

class Keeper extends User {

        private $idKeeper;
        private $remuneration;
        private $reputation;
        private $availability = array();
        private $sizes = array();


        public function getRemuneration()
        {
                return $this->remuneration;
        }

        public function setRemuneration($remuneration)
        {
                $this->remuneration = $remuneration;

        }



        public function getReputation()
        {
                return $this->reputation;
        }

        public function setReputation($reputation)
        {
                $this->reputation = $reputation;

        }


        public function getIdKeeper()
        {
                return $this->idKeeper;
        }

        public function setIdKeeper($idKeeper)
        {
                $this->idKeeper = $idKeeper;

        }


        public function getAvailability()
        {
                return $this->availability;
        }

        public function setAvailability($availability)
        {
                $this->availability = $availability;
        }

        /**
         * Get the value of sizes
         */ 
        public function getSizes()
        {
                return $this->sizes;
        }

        /**
         * Set the value of sizes
         *
         * @return  self
         */ 
        public function setSizes($sizes)
        {
                $this->sizes = $sizes;

        }
}
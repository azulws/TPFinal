<?php
namespace Models;

use Models\Person as Person;

class Keeper extends User {

        private $idKeeper;
        private $remuneration;
        private $reputation;
        


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
}
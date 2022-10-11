<?php
namespace Models;

use Models\Person as Person;
use Models\Dog as Dog;

class Owner extends Person {

    private $idOwner;


    /**
     * Get the value of idOwner
     */ 
    public function getIdOwner()
    {
        return $this->idOwner;
    }

    /**
     * Set the value of idOwner
     *
     * @return  self
     */ 
    public function setIdOwner($idOwner)
    {
        $this->idOwner = $idOwner;

        return $this;
    }
}
?>   
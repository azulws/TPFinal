<?php
namespace Models;



class Owner extends User {

    private $idOwner;

    public function getIdOwner()
    {
        return $this->idOwner;
    }

    public function setIdOwner($idOwner)
    {
        $this->idOwner = $idOwner;

        return $this;
    }
}
?>   
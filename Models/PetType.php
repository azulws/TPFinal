<?php
namespace Models;

class PetType{

    private $id;
    private $size;
    private $breed;


    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }


    public function setBreed($breed)
    {
        $this->breed = $breed;
    }

 
    public function getSize()
    {
        return $this->size;
    }

 
    public function setSize($size)
    {
        $this->size = $size;

    }


    public function getBreed()
    {
        return $this->breed;
    }
    }

  


?>
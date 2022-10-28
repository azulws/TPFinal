<?php
namespace Models;

class PetType{

    private $id;
    private $size;
    private $type;


    public function getId()
    {
        return $this->id;
    }

 
    public function setId($id)
    {
        $this->id = $id;
    }


    public function setType($type)
    {
        $this->type = $type;
    }

 
    public function getSize()
    {
        return $this->size;
    }

 
    public function setSize($size)
    {
        $this->size = $size;

    }


    public function getType()
    {
        return $this->type;
    }
    }

  


?>
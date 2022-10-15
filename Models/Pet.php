<?php
namespace Models;

use Models\PetType as PetType;
    
    class Pet {

        private $id;
        private $name;
        private $idOwner;
        private $petType;
        private $description;

        public function getId()
        {
                return $this->id;
        }


        public function setId($id)
        {
                $this->id = $id;

        }


        public function getName()
        {
                return $this->name;
        }


        public function setName($name)
        {
                $this->name = $name;
        }


        public function getIdOwner()
        {
                return $this->idOwner;
        }


        public function setIdOwner($idOwner)
        {
                $this->idOwner = $idOwner;
        }


        public function getPetType()
        {
                return $this->petType;
        }

        public function setPetType($petType)
        {
                $this->petType = $petType;

        }


        public function getDescription()
        {
                return $this->description;
        }

        public function setDescription($description)
        {
                $this->description = $description;

        }
    }
    



?>
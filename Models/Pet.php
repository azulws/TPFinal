<?php
namespace Models;

use Models\PetType as PetType;
    
    class Pet {

        private $id;
        private $name;
        private $Owner;
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


        public function getOwner()
        {
                return $this->Owner;
        }


        public function setOwner($Owner)
        {
                $this->Owner = $Owner;
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
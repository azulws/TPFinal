<?php
namespace Models;

use Models\DogType as DogType;
    
    class Dog {

        private $id;
        private $name;
        private $idOwner;
        private $dogType;
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


        public function getDogType()
        {
                return $this->dogType;
        }

        public function setDogType($dogType)
        {
                $this->dogType = $dogType;

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
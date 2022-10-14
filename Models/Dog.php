<?php
namespace Models;

use Models\DogType as DogType;
    
    class Dog {

        private $id;
        private $name;
        private $idOwner;
        private $dogType;
        private $description;


        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

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

        /**
         * Get the value of dogType
         */ 
        public function getDogType()
        {
                return $this->dogType;
        }

        /**
         * Set the value of dogType
         *
         * @return  self
         */ 
        public function setDogType(DogType $dogType)
        {
                $this->dogType = $dogType;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }
    }
    



?>
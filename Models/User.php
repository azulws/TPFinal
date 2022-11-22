<?php
    namespace Models;

    abstract class User{
        private $firstName;
        private $lastName;
        private $userName;
        private $password;
        private $email;

        function __construct(){
        }

        public function getFirstName(){
            return $this->firstName;
        }
        public function setFirstName($firstName){
            $this->firstName=$firstName;
        }
        
        public function getLastName(){
            return $this->lastName;
        }
        public function setLastName($lastName){
            $this->lastName=$lastName;
        }
        
        public function getUserName(){
            return $this->userName;
        }
        public function setUserName($userName){
            $this->userName=$userName;
        }

        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            $this->password=$password;
        }
    }
?>
<?php
    namespace Models;

    class Chat{
        private $id;
        private Keeper $idKeeper;
        private Owner $idOwner;
        private $msg;

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getIdKeeper()
        {
                return $this->idKeeper;
        }

        public function setIdKeeper(Keeper $idKeeper)
        {
                $this->idKeeper = $idKeeper;

                return $this;
        }

        public function getIdOwner()
        {
                return $this->idOwner;
        }

        public function setIdOwner(Owner $idOwner)
        {
                $this->idOwner = $idOwner;

                return $this;
        }

        public function getMsg()
        {
                return $this->msg;
        }

        public function setMsg($msg)
        {
                $this->msg = $msg;

                return $this;
        }
    }
?>
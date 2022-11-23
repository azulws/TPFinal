<?php
        namespace Models;
        use Models\Keeper as Keeper;
        use Models\Owner as Owner;

        class Chat{
                private $id;
                private Keeper $Keeper;
                private Owner $Owner;
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

                public function getKeeper()
                {
                        return $this->Keeper;
                }

                public function setKeeper(Keeper $Keeper)
                {
                        $this->Keeper = $Keeper;

                        return $this;
                }

                public function getOwner()
                {
                        return $this->Owner;
                }

                public function setOwner(Owner $Owner)
                {
                        $this->Owner = $Owner;

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
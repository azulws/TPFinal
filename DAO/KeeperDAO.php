<?php
    namespace DAO;

    use Models\Keeper as Keeper;
    use DAO\IkeeperDAO as IKeeperDAO;

    class KeeperDAO implements IKeeper{
        private $keeperList= Array();
        private $fileName = ROOT . "/Data/keepers.json";

        public function Add(Keeper $keeper){
            $this->retrieveData();

            $keeper->setIdKeeper($this->GetNextId());
            $keeper->setRemuneration("0");
            array_push($this->keeperList,$keeper);

            $this->saveData();
        }

        public function GetAll(){
            $this->retrieveData();
            return $this->keeperList;
        }

        public function GetByUserName($userName) {
            $keeper = null;
            $this->RetrieveData();

            $keepers = array_filter($this->keeperList, function($keeper) use ($userName) {
                return $keeper->getUserName() == $userName;
            });

            $keepers= array_values($keepers);
            return (count($keepers) > 0) ? $keepers[0] : null;
        }

        public function Remove($id){
            $this->retriveData();
            
            $this->keeperList= array_filter($this->keeperList, function($keeper) use($id){
                return $keeper->getIdKeeper() != $id;
            });

            $this->saveData();
        }

        private function saveData(){
            $arrayToEncode= array();

            foreach($this->keeperList as $keeper){
                $value["id"]= $keeper->getIdKeeper();
                $value["firstName"] = $keeper->getFirstName();
                $value["lastName"] = $keeper->getLastName();
                $value["userName"] = $keeper->getUserName();
                $value["password"] = $keeper->getPassword();
                $value["remuneration"]= $keeper->getRemuneration();

                array_push($arrayToEncode, $value);
            }
            $jsonContent= json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName,$jsonContent);
        }

        private function retrieveData(){
            $this->keeperList= array();

            if(file_exists($this->fileName)){
                $jsonToDecode = file_get_contents($this->fileName);
                $arrayDecode = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

                foreach($arrayDecode as $value){
                    $keeper = new Keeper();
                    $keeper->setIdKeeper($value["id"]);
                    $keeper->setFirstName($value["firstName"]);
                    $keeper->setLastName($value["lastName"]);
                    $keeper->setUserName($value["userName"]);
                    $keeper->setPassword($value["password"]);
                    $keeper->setRemuneration($value["remuneration"]);

                    array_push($this->keeperList,$keeper);
                }
            }
        }

        private function GetNextId(){
            $id = 0;
            foreach($this->keeperList as $keeper) {
                $id = ($keeper->getIdKeeper() > $id) ? $keeper->getIdKeeper() : $id;
            }
            return $id + 1;
        }
    }
?>
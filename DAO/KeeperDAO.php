<?php
    namespace DAO;

    use Models\Keeper as Keeper;

    class KeeperDAO implements IKeeper{
        private $keeperList= Array();
        private $fileName = ROOT . "/Data/keepers.json";

        public function Add(Keeper $keeper){
            $this->retrieveData();

            $keeper->setIdKeeper($this->GetNextId());
            array_push($this->keeperList,$Keeper);

            $this->saveData();
        }

        public function GetAll(){
            $this->retrieveData();
            return $this->keeperList;
        }

        public function GetByUserName($userName) {
            $this->RetrieveData();

            $user = null;

            $aux = array_filter($this->keeperList, function($keeper) use ($userName) {
                return $keeper->getUserName() === $userName;
            });

            return (count($aux) > 0) ? $aux[0] : null;
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
                $value["remuneration"]= $keeper->getRemuneration();

                array_push($keeperList, $value);
            }
            $jsonContent= json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName,$jsonContent);
        }

        private function retrieveData(){
            $this->keeperList= array();

            if(file_exists($this->fileName)){
                $jsonToDecode = file_get_contents($this->fileName);
                $arrayDecode = ($jsonDecode) ? json_decode($jsonToDecode, true) : array();

                foreach($arrayDecode as $value){
                    $keeper = new Keeper();
                    $keeper->setIdKeeper($value["id"]);
                    $keeper->setFirstName($value["firstName"]);
                    $keeper->setLastName($value["lastName"]);
                    $keeper->setUserName($value["userName"]);
                    $keeper->setRemuneration($value["remuneration"]);

                    array_push($this->keeperList,$keeper);
                }
            }
        }

        private function GetNextId(){
            $id = 0;
            foreach($this->ownerList as $keeper) {
                $id = ($keeper->getIdKeeper() > $id) ? $keeper->getIdOwner() : $id;
            }
            return $id + 1;
        }
    }
?>
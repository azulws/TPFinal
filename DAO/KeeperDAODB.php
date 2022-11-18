<?php
    namespace DAO;

    use Models\Keeper as Keeper;
    use DAO\IkeeperDAO as IKeeperDAO;
    use DAO\Connection as Connection;

    class KeeperDAODB implements IKeeper
    {
        private $connection;
        private $tableName = "keepers";
        
        public function Add(Keeper $keeper)
        {
            try{
                $query = "CALL Keeper_Add(?,?,?,?,?,?)";

                $parameters["firstName"] = $keeper->getFirstName();
                $parameters["lastName"] = $keeper->getLastName();
                $parameters["userName"] = $keeper->getUserName();
                $parameters["password"] = $keeper->getPassword();
                //$parameters["remuneration"] = $keeper->setRemuneration("0"); //se setea default        
                $value["availability"]= $keeper->getAvailability();
                $value["sizes"]= $keeper->getSizes();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll()
        {
            try{
                $keeperList = array();

                $query = "CALL Keeper_GetAll()";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, array(),QueryType::StoredProcedure);

                foreach($result as $row)
                {
                    $keeper = new Keeper();
                    $keeper->setIdKeeper($row["idKeeper"]);
                    $keeper->setFirstName($row["firstName"]);
                    $keeper->setLastName($row["lastName"]);
                    $keeper->setUserName($row["userName"]);
                    $keeper->setPassword($row["password"]);
                    $keeper->setRemuneration($row["remuneration"]);

                    array_push($keeperList, $keeper);
                }

                return $keeperList;
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove($id)
        {            
            try{
                $query = "CALL Keeper_Remove(?)";

                $parameters["idKeeper"] =  $idKeeper;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            }catch(Exception $ex){
                throw $ex;
            }
        }        

        public function GetByUserName($userName)
        {
            try{
                $keeper = null;

                $query = "CALL Keeper_GetByUserName(?)";

                $parameters["userName"] = $userName;

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

                foreach($results as $row)
                {
                    $keeper = new Keeper();
                    $keeper->setIdKeeper($row["idKeeper"]);
                    $keeper->setFirstName($row["firstName"]);
                    $keeper->setLastName($row["lastName"]);
                    $keeper->setUserName($row["userName"]);
                    $keeper->setPassword($row["password"]);
                    $keeper->setRemuneration($row["remuneration"]);
                }

                return $keeper;
            }catch(Exception $ex){
                throw $ex;
            }
        }  

        public function GetById($id) {
            try{
                $keeper = null;

                $query = "CALL Keeper_GetById(?)";

                $parameters["idKeeper"] = $id;

                $this->connection = Connection::GetInstance();

                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

                foreach($results as $row)
                {
                    $keeper = new Keeper();
                    $keeper->setIdKeeper($row["idKeeper"]);
                    $keeper->setFirstName($row["firstName"]);
                    $keeper->setLastName($row["lastName"]);
                    $keeper->setUserName($row["userName"]);
                    $keeper->setPassword($row["password"]);
                    $keeper->setRemuneration($row["remuneration"]);
                }

                return $keeper;
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function Modify(Keeper $modKeeper) {
            $this->RetrieveData();
            
            $this->keeperList = array_filter($this->keeperList, function($keeper) use($modKeeper) {
                return $keeper->getIdKeeper() != $modKeeper->getIdKeeper();
            });
            
            array_push($this->keeperList, $modKeeper);
            
            $this->saveData();
        }
    }
?>
<?php
    namespace DAO;

    use Models\Keeper as Keeper;
    use DAO\IkeeperDAO as IKeeperDAO;
    use DAO\Connection as Connection;

    class KeeperDAO implements IKeeper
    {
        private $connection;
        private $tableName = "keepers";
        
        public function Add(Keeper $keeper)
        {
            $query = "INSERT INTO ".$this->tableName." (idKeeper, firstName, lastName, userName, password) VALUES (:idKeeper, :firstName, :lastName, :userName, :password)";

            $parameters["idKeeper"] =  $keeper->getIdKeeper();
            $parameters["firstName"] = $keeper->getFirstName();
            $parameters["lastName"] = $keeper->getLastName();
            $parameters["userName"] = $keeper->getUserName();
            $parameters["password"] = $keeper->getPassword();
            $parameters["remuneration"] = $keeper->setRemuneration("0");          

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }

        public function GetAll()
        {
            $keeperList = array();

            $query = "SELECT idKeeper, firstName, lastName, userName, 'password' FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

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
        }

        public function Remove($id)
        {            
            $query = "DELETE FROM ".$this->tableName." WHERE (idKeeper = :idKeeper)";

            $parameters["idKeeper"] =  $idKeeper;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }        

        public function GetByUserName($userName)
        {
            $user = null;

            $query = "CALL Users_GetByUserName(?)";

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
            }

            return $keeper;
        }  
    }
?>
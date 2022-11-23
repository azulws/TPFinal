<?php

    namespace DAO;

    use Models\Chat as Chat;
    use Models\Keeper as Keeper;
    use Models\Owner as Owner;
    use DAO\IChatDAO as IChatDAO;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\OwnerDAO as OwnerDAO;

    class ChatDAO implements IChatDAO{
        private $connection;
        private $tableName = "messages"; 

        public function Add(Chat $chat){
            try
            {
                $query = "INSERT INTO ".$this->tableName." (idKeeper,idOwner,msg) VALUES (:idKeeper, :idOwner, :msg);";
                
                $parameters["idKeeper"] = $chat->getKeeper()->getIdKeeper();
                $parameters["idOwner"] = $chat->getOwner()->getIdOwner();
                $parameters["msg"] = $chat->getMsg();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetChat($idKeeper,$idOwner){
            try
            {
                $chatList = array();

                $query = "SELECT * FROM ".$this->tableName."";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $chat = new Chat();
                    $chat->setId($row["idMsg"]);

                    $keeperDAO= new KeeperDAO();
                    $keeper= $keeperDAO->GetById($row["idKeeper"]);
                    $chat->setKeeper($keeper);

                    $ownerDAO= new OwnerDAO();
                    $owner= $ownerDAO->GetById($row["idOwner"]);
                    $chat->setOwner($owner);

                    $chat->setMsg($row["msg"]);

                    array_push($chatList, $chat);
                }

                return $chatList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }         
    }
?>
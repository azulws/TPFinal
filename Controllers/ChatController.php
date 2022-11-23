<?php
    namespace controllers;
    use Models\Chat as Chat;
    use DAO\ChatDAO as ChatDAO;
    use DAO\KeeperDAO as KeeperDAO;
    use DAO\OwnerDAO as OwnerDAO;

    class ChatController{
        private $chatDAO;

        public function __construct(){
            $this->chatDAO= new ChatDAO();
        }

        public function ShowChatView($idKeeper){
            $chatList=$this->chatDAO->GetChat($idKeeper,$_SESSION["loggedUser"]->getIdOwner());

            require_once(VIEWS_PATH."chat.php");
        }

        public function Add($msg,$idKeeper,$idOwner){
            $chat = new Chat();
            $chat->setMsg($msg);

            $keeperDAO= new KeeperDAO();
            $keeper=$keeperDAO->GetById($idKeeper);
            $chat->setKeeper($keeper);
            $ownerDAO= new OwnerDAO();
            $owner=$ownerDAO->GetById($idOwner);
            $chat->setOwner($owner);

            $this->chatDAO->Add($chat);
            $this->ShowChatView($keeper->getIdKeeper());
        }
    }
?>

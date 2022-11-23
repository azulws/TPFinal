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

        public function ShowChatView($owner,$keeper){
            $idKeeper=$keeper;
            $idOwner=$owner;
            $chatList=$this->chatDAO->GetChat($keeper,$owner);
            require_once(VIEWS_PATH."chat.php");
        }

        public function ShowChatList(){
            $ownerList=$this->chatDAO->GetChatsByKeeper($_SESSION["loggedUser"]->getIdKeeper());
            require_once(VIEWS_PATH."my-chats.php");
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
            $this->ShowChatView($owner->getIdOwner(),$keeper->getIdKeeper());
        }
    }
?>

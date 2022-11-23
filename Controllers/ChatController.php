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

        public function ShowChatView($isKeeper,$owner,$keeper){
            $idKeeper=$keeper;
            $idOwner=$owner;
            $iskeeper=$isKeeper;

            $chatList=$this->chatDAO->GetChat($keeper,$owner);
            require_once(VIEWS_PATH."chat.php");
        }

        public function ShowChatKeeperView($isKeeper,$keeper,$owner){
            $idKeeper=$keeper;
            $idOwner=$owner;
            $iskeeper=$isKeeper;

            $chatList=$this->chatDAO->GetChat($keeper,$owner);
            require_once(VIEWS_PATH."chat.php");
        }

        public function ShowChatList(){
            $chatList=$this->chatDAO->GetChatsByKeeper($_SESSION["loggedUser"]->getIdKeeper());
            require_once(VIEWS_PATH."my-chats.php");
        }

        public function Add($msg,$idKeeper,$idOwner,$isKeeper){
            $chat = new Chat();
            $chat->setMsg($msg);

            $keeperDAO= new KeeperDAO();
            $keeper=$keeperDAO->GetById($idKeeper);
            $chat->setKeeper($keeper);
            
            $ownerDAO= new OwnerDAO();
            $owner=$ownerDAO->GetById($idOwner);
            $chat->setOwner($owner);

            $chat->setIsKeeper($isKeeper);
            
            $this->chatDAO->Add($chat);
            $this->ShowChatView($isKeeper,$owner->getIdOwner(),$keeper->getIdKeeper());
        }
    }
?>

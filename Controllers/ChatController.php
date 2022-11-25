<?php
    namespace controllers;
    use Models\Chat as Chat;
    use DAO\ChatDAO as ChatDAO;


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

        public function ShowChatKeeperView($isKeeper,$idKeeper,$idOwner){
            $idKeeper=$idKeeper;
            $idOwner=$idOwner;
            $iskeeper=$isKeeper;

            $chatList=$this->chatDAO->GetChat($idKeeper,$idOwner);
            require_once(VIEWS_PATH."chat.php");
        }

        public function ShowChatList(){
            $chatList=$this->chatDAO->GetChatsByKeeper($_SESSION["loggedUser"]->getIdKeeper());
            require_once(VIEWS_PATH."my-chats.php");
        }

        public function Add($msg,$idKeeper,$idOwner,$isKeeper){
            $chat = new Chat();
            $chat->setMsg($msg);

            $keeperController= new KeeperController();
            $keeper=$keeperController->GetById($idKeeper);
            $chat->setKeeper($keeper);
            
            $ownerController= new OwnerController();
            $owner=$ownerController->GetById($idOwner);
            $chat->setOwner($owner);

            $chat->setIsKeeper($isKeeper);
            
            $this->chatDAO->Add($chat);
            $this->ShowChatView($isKeeper,$owner->getIdOwner(),$keeper->getIdKeeper());
        }
    }
?>

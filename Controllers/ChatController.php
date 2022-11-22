<?php
    namespace controllers;
    use Models\Chat as Chat;
    use DAO\ChatDAO as ChatDAO;

    class ChatController{
        private $chatDAO;

        public function __construct(){
            $this->chatDAO= new ChatDAO();
        }

        public function ShowChatView($idKeeper){
            $chatList=$this->chatDAO->GetChat($idKeeper,$_SESSION["loggedUser"]->getIdOwner());

            require_once(VIEWS_PATH."chat.php");
        }

        public function Add($msg,$idK,$idO){
            $chat = new Chat();
            $chat->setMsg($msg);
            $chat->setIdKeeper($idK);
            $chat->setIdOwner($idO);

            $this->chatDAO->Add($chat);
            $this->ShowChatView($idK);
        }

        /*public function GetChat($idKeeper){
            $chatList=$this->chatDAO->GetChat($idKeeper,$_SESSION["loggedUser"]->getIdOwner());

            require_once(VIEWS_PATH."chat.php");
            //$this->ShowChatView();
        }*/
    }
?>

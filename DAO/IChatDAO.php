<?php

    namespace DAO;

    use Models\Chat as Chat;

    interface IChatDAO {
        function Add(Chat $chat);
        function GetChat($idKeeer,$idOwner);
    }
?>
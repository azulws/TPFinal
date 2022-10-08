<?php
    namespace DAO;

    use Models\Beer as Beer;

    interface IBeerDAO
    {
        function Add(Beer $beerType);
        function GetAll();
        function GetById($id);
        function Remove($id);
    }
?>
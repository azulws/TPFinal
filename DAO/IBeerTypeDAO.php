<?php
    namespace DAO;

    use Models\BeerType as BeerType;

    interface IBeerTypeDAO
    {
        function Add(BeerType $beerType);
        function GetAll();
        function GetById($id);
        function Remove($id);
    }
?>
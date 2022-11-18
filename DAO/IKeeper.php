<?php
    namespace DAO;

    use Models\Keeper as Keeper;

    interface IKeeper{
        function Add(Keeper $keeper);
        function GetAll();
        function Remove($id);
        function GetByUserName($userName);
        function GetById($id);
        function setAvailability(keeper $keeper);
        function SetSizes(keeper $keeper);

    }

?>
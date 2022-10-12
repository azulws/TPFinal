<?php
    namespace DAO;

    use Models\Keeper as Keeper;

    interface IKeeper{
        function Add(Keeper $keeper);
        function GetAll();
        function Remove($id);
    }

?>
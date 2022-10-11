<?php
    namespace DAO;

    use Models\Keeper as Keeper;

    interface class IKeeper{
        function Add(Keeper $keeper);
        function GetAll();
        function Remove($id);
    }

?>
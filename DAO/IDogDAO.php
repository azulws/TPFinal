<?php

    namespace DAO;

use Models\Dog;

    interface IDogDAO {
        function Add(Dog $dog);
        function Remove($id);
        function GetAll();
        function GetNextId();
    }
?>
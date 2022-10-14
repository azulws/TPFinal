<?php

    namespace DAO;

use Models\DogType;

    interface IDogTypeDAO {
        function Add(DogType $dogType);
        function Remove($id);
        function GetAll();
        function Exist($id);
        function GetNextId();
    }
?>
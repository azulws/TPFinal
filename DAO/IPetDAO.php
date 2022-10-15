<?php

    namespace DAO;

use Models\Pet;

    interface IPetDAO {
        function Add(Pet $pet);
        function Remove($id);
        function GetAll();
    }
?>
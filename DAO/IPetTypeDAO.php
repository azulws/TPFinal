<?php

    namespace DAO;

use Models\PetType;

    interface IPetTypeDAO {
        function Add(PetType $petType);
        function Remove($id);
        function GetAll();
        function Exist($id);
        function GetNextId();
    }
?>
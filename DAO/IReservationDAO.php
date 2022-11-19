<?php

    namespace DAO;

use Models\Reservation;

    interface IReservationDAO {
        function Add(Reservation $reservation);
        function Remove($id);
        function GetAll();
        function GetById($Id);
        function GetAllByKeeper($idKeeper);
        function GetAllByOwner($idOwner);
    }
?>
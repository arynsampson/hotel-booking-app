<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/config/connect.php';

    function fetchHotels() {
        global $conn;
        $sql = "SELECT * FROM hotel;";
        $result = $conn->query($sql);
        $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $hotels;
    }
    
?>
<?php

    function fetchHotel($id) {
        global $conn;
        $sql = "SELECT * FROM hotel where id='$id';";
        $result = $conn->query($sql);
        $hotel = $result->fetch_assoc();
        $_SESSION['hotel'] = $hotel;

        return $hotel;
    }

?>
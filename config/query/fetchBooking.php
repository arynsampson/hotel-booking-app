<?php

    function fetchBooking($id) {
        global $conn;
        $sql = "SELECT * FROM booking where id='$id';";
        $result = $conn->query($sql);
        $booking = $result->fetch_assoc();

        return $booking;
    }

?>
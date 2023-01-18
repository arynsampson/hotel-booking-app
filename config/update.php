<?php

    require './connect.php';

    $hotelID = $_GET['id'];

    $sql = "SELECT * from hotel WHERE id=$hotelID";
    $result = $conn->query($sql);
    $hotel = $result->fetch_assoc();

    echo json_encode($hotel);

?>
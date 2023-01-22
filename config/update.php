<?php

    require '../src/php/classes/DB.class.php';

    $hotelID = $_GET['id'];
    $db = new DB;

    $sql = "SELECT * from hotel WHERE id=$hotelID";
    $result = $db->conn->query($sql);
    $hotel = $result->fetch_assoc();

    echo json_encode($hotel);

?>
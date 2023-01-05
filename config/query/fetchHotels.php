<?php

    $sql = "SELECT * FROM hotel;";

    $result = $conn->query($sql);
    $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
?>
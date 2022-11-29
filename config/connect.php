<?php

    require '../../connection_details.php';

    $conn = new mysqli($SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: " . $conn->connect_error;
        exit();
    }

?>
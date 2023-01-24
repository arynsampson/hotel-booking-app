<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    session_start();

    $user = unserialize($_SESSION['user']);
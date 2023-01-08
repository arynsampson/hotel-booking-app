<?php

    session_start();

    require '../../../config/connect.php';

    $url = 'localhost'.$_SERVER['REQUEST_URI'];
    $res = parse_url($url);
    parse_str($res['query'], $params);
    $booking_id = $params['id'];
    
    $sql = "UPDATE booking SET status='CANCELLED' WHERE booking.id='$booking_id'";
    $result = $conn->query($sql);

    header('Location: /hotel-booking-app/src/views/bookings.view.php');

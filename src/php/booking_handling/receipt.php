<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/config/query/fetchBooking.php';
    session_start();
    $db = new DB;

    $user = unserialize($_SESSION['user']);
    $conn = $db->getConn();

    // get booking ID
    $bookingID = $_GET['id'];

    // get booking info
    $bookingInfo = fetchBooking($bookingID);
    
    // create booking array
    $bookingReceipt = array (
        "cust_id" => $user->getID(),
        "cust_name" => $user->getFullName(),
        "cust_email" => $user->getEmail(),
        "booking_id" => $bookingInfo['id'],
        "hotel_id" => $bookingInfo['hotel_id'],
        "hotel_name" => $bookingInfo['hotel_name'],
        "check-in" => $bookingInfo['check_in_date'],
        "check-out" => $bookingInfo['check_out_date'],
        "num_nights" => 4,
        "total_cost" => $bookingInfo['total'],
        "booking_created" => $bookingInfo['created_at'],
        "booking_status" => $bookingInfo['status']
    );

    // create receipt
    $data[] = $bookingReceipt;
    $data = json_encode($bookingReceipt, JSON_PRETTY_PRINT);
    file_put_contents('booking_receipt_'.$bookingInfo['id'].'.txt', $data);

    // navigate to bookings page
    header('Location: /hotel-booking-app/src/views/bookings.view.php');

?>
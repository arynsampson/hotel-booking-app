<?php

    require '../../../config/connect.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/config/query/fetchBooking.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Utils.class.php';
    session_start();

    $utils = new Utils;

    $bookingID = $_GET['id'];
    $booking = fetchBooking($bookingID);
    $currentDate = date('Y-m-d');
    $datesDifference = $utils->dateDifference($currentDate, $booking['check_in_date']);
    
    if($datesDifference > 2) {
        $sql = "UPDATE booking SET status='CANCELLED' WHERE booking.id='$bookingID'";
        $result = $conn->query($sql);
    } else {
        // TODO: add error message to bookings view
        $_SESSION['cancel_error'] = 'Bookings with check-in dates within 48 hours cannot be cancelled.';
    }

    header('Location: /hotel-booking-app/src/views/bookings.view.php');

?>
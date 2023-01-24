<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Utils.class.php';
    session_start();

    class BookingHandler {

        public $utils;
        public $db;

        public function __construct() {
            $this->utils = new Utils;
            $this->db = new DB;
        }

        public function cancelBooking() {
            $bookingID = $_GET['id'];
            $booking = $this->db->fetchBooking($bookingID);
            $currentDate = date('Y-m-d');
            $datesDifference = $this->utils->dateDifference($currentDate, $booking['check_in_date']);
    
            if($datesDifference > 2) {
                $sql = "UPDATE booking SET status='CANCELLED' WHERE booking.id='$bookingID'";
                $result = $this->db->conn->query($sql);
            } else {
                //TODO: add error message to bookings view
                $_SESSION['cancel_error'] = 'Bookings with check-in dates within 48 hours cannot be cancelled.';
            }
            header('Location: /hotel-booking-app/src/views/bookings.view.php');
        }

        public function confirmBooking() {

        }

        public function downloadReceipt() {
            $user = unserialize($_SESSION['user']);

            // get booking ID
            $bookingID = $_GET['id'];

            // get booking info
            $bookingInfo = $this->db->fetchBooking($bookingID);
            
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
        }
    }

    $bookingHandler = new BookingHandler;
    $action = $_GET['action'];

    switch($action) {
        case 'Cancel': 
            $bookingHandler->cancelBooking();
            break;
        case 'Confirm': 
            $bookingHandler->confirmBooking();
            break;
        case 'Receipt': 
            $bookingHandler->downloadReceipt();
            break;                    
    }
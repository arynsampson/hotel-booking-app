<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Utils.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Booking.class.php';
    session_start();

    class BookingHandler {

        public $utils;
        public $db;

        public function __construct() {
            $this->utils = new Utils;
            $this->db = new DB;
        }

        // confirm booking dates
        public function confirmHotelDates() {
            if(isset($_POST['booking-hotel'])) {
                $hotelDates = $this->utils->validateDates($_POST['check-in'], $_POST['check-out']);
        
                if($hotelDates[1][0] === '' && $hotelDates[1][1] === '' && $hotelDates[1][2] === '') {
                    $_SESSION['booking-information'] = $_POST;
                    $_SESSION['booking-information']['name'] = $_SESSION['hotel']['name'];
                    $_SESSION['booking-information']['daily_rate'] = $_SESSION['hotel']['daily_rate'];
                    $_SESSION['booking-information']['totalNights'] = $this->utils->dateDifference($_SESSION['booking-information']['check-in'], $_SESSION['booking-information']['check-out']);
                    $_SESSION['booking-information']['totalStayCost'] = $this->utils->totalStayCost($_SESSION['booking-information']['totalNights'], $_SESSION['hotel']['daily_rate']);
                    header('Location: /hotel-booking-app/src/views/confirmBooking.view.php');
                } else {
                    $_SESSION['hotelDates'] = $hotelDates;
                    header('Location: /hotel-booking-app/src/views/hotelDetails.view.php/?id='.$_GET['id']);
                }
            } 
        }

        // confirm booking and add to db
        public function confirmBooking() {
            $user = unserialize($_SESSION['user']);

            $booking = new Booking(
                $user->getID(),
                $user->getEmail(),
                $_SESSION['hotel']['id'],
                $_SESSION['booking-information']['name'],
                $_SESSION['booking-information']['check-in'],
                $_SESSION['booking-information']['check-out'],
                $_SESSION['booking-information']['totalNights'],
                $_SESSION['booking-information']['totalStayCost'],
                'CONFIRMED'
            );

            $user = serialize($user);
            $booking = serialize($booking);

            $this->db->addBookingToDB($user, $booking);
            header('Location: /hotel-booking-app');
        }

        // download receipt for booking
        public function downloadReceipt($id) {
            $user = unserialize($_SESSION['user']);

            // get booking info
            $bookingInfo = $this->db->fetchBooking($id);
            
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

        // cancel a booking
        public function cancelBooking($id) {
            $_SESSION['cancel_error'] = '';
            $booking = $this->db->fetchBooking($id);
            $currentDate = date('Y-m-d');
            $datesDifference = $this->utils->dateDifference($currentDate, $booking['check_in_date']);
    
            if($datesDifference > 2) {
                $sql = "UPDATE booking SET status='CANCELLED' WHERE booking.id='$id'";
                $result = $this->db->conn->query($sql);
                foreach($_SESSION['bookings'] as $booking) {
                    $booking = unserialize($booking);
                    if($booking->getHotelID() === $id) {
                        $booking->setBookingStatus('CANCELLED');
                    }
                }
                $_SESSION['cancel_message'] = "Booking #$id cancelled successfully.";
            } else {
                $_SESSION['cancel_message'] = 'Bookings with check-in dates within 48 hours cannot be cancelled.';
            }

            header('Location: /hotel-booking-app/src/views/bookings.view.php');
        }
    }

    $bookingHandler = new BookingHandler;
    $action = $_GET['action'];

    switch($action) {
        case 'Cancel': 
            $bookingHandler->cancelBooking($_GET['id']);
            break;
        case 'Confirm': 
            $bookingHandler->confirmBooking();
            break;
        case 'Receipt': 
            $bookingHandler->downloadReceipt($_GET['id']);
            break;                    
        case 'Dates': 
            $bookingHandler->confirmHotelDates();
            break;                    
    }
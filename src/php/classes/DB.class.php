<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/tables.php';

    class DB {
        private static $server = 'localhost';
        private static $username = 'admin';
        private static $password = 'password1234';
        private static $db = 'hotel';
        public static $conn;
        public static $tablesCreated = false;

        static public function init() {
            self::$conn = new mysqli(self::$server, self::$username, self::$password, self::$db);
        }

        // create tables
        public static function createTables() {
            global $bookingTable; global $hotelTable; global $userTable;  
            self::$conn->query($bookingTable);
            self::$conn->query($userTable);
            self::$conn->query($hotelTable);
            self::$tablesCreated = true;
        }

        public static function getTablesCreated() {
            return self::$tablesCreated;
        }

        // fetch user
        public static function fetchUser($email) {
            $sql = "SELECT id, firstname, lastname, email, password FROM user WHERE user.email = '$email'";
            
            $result = self::$conn->query($sql);
    
            if($result->num_rows > 0) {
                $user = $result->fetch_assoc();
 
                return $user;
            }
        }

        // fetch hotel
        public static function fetchHotel($id) {
            $sql = "SELECT * FROM hotel where id='$id';";
            $result = self::$conn->query($sql);
            $hotel = $result->fetch_assoc();
            $_SESSION['hotel'] = $hotel; 
            return $hotel;
        }

        // fetch hotel to compare to booking
        public static function fetchHotelToCompare($id) {
            $sql = "SELECT * from hotel WHERE id=$hotelID";
            $result = self::$conn->query($sql);
            $hotel = $result->fetch_assoc(); 
            echo json_encode($hotel);
        }

        // fetch all hotels
        public static function fetchHotels() {
            $sql = "SELECT * FROM hotel;";
            $result = self::$conn->query($sql);
            $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC); 
            return $hotels;
        }

        // add booking to db
        public static function addBookingToDB($user, $booking) {
            $user = unserialize($user);
            $booking = unserialize($booking);
            $sql = "INSERT INTO booking (user_id, email, hotel_id, hotel_name, check_in_date, check_out_date, totalNights, totalCost, status) VALUES (
                '".$user->getID()."',
                '".$user->getEmail()."',
                '".$booking->getHotelID()."',
                '".$booking->getHotelName()."',
                '".$booking->getCheckIn()."',
                '".$booking->getCheckOut()."',
                '".$booking->getTotalNights()."',
                '".$booking->getTotalCost()."',
                '".$booking->getBookingStatus()."'
            )";
            self::$conn->query($sql); 
        }

        // fetch booking
        public static function fetchBooking($id) {
            $sql = "SELECT * FROM booking where id='$id';";
            $result = self::$conn->query($sql);
            $booking = $result->fetch_assoc(); 
            return $booking;
        }

        // fetch all bookings
        public static function fetchAllBookings($userID) {
            $sql = "SELECT * FROM booking WHERE booking.user_id='$userID'";
            $result = self::$conn->query($sql);
            if($result->num_rows > 0) {
                $bookings = $result->fetch_all();
                return $bookings;
            }
        }

        //update booking status
        public static function updateBookingStatus($id, $status) {
            $sql = "UPDATE booking SET status='$status' WHERE booking.id='$id'";
            $result = self::$conn->query($sql);
        }

    }


    DB::init();
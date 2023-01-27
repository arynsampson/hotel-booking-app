<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/tables.php';

    class DB {
        private $server = 'localhost';
        private $username = 'admin';
        private $password = 'password1234';
        private $db = 'hotel';
        public $conn;
        public $tablesCreated = false;

        public function __construct() {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        }

        public function endConn() {
            $this->conn->close();
        }

        // create tables
        public function createTables() {
            global $bookingTable; global $hotelTable; global $userTable;  
            $this->conn->query($bookingTable);
            $this->conn->query($userTable);
            $this->conn->query($hotelTable);
            $this->tablesCreated = true;
        }

        public function getTablesCreated() {
            return $this->tablesCreated;
        }

        // fetch user
        public function fetchUser($email) {
            $sql = "SELECT id, firstname, lastname, email FROM user WHERE user.email = '$email'";
            
            $result = $this->conn->query($sql);
    
            if($result->num_rows > 0) {
                $user = $result->fetch_assoc();
 
                return $user;
            }
        }

        // fetch hotel
        public function fetchHotel($id) {
            $sql = "SELECT * FROM hotel where id='$id';";
            $result = $this->conn->query($sql);
            $hotel = $result->fetch_assoc();
            $_SESSION['hotel'] = $hotel; 
            return $hotel;
        }

        // fetch hotel to compare to booking
        public function fetchHotelToCompare($id) {
            $sql = "SELECT * from hotel WHERE id=$hotelID";
            $result = $this->conn->query($sql);
            $hotel = $result->fetch_assoc(); 
            echo json_encode($hotel);
        }

        // fetch all hotels
        public function fetchHotels() {
            $sql = "SELECT * FROM hotel;";
            $result = $this->conn->query($sql);
            $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC); 
            return $hotels;
        }

        // add booking to db
        public function addBookingToDB($user, $booking) {
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
            $this->conn->query($sql); 
        }

        // fetch booking
        public function fetchBooking($id) {
            $sql = "SELECT * FROM booking where id='$id';";
            $result = $this->conn->query($sql);
            $booking = $result->fetch_assoc(); 
            return $booking;
        }

        // fetch all bookings
        public function fetchAllBookings($userID) {
            $sql = "SELECT * FROM booking WHERE booking.user_id='$userID'";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0) {
                $bookings = $result->fetch_all();
                return $bookings;
            }
        }

        //update booking status
        public function updateBookingStatus($id, $status) {
            $sql = "UPDATE booking SET status='$status' WHERE booking.id='$id'";
            $result = $this->conn->query($sql);
        }

    }
<?php

    class DB {
        private $server = 'localhost';
        private $username = 'admin';
        private $password = 'password1234';
        private $db = 'hotel';
        public $conn;

        public function __construct() {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        }

        public function endConn() {
            $this->conn->close();
        }

        // fetch user
        function fetchUser($email) {
            $sql = "SELECT id, firstname, lastname, email FROM user WHERE user.email = '$email'";
            
            $result = $this->conn->query($sql);
    
            if($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                return $user;
            }
            return;
        }

        // fetch hotel
        function fetchHotel($id) {
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
        function fetchHotels() {
            $sql = "SELECT * FROM hotel;";
            $result = $this->conn->query($sql);
            $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
            return $hotels;
        }

        // create booking

        // cancel booking
        function cancelBooking() {

        }

        // fetch booking
        function fetchBooking($id) {
            $sql = "SELECT * FROM booking where id='$id';";
            $result = $this->conn->query($sql);
            $booking = $result->fetch_assoc();
    
            return $booking;
        }

    }
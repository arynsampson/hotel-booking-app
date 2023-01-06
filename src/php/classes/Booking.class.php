<?php

    class Booking {
        // user name, user email, user id, hotel name & id, total cost, dates, booking status

        private $username;
        private $email;
        private $hotel_name;
        private $total_cost;
        private $check_in;
        private $check_out;
        public $booking_status;

        function __construct(
                $username, 
                $email, 
                $hotel_name,
                $total_cost, 
                $check_in, 
                $check_out, 
                $booking_status
        ) {
            $this->username = $username;
            $this->email = $email;
            $this->hotel_name = $hotel_name;
            $this->total_cost = $total_cost;
            $this->check_in = $check_in;
            $this->check_out = $check_out;
            $this->booking_status = $booking_status;
        }

        public function getBookingStatus() {
            return $this->booking_status;
        }
        
        public function setBookingStatus($booking_status) {
            $this->booking_status = $booking_status;
        }
    }
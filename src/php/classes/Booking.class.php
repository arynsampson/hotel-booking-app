<?php

    class Booking {
        // user name, user email, user id, hotel name & id, total cost, dates, booking status
        private $userID;
        private $email;
        private $hotelID;
        private $hotelName;
        private $totalCost;
        private $checkIn;
        private $checkOut;
        private $totalNights;
        public $bookingStatus = false;

        function __construct(
                $userID,
                $email, 
                $hotelID,
                $hotelName,
                $checkIn, 
                $checkOut,
                $totalNights,
                $totalCost, 
                $bookingStatus
        ) {
            $this->userID = $userID;
            $this->email = $email;
            $this->hotelID = $hotelID;
            $this->hotelName = $hotelName;
            $this->checkIn = $checkIn;
            $this->checkOut = $checkOut;
            $this->totalNights = $totalNights;
            $this->totalCost = $totalCost;
            $bookingStatus;
        }

        public function getUserID() {
            return $this->userID;
        }
        public function getEmail() {
            return $this->email;
        }
        public function getHotelID() {
            return $this->hotelID;
        }
        public function getHotelName() {
            return $this->hotelName;
        }
        public function getCheckIn() {
            return $this->checkIn;
        }
        public function getCheckOut() {
            return $this->checkOut;
        }
        public function getTotalNights() {
            return $this->totalNights;
        }
        public function getTotalCost() {
            return $this->totalCost;
        }
        public function getBookingStatus() {
            return $this->bookingStatus;
        }
        
        public function setBookingStatus($bookingStatus) {
            $this->bookingStatus = $bookingStatus;
        }

    }
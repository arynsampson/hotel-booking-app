<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Utils.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Booking.class.php';

    class HotelHandler {

        public $db;

        public function __construct() {
            $this->db = new DB;
        }

        public function fetchHotelToCompare($id) {
            $sql = "SELECT * from hotel WHERE id=$id";
            $result = $this->db->conn->query($sql);
            $hotel = $result->fetch_assoc();
        
            echo json_encode($hotel);
        }
    }

    $hotelHandler = new HotelHandler;
    $action = $_GET['action'];

    switch($action) {
        case 'fetchHotel': 
            $hotelHandler->fetchHotelToCompare($_GET['id']);
            break;                  
    }
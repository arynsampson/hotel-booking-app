<?php

session_start(); 


$booking_info = array(
    "hotel_name" => "Grand Kloof Hotel",
    "num_rooms" => 2,
    "num_nights" => 3,
    "daily_rate" => 2700,
    "rating" => 5,
    "total_cost" => 16200
);

if(isset($_POST['confirm-booking'])) {
    header('Location: /hotel-booking-app');
}
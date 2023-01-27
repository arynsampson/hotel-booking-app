<?php

$bookingTable = "CREATE TABLE IF NOT EXISTS booking (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    email VARCHAR(255) NOT NULL,
    hotel_id INT(11) NOT NULL,
    hotel_name VARCHAR(255) NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    totalNights INT(11),
    totalCost INT(11),
    status VARCHAR(255),
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP()
    )";

$hotelTable = "CREATE TABLE IF NOT EXISTS hotel (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    daily_rate INT(11) NOT NULL,
    thumbnail VARCHAR(255) NOT NULL,
    features VARCHAR(255) NULL,
    rating INT(11) NOT NULL,
    address VARCHAR(255) NOT NULL
    )";

$userTable = "CREATE TABLE IF NOT EXISTS user (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP()
    )";
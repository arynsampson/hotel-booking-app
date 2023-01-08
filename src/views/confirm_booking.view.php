<?php

    session_start(); 

    require '../php/classes/Booking.class.php';
    require '../../config/connect.php';

    $booking_info = array(
        "hotel_name" => "Grand Kloof Hotel",
        "num_rooms" => 2,
        "num_nights" => 3,
        "daily_rate" => 2700,
        "rating" => 5,
        "total_cost" => 16200
    );

    if(isset($_POST['confirm-booking'])) {

        $booking = new Booking(
            $_SESSION['loggedInUser']['fullname'],
            $_SESSION['loggedInUser']['email'],
            $booking_info['hotel_name'],
            $booking_info['total_cost'],
            $_SESSION['booking-information']['check-in'],
            $_SESSION['booking-information']['check-out'],
            false
        );

        global $conn;

        $sql = "INSERT INTO booking (user_id, hotel_id, check_in_date, check_out_date, total, status) VALUES (
            '".$_SESSION['loggedInUser']['id']."',
            2,
            '".$_SESSION['booking-information']['check-in']."',
            '".$_SESSION['booking-information']['check-out']."',
            '".$booking_info['total_cost']."',
            'CONFIRMED'
        )";

        $result = $conn->query($sql);
        
        header('Location: /hotel-booking-app');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../style/style.css">
    <title>Hotel Booking</title>
</head>
<body>

    <?php require '../templates/header.template.php'; ?>

    <div class="main-container">
        <h2 class="confirm-booking-header">Confirm booking</h2>

        <div class="confirm-info-wrapper">

            <div class="user-info-wrapper">
                <h4>Customer details:</h4>
                <div class="user-info">
                    <p>Customer: <?php echo $_SESSION['fullname']; ?></p>
                    <p>Email: <?php echo $_SESSION['loggedInUser']['email']; ?></p>
                    <p>Customer ID: <?php echo $_SESSION['loggedInUser']['id']; ?></p>
                </div>
            </div>

            <div class="booking-info-wrapper">
                <h4>Hotel details:</h4>
                <div class="booking-info">
                    <p>Hotel name: <?php echo $booking_info['hotel_name']; ?></p>
                    <p>Number of rooms: <?php echo $booking_info['num_rooms']; ?></p>
                    <p>Amount of nights: <?php echo $booking_info['num_nights']; ?></p>
                    <p>Price per night: R<?php echo $booking_info['daily_rate']; ?></p>
                    <p>Rating: <?php echo $booking_info['rating']; ?></p>
                    <p>Total cost: R<?php echo $booking_info['total_cost']; ?></p>
                </div>
            </div>

            <div class="confirm-booking-form">
                <form action="confirm_booking.view.php" method="POST">
                    <input type="submit" value="Book" name="confirm-booking">
                </form>
            </div>
            
        </div>
        
    </div>
    
</body>
</html>
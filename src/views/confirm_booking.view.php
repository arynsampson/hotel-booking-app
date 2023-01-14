<?php

    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/config/connect.php';
    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Booking.class.php';
    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Utils.class.php';
    session_start(); 

    $utils = new Utils;
    $user = unserialize($_SESSION['user']);

    $num_nights = $utils->dateDifference($_SESSION['booking-information']['check-in'], $_SESSION['booking-information']['check-out']);
    $totalStayCost = $utils->totalStayCost($num_nights, $_SESSION['hotel']['daily_rate']);

    $booking_info = array(
        "hotel_name" => $_SESSION['hotel']['name'],
        "check-in" => $_SESSION['booking-information']['check-in'],
        "check-out" => $_SESSION['booking-information']['check-out'],
        "num_nights" => $num_nights,
        "daily_rate" => $_SESSION['hotel']['daily_rate'],
        "total_cost" => $totalStayCost
    );

    if(isset($_POST['confirm-booking'])) {

        $booking = new Booking(
            $user->getFullName(),
            $user->getEmail(),
            $booking_info['hotel_name'],
            $booking_info['total_cost'],
            $_SESSION['booking-information']['check-in'],
            $_SESSION['booking-information']['check-out'],
            false
        );

        global $conn;

        $sql = "INSERT INTO booking (user_id, username, hotel_id, hotel_name, check_in_date, check_out_date, total, status) VALUES (
            '".$user->getID()."',
            '".$user->getEmail()."',
            '".$_SESSION['hotel']['id']."',
            '".$_SESSION['hotel']['name']."',
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
                    <p>Customer: <?php echo $user->getFullName(); ?></p>
                    <p>Email: <?php echo $user->getEmail(); ?></p>
                    <p>Customer ID: <?php echo $user->getID();; ?></p>
                </div>
            </div>

            <div class="booking-info-wrapper">
                <h4>Hotel details:</h4>
                <div class="booking-info">
                    <p>Hotel name: <?php echo $booking_info['hotel_name']; ?></p>
                    <p>Check-in: <?php echo $_SESSION['booking-information']['check-in']; ?></p>
                    <p>Check-out: <?php echo $_SESSION['booking-information']['check-out']; ?></p>
                    <p>Amount of nights: <?php echo $booking_info['num_nights']; ?></p>
                    <p>Price per night: R<?php echo $booking_info['daily_rate']; ?></p>
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
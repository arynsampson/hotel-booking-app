 <?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Utils.class.php';
    session_start();

    if($_SESSION['isLoggedIn'] === false) {
        header('Location: /hotel-booking-app/src/views/login.view.php');
    }

    $hotel = DB::fetchHotel($_GET['id']);

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../../style/style.css">
    <title>Hotel Booking</title>
</head>
<body>
    
    <?php require '../templates/header.template.php'; ?>

    <div class="main-container">
        <div class="hotel-details-card">
    
            <h2 class="hotel-name"><?php echo $hotel['name']; ?></h2>
            <img src="<?php echo $hotel['thumbnail']; ?>" alt="hotel-img" class="hotel-img">

            <div class="hotel-info-wrapper">
                <div>
                    <p class="hotel-info">Price per night: R<?php echo $hotel['daily_rate']; ?></p>
                    <p class="hotel-info">Rating: <?php echo $hotel['rating']; ?></p>
                    <p class="hotel-info">Address: <?php echo $hotel['address']; ?></p>
                </div>

                <div class="hotel-features">
                    <p class="hotel-feature">Wi-fi</p>
                    <p class="hotel-feature">Pool</p>
                    <p class="hotel-feature">Spa</p>
                    <p class="hotel-feature">Free breakfast</p>
                    <p class="hotel-feature">Bar</p>
                </div>
            </div>

            <div class="hotel-dates">
                <form action="<?php echo '/hotel-booking-app/src/php/handling/bookings/BookingHandler.php/?id='.$_GET['id'].'&action=Dates'; ?>" method="POST" class="dates-form">
                    <div class="check-in-wrapper">
                        <label for="check-in">Check-in date:</label>
                        <input type="date" name="check-in" value="<?php echo $_POST['check-in'] ?? ''; ?>">
                        <p class="error"><?php echo $_SESSION['hotelDates'][1][1] ?? ''; ?></p>
                    </div>
                    <div class="check-out-wrapper">
                        <label for="check-in">Check-out date:</label>
                        <input type="date" name="check-out" value="<?php echo $_POST['check-out'] ?? ''; ?>">
                        <p class="error"><?php echo $_SESSION['hotelDates'][1][2] ?? ''; ?></p>
                    </div>

                    <p class="error"><?php echo $_SESSION['hotelDates'][1][0] ?? ''; ?></p>

                    <input type="submit" value="Book" name="booking-hotel">
                </form>
            </div>
        
        </div>
    </div>
    
</body>
</html>
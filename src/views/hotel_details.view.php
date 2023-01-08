 <?php

    session_start();
    
    require '../../config/connect.php';
    require '../../config/query/fetchHotel.php';
    require '../php/validations/dateValidator.php';

    if($_SESSION['isLoggedIn'] === false) {
        header('Location: /hotel-booking-app/src/views/sign_in.view.php');
    }

    // $url = 'localhost'.$_SERVER['REQUEST_URI'];
    // $res = parse_url($url);
    // parse_str($res['query'], $params);
    // $hotel = fetchHotel($params['id']);
    // $_SESSION['hotel_id'] = $params['id'];
        
    if(isset($_POST['booking-hotel'])) {
        $hotel_dates = validateDates($_POST['check-in'], $_POST['check-out']);

        print_r($hotel_dates);

        if(empty($hotel_dates[1])) {
            $_SESSION['booking-information'] = $_POST;
            header('Location: /hotel-booking-app/src/views/confirm_booking.view.php');
        }
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
    <link rel="stylesheet" href="../../style/style.css">
    <title>Hotel Booking</title>
</head>
<body>
    
    <?php require '../templates/header.template.php'; ?>

    <div class="main-container">
        <div class="hotel-details-card">
    
            <!-- <h2 class="hotel-name"><?php echo $hotel['name']; ?></h2>
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
            </div> -->

            <div class="hotel-dates">
                <form action="hotel_details.view.php" method="POST" class="dates-form">
                    <div class="check-in-wrapper">
                        <label for="check-in">Check-in date:</label>
                        <input type="date" name="check-in" value="<?php echo $hotel_dates[0]['check-in'] ?? ''; ?>">
                        <p class="error"><?php echo $hotel_dates[1][1] ?? ''; ?></p>
                    </div>
                    <div class="check-out-wrapper">
                        <label for="check-in">Check-out date:</label>
                        <input type="date" name="check-out" value="<?php echo $hotel_dates[0]['check-out'] ?? ''; ?>">
                        <p class="error"><?php echo $hotel_dates[1][2] ?? ''; ?></p>
                    </div>

                    <p class="error"><?php echo $hotel_dates[1][0] ?? ''; ?></p>

                    <input type="submit" value="Book" name="booking-hotel">
                </form>
            </div>
        
        </div>
    </div>
    
</body>
</html>
<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/user.php';

    $db = new DB;

    $hotels = $db->fetchHotels();

    foreach($hotels as $hotel) {
        if($hotel['id'] === $_SESSION['hotel']['id']) {
                $indx = $_SESSION['hotel']['id'] - 1;
                array_splice($hotels, $indx, 1);
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
                    <p>Hotel name: <?php echo $_SESSION['booking-information']['name']; ?></p>
                    <p>Rating: <?php echo $_SESSION['hotel']['rating']; ?></p>
                    <p>Check-in: <?php echo $_SESSION['booking-information']['check-in']; ?></p>
                    <p>Check-out: <?php echo $_SESSION['booking-information']['check-out']; ?></p>
                    <p>Amount of nights: <?php echo $_SESSION['booking-information']['totalNights']; ?></p>
                    <p>Price per night: R<?php echo $_SESSION['booking-information']['daily_rate']; ?></p>
                    <p>Total cost: R<?php echo $_SESSION['booking-information']['totalStayCost']; ?></p>
                </div>
            </div>

            <div class="compare-hotel-wrapper">
                <form>
                    <select name="hotels" id="hotels-select" onchange="showHotel(this.value)">
                        <option value="">Choose an alternative hotel</option>
                        <?php foreach($hotels as $hotel): ?>
                            <option value="<?php echo $hotel['id'] ?>"><?php echo $hotel['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
                <p>Name: <span id="hotel-name"></span></p>
                <p>Daily rate: R<span id="daily_rate"></span></p>
                <p>Rating: <span id="rating"></span></p>
                <a href="" class="btn" id="hotel_link">Book</a>
                <img src="" alt="" id="thumnbail" width="400" height="400">
            </div>

            <div class="confirm-booking-form">
                <form action="<?php echo '../php/handling/bookings/BookingHandler.php/?action=Confirm&totalNights='.$_SESSION['booking-information']['totalNights'].'&totalStayCost='.$_SESSION['booking-information']['totalStayCost']; ?>" method="POST">
                    <input type="submit" value="Book" name="confirm-booking">
                </form>
            </div>
            
        </div>
        
    </div>

    <script src="../js/script.js"></script>
    
</body>
</html>
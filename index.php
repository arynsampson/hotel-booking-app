<?php

    require_once './src/php/classes/DB.class.php';
    require_once './src/php/classes/User.class.php';
    require_once './src/php/classes/Hotel.class.php';

    session_start();    
    $db = new DB;

    if($db->getTablesCreated() === false) {
        $db->createTables();
    };

    // initialise hotels variable in session
    $_SESSION['hotels'] = [];

    if(!isset($_SESSION['isLoggedIn'])) {
        $_SESSION['isLoggedIn'] = false;
        $_SESSION['hotel'] = [];
        
    }

    // fetch all hotels from db
    $hotels = $db->fetchHotels();
    foreach($hotels as $hotel) {
        // create new hotel object with each hotel
        $hotel = new Hotel(
            $hotel['id'],
            $hotel['name'],
            $hotel['daily_rate'],
            $hotel['thumbnail'],
            $hotel['features'],
            $hotel['rating'],
            $hotel['address']
        );
        // add hotel object to hotels session variable
        array_push($_SESSION['hotels'], serialize($hotel));
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
    <link rel="stylesheet" href="./src/style/style.css">
    <title>Hotel Booking</title>
</head>
<body>
    
    <?php require './src/templates/header.template.php'; ?>

    <div class="container">
        <div class="cards-container">
            <?php foreach($hotels as $hotel): ?>
                <div class="card col s4">
                    <div class="img-wrapper">
                        <img src="<?php echo $hotel['thumbnail'] ?>" alt="<?php echo $hotel['name'] ?>" class="hotel-img">
                    </div>
                    <a href="<?php echo './src/views/hotelDetails.view.php/?id='.$hotel['id']; ?>"><h4 class="hotel-name"><?php echo $hotel['name']; ?></h4></a>
                </div> 
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>


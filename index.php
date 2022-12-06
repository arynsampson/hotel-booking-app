<?php
    session_start();

    require './config/query/fetchHotels.php';
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
                    <a href="<?php echo './src/views/hotel_details.view.php/?id='.$hotel['id']; ?>"><h4 class="hotel-name"><?php echo $hotel['name']; ?></h4></a>
                </div> 
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>


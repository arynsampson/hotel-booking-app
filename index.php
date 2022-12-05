<?php
    session_start();
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
            <div class="card col s4">
                <img src="https://thumbs.dreamstime.com/b/hotel-13341433.jpg" alt="" class="hotel-img">
                <h4>One&Only</h4>
            </div>
            <div class="card col s4">
                <img src="https://thumbs.dreamstime.com/b/hotel-13341433.jpg" alt="" class="hotel-img">
                <h4>One&Only</h4>
            </div>
            <div class="card col s4">
                <img src="https://thumbs.dreamstime.com/b/hotel-13341433.jpg" alt="" class="hotel-img">
                <h4>One&Only</h4>
            </div>
            <div class="card col s4">
                <img src="https://thumbs.dreamstime.com/b/hotel-13341433.jpg" alt="" class="hotel-img">
                <h4>One&Only</h4>
            </div>
            <div class="card col s4">
                <img src="https://thumbs.dreamstime.com/b/hotel-13341433.jpg" alt="" class="hotel-img">
                <h4>One&Only</h4>
            </div>
        </div>
    </div>

</body>
</html>


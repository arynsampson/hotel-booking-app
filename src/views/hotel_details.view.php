 <?php

    session_start();
    require '../../config/connect.php';
    require '../../config/query/fetchHotel.php';

    $url = 'localhost'.$_SERVER['REQUEST_URI'];
    $res = parse_url($url);
    parse_str($res['query'], $params);

    $hotel = fetchHotel($params['id']);

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

    <div style="padding: 10px 30px">
    <?php

            echo "<h2>$hotel[name]</h2>" . '<br>';
            echo "<p>R$hotel[daily_rate]</p>" . '<br>';
            echo "<img src=\"$hotel[thumbnail]\">" . '<br>';
            echo "<p>Rating: $hotel[rating]</p>" . '<br>';
            echo "<p>$hotel[address]</p>" . '<br>';
            ?>
    </div>
  
</body>
</html>
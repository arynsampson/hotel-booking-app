<?php

    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/config/paths.php';
    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/config/connect.php';
    session_start();

    $user = unserialize($_SESSION['user']);
    $user_id = $user->getID();
    
    $sql = "SELECT * FROM booking WHERE booking.user_id='$user_id'";
        
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $bookings = $result->fetch_all();
        $_SESSION['bookings'] = $bookings;
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

    <?php require '../../src/templates/header.template.php'; ?>

    <div class="main-container">
        <table>
            <tr>
                <th>Booking #</th>
                <th>Hotel name</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Date booked</th>
                <th>Booking status</th>
                <th>Receipt</th>
                <th>Cancel</th>
            </tr>
            <?php 
                if($_SESSION['bookings']) { foreach($_SESSION['bookings'] as $booking): ?>
                <tr>
                    <td><?php echo $booking[0] ?></td>
                    <td><?php echo $booking[4] ?></td>
                    <td><?php echo $booking[5] ?></td>
                    <td><?php echo $booking[6] ?></td>
                    <td><?php echo $booking[9] ?></td>
                    <td><?php echo $booking[8] ?></td>
                    <td>
                        <form action="<?php echo '../php/booking_handling/receipt.php/?id='.$booking[0]; ?>" method="POST">
                            <input type="submit" value="Receipt" name="receipt">
                        </form></td>
                    <td>
                        <form action="<?php echo '../php/booking_handling/cancel.php/?id='.$booking[0]; ?>" method="POST">
                            <input type="submit" value="Cancel" name="cancel">
                        </form>
                    </td>
                </tr>
            <?php endforeach;
            } ?>
        </table>
        <!-- <p class="error"><?php echo $_SESSION['cancel_error'] ?? '' ?></p> -->
    </div>

    
</body>
</html>
<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Booking.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/user.php';

    $db = new DB;
    
    $_SESSION['bookings'] = [];
    $bookings = $db->fetchAllBookings($user->getID()) ?? [];
    if($bookings) {
        foreach($bookings as $booking) {
            $booking = new Booking(
                $user->getID(),
                $user->getEmail(),
                $booking[3],
                $booking[4],
                $booking[8],
                $booking[5],
                $booking[6],
                $booking[7],
                $booking[9]
            );
            array_push($_SESSION['bookings'], serialize($booking));
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
            <?php foreach($bookings as $booking): ?>
                <tr>
                    <td><?php echo $booking[0] ?></td>
                    <td><?php echo $booking[4] ?></td>
                    <td><?php echo $booking[5] ?></td>
                    <td><?php echo $booking[6] ?></td>
                    <td><?php echo $booking[10] ?></td>
                    <td><?php echo $booking[9] ?></td>
                    <td>
                        <form action="<?php echo '../php/handling/bookings/BookingHandler.php/?action=Receipt&id='.$booking[0]; ?>" method="POST">
                            <input type="submit" value="Receipt" name="receipt">
                        </form></td>
                    <td>
                        <?php if($booking[9] === "CONFIRMED"): ?>
                            <form action="<?php echo '../php/handling/bookings/BookingHandler.php/?action=Cancel&id='.$booking[0]; ?>" method="POST">
                                <input type="submit" value="Cancel" name="cancel">
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p><?php echo $_SESSION['cancel_message'] ?? ''; ?></p>
    </div>

    <script src="../js/script.js"></script>
    
</body>
</html>
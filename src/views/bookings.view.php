<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Booking.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/user.php';

    $db = new DB;

    // booking status needs page refresh to display
    if(isset($_POST['refresh'])) {
        header('Location: bookings.view.php');
    }
    
    $_SESSION['bookings'] = [];
    $bookings = $db->fetchAllBookings($user->getID()) ?? [];
    if($bookings) {
        foreach($bookings as $booking) {
            // update booking status
            if(date("Y-m-d") >= $booking[5] && date("Y-m-d") <= $booking[6]) {
                $booking[9] = 'IN PROGRESS';
            } elseif(date("Y-m-d") >= $booking[6]) {
                $booking[9] = 'COMPLETED';
            } elseif($booking[9] === 'CANCELLED') {
                continue;
            } else {
                $booking[9] = 'CONFIRMED';
            }

            // update booking status in db
            // param = booking ID, booking status
            $db->updateBookingStatus($booking[0], $booking[9]);

            // create booking object
            $bookingObj = new Booking(
                $booking[1], // user ID
                $booking[2], // user email
                $booking[3], // hotel ID
                $booking[4], // hotel name
                $booking[5], // check-in date
                $booking[6], // check-out date
                $booking[7], // total nights
                $booking[8], // total cost
                $booking[9] // booking status
            );
            // add booking objects to session
            array_push($_SESSION['bookings'], serialize($bookingObj));
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
        <form action="bookings.view.php" method="POST">
            <input type="submit" class="refresh-btn" value="Click here to refresh the table to get booking statuses" name="refresh">
        </form>
    
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
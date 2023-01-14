<?php

    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/config/paths.php';
    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/config/connect.php';
    session_start();

    $user = unserialize($_SESSION['user']);
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
        <div class="update-info-form-wrapper">
            <form action="<?php echo '../php/user_handling/user_profile_handler.php'; ?>" method="POST">
                <div>
                    <label for="firstname">Edit name:</label>
                    <input type="text" name="firstname_update" value="<?php echo $user->getFirstName(); ?>">
                    <p class="error"><?php echo $firstname['error'] ?? ''; ?></p>
                </div>
                <div>
                    <label for="lastname">Edit lastname:</label>
                    <input type="text" name="lastname_update" value="<?php echo $user->getLastName(); ?>">
                    <p class="error"><?php echo $lastname['error'] ?? ''; ?></p>
                </div>
                <div>
                    <label for="lastname">Edit email:</label>
                    <input type="text" name="email_update" value="<?php echo $user->getEmail(); ?>">
                    <p class="error"><?php echo $email['error'] ?? ''; ?></p>
                </div>
                
                <input type="submit" value="Update" name="update">
            </form>
        </div>
    </div>

</body>
</html>
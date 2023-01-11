<?php
    session_start();
    require '../../config/connect.php';
    require '../../config/query/fetchUser.php';
    require '../php/classes/Utils.php';

    if(isset($_POST['update'])) {
        $utils = new Utils;
        // validate user input
        $firstname = $utils->validate_firstname($_POST['firstname_update']);
        $lastname = $utils->validate_lastname($_POST['lastname_update']);
        $email = $utils->validate_email($_POST['email_update']);

        // TEST NAME & EMAIL VALIDATIONS

        // update user object


        // update database
        global $conn;
        $sql = "UPDATE user SET firstname='".$firstname['name']."', lastname='".$lastname['name']."', email='".$email['email']."' WHERE user.id='".$_SESSION['loggedInUser']['id']."'";
        $result = $conn->query($sql);

        // update session variable
        fetchUser($_SESSION['loggedInUser']['id']);

        header('Location: /hotel-booking-app/src/views/user_profile.view.php');
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
        <div class="update-info-form-wrapper">
            <form action="user_profile.view.php" method="POST">
                <div>
                    <label for="firstname">Edit name:</label>
                    <input type="text" name="firstname_update" value="<?php echo $_SESSION['loggedInUser']['firstname']; ?>">
                    <p class="error"><?php echo $firstname['error'] ?? ''; ?></p>
                </div>
                <div>
                    <label for="lastname">Edit lastname:</label>
                    <input type="text" name="lastname_update" value="<?php echo $_SESSION['loggedInUser']['lastname']; ?>">
                    <p class="error"><?php echo $lastname['error'] ?? ''; ?></p>
                </div>
                <div>
                    <label for="lastname">Edit email:</label>
                    <input type="text" name="email_update" value="<?php echo $_SESSION['loggedInUser']['email']; ?>">
                    <p class="error"><?php echo $email['error'] ?? ''; ?></p>
                </div>
                
                <input type="submit" value="Update" name="update">
            </form>
        </div>
    </div>

</body>
</html>
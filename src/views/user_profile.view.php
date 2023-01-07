<?php
    session_start();
    require '../../config/connect.php';
    require '../../config/query/fetchUser.php';

    if(isset($_POST['update'])) {
        $firstname = $_POST['firstname_update'];
        $lastname = $_POST['lastname_update'];
        $email = $_POST['email_update'];

        // update user object


        // update database
        global $conn;
        $sql = "UPDATE user SET firstname='$firstname', lastname='$lastname', email='$email' WHERE user.id='".$_SESSION['loggedInUser']['id']."'";
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
                </div>
                <div>
                    <label for="lastname">Edit lastname:</label>
                    <input type="text" name="lastname_update" value="<?php echo $_SESSION['loggedInUser']['lastname']; ?>">
                </div>
                <div>
                    <label for="lastname">Edit email:</label>
                    <input type="text" name="email_update" value="<?php echo $_SESSION['loggedInUser']['email']; ?>">
                </div>
                
                <input type="submit" value="Update" name="update">
            </form>
        </div>
    </div>

</body>
</html>
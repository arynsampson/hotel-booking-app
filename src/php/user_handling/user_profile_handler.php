<?php
    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Utils.class.php';
    require $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    session_start();
    $user = unserialize($_SESSION['user']);

    if(isset($_POST['update'])) {
        $db = new DB;
        $utils = new Utils;
        // validate user input
        $firstname = $utils->validate_firstname($_POST['firstname_update']);
        $lastname = $utils->validate_lastname($_POST['lastname_update']);
        $email = $utils->validate_email($_POST['email_update']);

        // update user object
        $user->setFirstName($firstname);
        $user->setLastName($lastname);
        $user->setEmail($email);
        $user_id = $user->getID();

        // update database
        $sql = "UPDATE user SET firstname='$firstname', lastname='$lastname', email='$email' WHERE user.id='$user_id'";
        $result = $db->conn->query($sql);

        // update session variable
        $_SESSION['user'] = serialize($user);

        header('Location: /hotel-booking-app/src/views/user_profile.view.php');
    }

    require '../../views/user_handling.view.php';
?>
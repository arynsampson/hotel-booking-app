<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Utils.class.php';
    session_start();

    $user = unserialize($_SESSION['user']);

    if(isset($_POST['update'])) {
        $_SESSION['profileUpdateMessage'] = '';
        $db = new DB; $utils = new Utils;
        
        // validate user input
        $firstname = $utils->validateFirstname($_POST['firstname_update']);
        $lastname = $utils->validateLastname($_POST['lastname_update']);
        $email = $utils->validateEmail($_POST['email_update']);

        // update user object
        $user->setFirstName($firstname);
        $user->setLastName($lastname);
        $user->setEmail($email);
        $user_id = $user->getID();

        // update user in database
        $user->updateDBUser();

        // update session variable
        $_SESSION['user'] = serialize($user);
        $_SESSION['profileUpdateMessage'] = 'Details successfully updated.';

        header('Location: /hotel-booking-app/src/views/userProfile.view.php');
    }

?>
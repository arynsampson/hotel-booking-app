<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Utils.class.php';
    session_start();

    $user = unserialize($_SESSION['user']);

    if(isset($_POST['update'])) {
        
        // validate user input
        $firstname = Utils::validateFirstname($_POST['firstname_update']);
        $lastname = Utils::validateLastname($_POST['lastname_update']);
        $email = Utils::validateEmail($_POST['email_update']);

        if(!isset($firstname['error']) && !isset($lastname['error']) && !isset($email['error'])) {
            // update user object
            $user->setFirstName($firstname);
            $user->setLastName($lastname);
            $user->setEmail($email);
            $user_id = $user->getID();

            //update user in database
            $user->updateDBUser();

            //update session variable
            $_SESSION['user'] = serialize($user);
            $_SESSION['profileUpdateMessage'] = 'Details successfully updated.';
        } else {
            $_SESSION['profileUpdateMessage'] = 'Details failed to update.';
        }

        header('Location: /hotel-booking-app/src/views/userProfile.view.php');
    }

?>
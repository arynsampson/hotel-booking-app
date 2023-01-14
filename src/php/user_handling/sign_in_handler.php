<?php

    require '../../../config/connect.php';
    require '../../../config/query/fetchUser.php';
    require '../classes/User.class.php';
    require '../classes/Utils.class.php';
    require '../classes/Auth.class.php';
    require '../../../config/paths.php';
    session_start();

    if(isset($_POST['submit'])) {
        $utils = new Utils;
        $user_input_data = array(
        'email' => $utils->validate_email($_POST['email']),
        'password' => $utils->validate_password($_POST['password'])
    );

        $doesUserExist = $utils->checkUserExists($user_input_data['email']);

        if($doesUserExist) {
            
            $user = fetchUser($user_input_data['email']);

            $new_user = new User($user['id'], $user['firstname'], $user['lastname'], $user['email']);

            $_SESSION['user'] = serialize($new_user);
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['bookings'] = [];

            header('Location: ../../../../hotel-booking-app');
        } else {
            // already existing user
            $_SESSION['error'] = 'Account not found.';

        }
    }
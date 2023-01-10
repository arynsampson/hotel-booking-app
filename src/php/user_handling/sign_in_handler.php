<?php

    require '../../config/connect.php';

    session_start();

    function signUserIn($user) {

        session_unset();
        global $conn;

        $firstname = $lastname = '';
        $email = $user['email'];
        $password = $user['password'];

        $sql = "SELECT id, firstname, lastname, email FROM user WHERE user.email = '".$email['email']."'";
        
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            // register new user
            $user = $result->fetch_assoc();

            $_SESSION['loggedInUser'] = $user;
            $_SESSION['fullname'] = $user['firstname'] . ' ' . $user['lastname'];

            $_SESSION['isLoggedIn'] = true;
            $_SESSION['bookings'] = [];

            mysqli_free_result($result);
            header('Location: ../../index.php');
        } else {
            // already existing user
            $_SESSION['error'] = 'Account not found.';

        }
        
    }


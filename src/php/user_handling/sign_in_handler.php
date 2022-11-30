<?php

    require '../../config/connect.php';

    session_start();

    function signUserIn($user) {

        // session_unset();
        global $conn;

        $firstname = $lastname = '';
        $email = $user['email'];
        $password = $user['password'];

        $sql = "SELECT * FROM user WHERE user.email = '$email'";
        
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            // register new user
            $user = $result->fetch_assoc();

            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['email'] = $email;

            $_SESSION['loggedIn'] = true;
            header('Location: ../../index.php');
        } else {
            // already existing user
            $_SESSION['error'] = 'Account not found.';

        }
        
    }

?>
<?php

    require '../../config/connect.php';
    require '../../src/php/classes/User.php';

    session_start();

    function registerUser($user) {

        session_unset();
        global $conn;
        $firstname = $user['firstname'];
        $lastname = $user['lastname'];
        $email = $user['email'];
        $password = $user['password'];
        $role = 'READ-ONLY';

        $sql = "SELECT * FROM user WHERE user.email = '$email'";
        $insert_sql = "INSERT INTO user (firstname, lastname, email, password, role) VALUES ('$firstname', '$lastname', '$email', '$password', '$role');";
        
        $result = $conn->query($sql);

        if($result->num_rows < 1) {
            // register new user
            $new_user = new User($firstname, $lastname, $email, $password, $role);
            $insert_user_into_db = $conn->query($insert_sql);
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['email'] = $email;

            header('Location: ../../index.php');
        } else {
            // already existing user
            $_SESSION['register_error'] = 'The email address entered is already associated with a registered account.';

        }
        
    }

?>
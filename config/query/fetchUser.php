<?php

    function fetchUser($id) {
        global $conn;
        $sql = "SELECT id, firstname, lastname, email FROM user WHERE user.id = '$id'";
        
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            $_SESSION['loggedInUser'] = [];
            $_SESSION['loggedInUser'] = $user;
            $_SESSION['fullname'] = $user['firstname'] . ' ' . $user['lastname'];
        }
    }

?>
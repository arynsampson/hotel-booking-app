<?php

    function fetchUser($email) {
        global $conn;
        $sql = "SELECT id, firstname, lastname, email FROM user WHERE user.email = '$email'";
        
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        }
        return;
    }

?>
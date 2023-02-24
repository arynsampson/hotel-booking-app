<?php

    require_once 'DB.class.php';

    class Auth {

        public function addUserToDB($user) {
            $sql = "INSERT INTO user (firstname, lastname, email, password) VALUES (
                '".$user['firstname']."', 
                '".$user['lastname']."', 
                '".$user['email']."', 
                '".$user['password']."');";
            $insertUserIntoDb = DB::$conn->query($sql);
        }

    }
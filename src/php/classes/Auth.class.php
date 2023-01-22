<?php

    require_once 'DB.class.php';

    class Auth extends DB {

        public function addUserToDB($user) {
            $db = new DB;
            $sql = "INSERT INTO user (firstname, lastname, email, password) VALUES (
                '".$user['firstname']."', 
                '".$user['lastname']."', 
                '".$user['email']."', 
                '".$user['password']."');";
            $insert_user_into_db = $db->conn->query($sql);
        }

        public function fetchLoginUser() {

        }

    }
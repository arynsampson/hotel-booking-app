<?php

include_once 'DB.class.php';

    class Auth extends DB {

        public function register($user) {
            $db = new DB;
            $conn = $db->getConn();
            $insert_sql = "INSERT INTO user (firstname, lastname, email, password) VALUES (
                '".$user['firstname']."', 
                '".$user['lastname']."', 
                '".$user['email']."', 
                '".$user['password']."');";
            $insert_user_into_db = $conn->query($insert_sql);
        }

        public function login() {

        }

        public function logout() {
            session_unset();
            session_destroy();
            session_start();
            $_SESSION['isLoggedIn'] = false;
            header('Location: ../../../index.php');
        }

    }
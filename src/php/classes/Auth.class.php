<?php

    include_once 'DB.class.php';

    class Auth extends DB {

        public function register($user) {
            $db = new DB;
            $sql = "INSERT INTO user (firstname, lastname, email, password) VALUES (
                '".$user['firstname']."', 
                '".$user['lastname']."', 
                '".$user['email']."', 
                '".$user['password']."');";
            $insert_user_into_db = $db->conn->query($sql);
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
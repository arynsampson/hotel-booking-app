<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Auth.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Utils.class.php';
    session_start();
 
    class AuthHandler extends Auth {

        public $auth;
        public $utils;

        public function __construct() {
            $this->auth = new Auth;
            $this->utils = new Utils;
        }

        public function register() {
            $errors = true;
            $user_input_data = array(
                'firstname' => $this->utils->validate_firstname($_POST['firstname']),
                'lastname' => $this->utils->validate_lastname($_POST['lastname']),
                'email' => $this->utils->validate_email($_POST['email']),
                'password' => $this->utils->validate_password($_POST['password']),
            );
      
            $doesUserExist = $this->utils->checkUserExists($user_input_data['email']);

            if(!isset($user_input_data['firstname']['error']) &&
            !isset($user_input_data['lastname']['error']) &&
            !isset($user_input_data['email']['error']) &&
            !isset($user_input_data['password']['error'])) {
                $errors = false;
            }  else {
                $_SESSION['registerErrors'] = $user_input_data;
                header('Location: ../../../views/register.view.php');
            }
    
            if(!$doesUserExist & $errors === false) {
                $new_user_db = $this->auth->addUserToDB($user_input_data);
    
                $sql = "SELECT id FROM user WHERE user.email='".$user_input_data['email']."'";
                $result = $this->auth->conn->query($sql);
                $user_id = $result->fetch_assoc();
    
                $new_user_obj = new User($user_id['id'], $user_input_data['firstname'], $user_input_data['lastname'], $user_input_data['email'], $user_input_data['password']);
    
                // $_SESSION['user'] = serialize($new_user);
                // $_SESSION['isLoggedIn'] = true;
                // $_SESSION['bookings'] = [];

                header('Location: /hotel-booking-app/index.php');
            } else {
                $_SESSION['error'] = 'The email address entered is already associated with a registered account.';
                header('Location: ../../../views/register.view.php');
            }
        }

        public function login() {
                $user_input_data = array(
                'email' => $this->utils->validate_email($_POST['email']),
                'password' => $this->utils->validate_password($_POST['password'])
            );
        
                $doesUserExist = $this->utils->checkUserExists($user_input_data['email']);
        
                if($doesUserExist) {
                    $user = $this->auth->fetchUser($user_input_data['email']);
        
                    $new_user = new User($user['id'], $user['firstname'], $user['lastname'], $user['email']);
        
                    $_SESSION['user'] = serialize($new_user);
                    $_SESSION['isLoggedIn'] = true;
                    $_SESSION['bookings'] = [];
        
                    header('Location: /hotel-booking-app/index.php');
                } else {
                    // already existing user
                    $_SESSION['error'] = 'Account not found.';
                }
        }

        public function logout() {
            session_unset();
            session_destroy();
            session_start();
            $_SESSION = [];
            $_SESSION['isLoggedIn'] = false;

            header('Location: /hotel-booking-app/index.php');
        }

    }

    $authHandler = new AuthHandler;
    $action = $_GET['action'];

    switch($action) {
        case 'Register': 
            $authHandler->register();
            break;
        case 'Login': 
            $authHandler->login();
            break;
        case 'Logout': 
            $authHandler->logout();
            break;                    
    }
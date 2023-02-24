<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Auth.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/DB.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/User.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/php/classes/Utils.class.php';
    session_start();
 
    class AuthHandler extends Auth {

        public $auth;

        public function __construct() {
            $this->auth = new Auth;
        }

        public function register() {
            $errors = true;
            $userInputData = array(
                'firstname' => Utils::validateFirstname($_POST['firstname']),
                'lastname' => Utils::validateLastname($_POST['lastname']),
                'email' => Utils::validateEmail($_POST['email']),
                'password' => Utils::validatePassword($_POST['password']),
            );
      
            $doesUserExist = Utils::checkUserExists($userInputData['email']);

            if(!isset($userInputData['firstname']['error']) &&
            !isset($userInputData['lastname']['error']) &&
            !isset($userInputData['email']['error']) &&
            !isset($userInputData['password']['error'])) {
                $errors = false;
            }  else {
                $_SESSION['registerErrors'] = $userInputData;
                header('Location: /hotel-booking-app/src/views/register.view.php');
            }
    
            if(!$doesUserExist & !$errors) {
                $userInputData['password'] = password_hash($userInputData['password'], PASSWORD_BCRYPT);
                $addUserToDb = $this->auth->addUserToDB($userInputData);
                
                // get user id for user object property
                $sql = "SELECT id FROM user WHERE user.email='".$userInputData['email']."'";
                $result = DB::$conn->query($sql);
                $userId = $result->fetch_assoc();
    
                $newUserObj = new User($userId['id'], $userInputData['firstname'], $userInputData['lastname'], $userInputData['email'], $userInputData['password']);

                header('Location: /hotel-booking-app/index.php');
            } else {
                $_SESSION['error'] = 'The email address entered is already associated with a registered account.';
                header('Location: /hotel-booking-app/src/views/register.view.php');
            }
        }

        public function login() {
            $userInputData = array(
                'email' => Utils::validateEmail($_POST['email']),
                'password' => Utils::validatePassword($_POST['password'])
            );
        
            $doesUserExist = Utils::checkUserExists($userInputData['email']);
        
            if($doesUserExist) {
                $user = DB::fetchUser($userInputData['email']);

                if($user['email'] === $userInputData['email'] && 
                   password_verify($userInputData['password'], $user['password'])) {

                    $new_user = new User($user['id'], $user['firstname'], $user['lastname'], $user['email']);  
                    $_SESSION['user'] = serialize($new_user);
                    $_SESSION['isLoggedIn'] = true;
                    $_SESSION['bookings'] = [];
    
                    header('Location: /hotel-booking-app/index.php');
                } else {
                    // wrong detail entered
                    $_SESSION['loginError'] = 'Incorrect details entered.';
                    header('Location: /hotel-booking-app/src/views/login.view.php');
                }
            } else {
                // already existing user
                $_SESSION['loginError'] = 'Account not found.';
                header('Location: /hotel-booking-app/src/views/login.view.php');
            }
        }

        public function logout() {
            $path = $_SERVER['DOCUMENT_ROOT'].'/hotel-booking-app/src/views/';
            array_map('unlink', glob($path."*.txt"));

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
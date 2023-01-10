<?php

    require '../../../config/connect.php';
    require '../classes/User.class.php';
    require '../classes/Utils.class.php';
    require '../classes/Auth.class.php';

    if(isset($_POST['submit'])) {

        $utils = new Utils;

        $user_input_data = array(
          'firstname' => $utils->validate_firstname($_POST['firstname']),
          'lastname' => $utils->validate_lastname($_POST['lastname']),
          'email' => $utils->validate_email($_POST['email']),
          'password' => $utils->validate_password($_POST['password']),
        );

        $auth = new Auth;

        $doesUserExist = $utils->checkUserExists($user_input_data['email']);

        if(!$doesUserExist) {
            $new_user_obj = new User($user_input_data['firstname'], $user_input_data['lastname'], $user_input_data['email'], $user_input_data['password']);
            $new_user_db = $auth->register($user_input_data);
            header('Location: ../../../index.php');
        } else {
            $_SESSION['error'] = 'The email address entered is already associated with a registered account.';
            header('Location: ../../views/register.view.php');
        }

    }

    require '../../views/register.view.php';
?>
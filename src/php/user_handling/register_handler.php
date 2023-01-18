<?php

    require '../classes/DB.class.php';
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

        // $doesUserExist = $utils->checkUserExists($user_input_data['email']);
        $errors = true;
        if(!isset($user_input_data['firstname']['error']) &&
        !isset($user_input_data['lastname']['error']) &&
        !isset($user_input_data['email']['error']) &&
        !isset($user_input_data['password']['error'])) {
            $errors = false;
        } 

        echo $errors;

        // if(!$doesUserExist & $errors === false) {
            
        //     $auth = new Auth;
        //     $new_user_db = $auth->register($user_input_data);

        //     $db = new DB;
        //     $sql = "SELECT id FROM user WHERE user.email='".$user_input_data['email']."'";
        //     $result = $db->conn->query($sql);
        //     $user_id = $result->fetch_assoc();

        //     $new_user_obj = new User($user_id['id'], $user_input_data['firstname'], $user_input_data['lastname'], $user_input_data['email'], $user_input_data['password']);

        //     header('Location: ../../../index.php');
        // } else {
        //     $_SESSION['error'] = 'The email address entered is already associated with a registered account.';
        //     header('Location: ../../views/register.view.php');
        // }

    }

    require '../../views/register.view.php';
?>
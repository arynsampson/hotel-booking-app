<?php

  function validate_input($input) {
    if(strlen($input) < 2) {
      return array(
        "name" => $input,
        "error" => "Cannot be less than 2 characters."
      );
    } else {
      $input = trim($input);
      $input = stripslashes($input);
      $input = htmlspecialchars($input);
      return array('name' => $input);
    }
  }

  // validate user email
  function validate_email($email) {
    if(strlen($email) < 2) {
      return array(
        'email' => $email, 
        'error' => 'Cannot be less than 2 characters.'
      );
    } else {
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      return array('email' => $email);
    }
  }

?>
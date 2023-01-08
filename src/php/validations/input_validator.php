<?php

  function validate_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
  }

  function validate_email($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    return $email;
  }
  
?>
<?php

    session_unset();
    session_destroy();
    session_start();
    $_SESSION = [];
    $_SESSION['isLoggedIn'] = false;

    header('Location: ../../../index.php');
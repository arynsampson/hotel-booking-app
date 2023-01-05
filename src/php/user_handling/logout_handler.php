<?php

    session_unset();
    session_destroy();
    session_start();
    $_SESSION['isLoggedIn'] = false;

    header('Location: ../../../index.php');
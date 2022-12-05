<?php

    $navOptions = [];
    $homePage = '/hotel-booking-app/index.php';
    $profilePage = '/hotel-booking-app/src/views/user_profile.view.php';
    $signInPage = '/hotel-booking-app/src/views/sign_in.view.php';
    $signUpPage = '/hotel-booking-app/src/views/register.view.php';
    $logout = '/hotel-booking-app/src/php/user_handling/logout_handler.php';

    if($_SESSION['isLoggedIn']) {
        $navOptions = [
            'Home' => $homePage, 
            'My Profile' => $profilePage, 
            'Logout' => $logout
        ];
    } else {
        $navOptions = [
            'Home' => $homePage, 
            'Sign in' => $signInPage, 
            'Sign up' => $signUpPage
        ];
    }
        

?>

<header class="header">
    <div class="main-container">
        <div class="header-content-container">
            <h1 class="heading">Hotel Bookings</h1>
            <div>
                <ul class="nav-items-list">
                    <?php foreach($navOptions as $key => $option): ?>
                        <a href="<?php echo $option ?>"><li class="nav-item"><?php echo $key ?></li></a>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</header>


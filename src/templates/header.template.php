<?php

    require '../../config/paths.php';
    $navOptions = [];

    if($_SESSION['isLoggedIn']) {
        $navOptions = [
            'Home' => $homePage, 
            'My Profile' => $profilePage,
            'Bookings' => $bookingsPage,
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


<?php

    require $_SERVER["DOCUMENT_ROOT"].'/hotel-booking-app/config/paths.php';

    $navOptions = [];

    if($_SESSION['isLoggedIn']) {
        $navOptions = [
            'Home' => $homePage, 
            'Profile' => $profilePage,
            'Bookings' => $bookingsPage,
            'Logout' => $logout
        ];
    } else {
        $navOptions = [
            'Home' => $homePage, 
            'Login' => $login, 
            'Register' => $register
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
                        <?php if($key !== 'Logout'): ?>
                            <a href="<?php echo $option ?>"><li class="nav-item"><?php echo $key ?></li></a>
                        <?php else: ?>
                            <a href="<?php echo $option.'/?action='.$key; ?>"><li class="nav-item"><?php echo $key ?></li></a>
                        <?php endif; ?>  
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</header>


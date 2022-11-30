<?php

    // if(!empty($_SESSION)) {
    //     echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
    // }

    $page = './src/views/sign_in.view.php';
    $username;

    if($_SESSION['loggedIn']) {
        $username = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
    }

    if(isset($_POST['submit'])) {
        session_unset();
        $_SESSION['loggedIn'] = false;
    }

?>


<header class="header">
    <h1 class="heading">Hotel Bookings</h1>

    <div class="user-options">
        <?php if($_SESSION['loggedIn']): ?>
            <ul>
                <li>Hi, <a href="#"><?php echo $username ?? '' ; ?></a></li>
            </ul>
        <?php endif; ?>

        <div class="logout-wrapper">
            <?php if($_SESSION['loggedIn']): ?>
                <form action="index.php" method="POST">
                    <input type="submit" value="Logout" name="submit" class="btn">
                </form>
            <?php else: ?>
                <button class="btn"><a href="<?php echo $page; ?>">Sign in</a></button>
            <?php endif; ?>
        </div>
    </div>
    
</header>
<?php

require '../php/user_handling/sign_in_handler.php';
require '../php/classes/Utils.php';

  if(isset($_POST['submit'])) {
    $utils = new Utils;
    $user = array(
      'email' => $utils->validate_email($_POST['email']),
      'password' => $utils->validate_password($_POST['password'])
    );

    signUserIn($user);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../style/style.css"> 
    <title>Hotel Booking App</title>
</head>
<body>

    <?php require '../../src/templates/header.template.php'; ?>

    <div class="bg-image">
      <h1>Sign in</h1>
      <div class="main-container">
        <div class="card">
          <div class="row">
            <div class="col s12 center-align">
              <div class="row">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="email" type="email" class="validate" name="email" required>
                      <label for="email">Email:</label>
                    </div>
                    <div class="input-field col s12">
                      <input id="password" type="password" class="validate" name="password" required>
                      <label for="password">Password:</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="submit" type="submit" class="btn" name="submit" value="Sign in">
                    </div>
                  </div>
                  <p><?php echo $_SESSION['error'] ?? '' ; ?></p>
                </form>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
    
</body>
</html>
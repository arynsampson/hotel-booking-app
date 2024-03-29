<?php
  session_start();
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

    <?php require '../templates/header.template.php'; ?>

    <div class="bg-image">
      <h1>Create account</h1>
      <div class="main-container">
        <div class="card">
          <div class="row">
            <div class="col s12 center-align">
              <div class="row">
                <form action="<?php echo '../php/handling/auth/AuthHandler.php/?action=Register'; ?>" method="POST" class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <label for="first_name">First name:</label>
                      <input id="first_name" type="text" class="validate" name="firstname" required>
                      <p class="register-error"><?php echo $_SESSION['registerErrors']['firstname']['error'] ?? '' ?></p>
                    </div>
                    <div class="input-field col s12">
                      <input id="last_name" type="text" class="validate" name="lastname" required>
                      <label for="last_name">Last name:</label>
                      <p class="register-error"><?php echo $_SESSION['registerErrors']['lastname']['error'] ?? '' ?></p>
                    </div>
                    <div class="input-field col s12">
                      <input id="email" type="email" class="validate" name="email" required>
                      <label for="email">Email:</label>
                      <p class="register-error"><?php echo $_SESSION['registerErrors']['email']['error'] ?? '' ?></p>
                    </div>
                    <div class="input-field col s12">
                      <p class="register-error"><?php echo $_SESSION['registerErrors']['password']['error'] ?? '' ?></p>
                      <input id="password" type="password" class="validate" name="password" required>
                      <label for="password">Password:</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="submit" type="submit" class="btn" name="submit" value="Register">
                    </div>
                  </div>
                  <p><?php echo $_SESSION['error'] ?? ''; ?></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
</body>
</html>
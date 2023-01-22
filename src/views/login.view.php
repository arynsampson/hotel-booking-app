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

    <?php session_start(); require '../../src/templates/header.template.php'; ?>

    <div class="bg-image">
      <h1>Sign in</h1>
      <div class="main-container">
        <div class="card">
          <div class="row">
            <div class="col s12 center-align">
              <div class="row">
                <form action="<?php echo '../php/handling/user_handling/AuthHandler.php/?action=Login'; ?>" method="POST" class="col s12">
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
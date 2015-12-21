<?php

  /*
   * User login page
   */

   include('includes/header.php');
   include('includes/db-config.php');

  // Start a session
   session_start();

   if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Email'])) {
   ?>

     <h1>Member Area</h1>
     <p>Thanks for logging in! You are <?php echo $_SESSION['Email']?></p>

   <?php
   } elseif(!empty($_POST['email']) && !empty($_POST['password'])) {
      $email = mysql_real_escape_string($_POST['email']);
      $password = $_POST['password'];

      // Lookup users table for email address and get password hash
      try {
          $results = $db->query("SELECT * FROM users WHERE Email =  '" . $email . "'");
      } catch (Exception $e){
          echo "Data could not be retrieved from the database.";
          exit;
      }

      $dbUserArray = ($results->fetchAll(PDO::FETCH_ASSOC));
      // Password hash from database
      $hash = $dbUserArray[0]['password'];

      // use password_verify to match $password from user submitted form against the hash from the database
      if (password_verify($password, $hash)) {
        echo 'Password is correct!';
      } else {
        echo 'Password is incorrect';
      }

      if(!empty($dbUserArray)) {
          $email = $dbUserArray[0]['Email'];

          // Set session vars for email and logged in state
          $_SESSION['Email'] = $email;
          $_SESSION['LoggedIn'] = 1;

          // Redirect to index.php
          header("Location: index.php");
          exit;

      } else {
          echo "<h1>Error</h1>";
          echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";
      }
  } else {
      ?>

     <h1>Member Login</h1>

     <p>Thanks for visiting! Please either login below, or <a href="register.php">click here to register</a>.</p>

      <form method="post" action="login.php" name="loginform" id="loginform">
      <fieldset>
          <label for="email">Email:</label><input type="text" name="email" id="email" value="richardhuf84@gmail.com" autofocus /><br />
          <label for="password">Password:</label><input type="password" name="password" id="password" value="messatsu1984" /><br />
          <input type="submit" name="login" id="login" value="Login" />
      </fieldset>
      </form>

     <?php
  }

  include('includes/footer.php');

?>

<?php

  /*
   * User login page
   */

   include('includes/init.php');
  //  include('includes/header.php');

   if(!empty($_POST['email']) && !empty($_POST['password'])) {
     // Setup $_POST vars
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

      // Vars from DB
      // First Name

      // echo "<pre>";
      // var_dump($dbUserArray);
      // echo "</pre>";

      // User ID from database
      $UserID = $dbUserArray[0]['UserID'];

      // First Name
      $firstName = $dbUserArray[0]['First Name'];

      // Last Name
      $lastName = $dbUserArray[0]['Last Name'];


      // Password hash from database
      $hash = $dbUserArray[0]['password'];

      // use password_verify to match $password from user submitted form against the hash from the database
      if (password_verify($password, $hash)) {
          // Set session vars for email and logged in state
          $email = $dbUserArray[0]['Email'];
          $_SESSION['Email']      = $email;
          $_SESSION['LoggedIn']   = 1;
          $_SESSION['UserID']     = $UserID;
          $_SESSION['FirstName']  = $firstName;
          $_SESSION['LastName']   = $lastName;

          // Redirect to index.php
          header("Location: index.php");
          exit;
          ?>
          <!-- <meta http-equiv="refresh" content="0;index.php"> -->
          <?php

      } else {
          echo "<h1>Error</h1>";
          echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";
      }
  }

  include('includes/footer.php');

?>

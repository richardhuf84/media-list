<?php

  // DB config
  include_once('includes/config.php');

  /*
   * User login page
   */

   if(!empty($_POST['email']) && !empty($_POST['password'])) {
      // Setup $_POST vars
      // TODO replace with PDO alternative
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Lookup users table for email address and get password hash
      try {
          $results = $db->query("SELECT * FROM users WHERE Email =  '" . $email . "'");
      } catch (Exception $e){
          echo "Your email could not be found in the database..";
          exit;
      }

      $dbUserArray = ($results->fetchAll(PDO::FETCH_ASSOC));

      // User ID from database
      $UserID = $dbUserArray[0]['UserID'];

      // First Name
      $firstName = $dbUserArray[0]['FirstName'];

      // Last Name
      $lastName = $dbUserArray[0]['LastName'];

      // Keep Logged In
      $keepLoggedIn = $dbUserArray[0]['KeepLoggedIn'];

      // Password hash from database
      $hash = $dbUserArray[0]['Password'];

      // use password_verify to match $password from user submitted form against the hash from the database
      if (password_verify($password, $hash)) {
          // Set session vars for email and logged in state
          $email = $dbUserArray[0]['Email'];
          //var_dump($_SESSION);
          $_SESSION['Email']        = $email;
          $_SESSION['UserID']       = $UserID;
          $_SESSION['FirstName']    = $firstName;
          $_SESSION['LastName']     = $lastName;
          var_dump($_SESSION);
          $_SESSION['keep_logged_in'] = $KeepLoggedIn;

          // Set Cookie to track sessionID
          $cookieName     = "SessionID";
          $cookieValue    = $sessionID;

          // Cookie will expire in 1 month
          $cookieExpires  = time() + (86400 * 30); // 86400 = 1 day

          // Set sessionID cookie
          setcookie($cookieName, $cookieValue, time() + $cookieExpires);

          // Set authorized cookie
          setcookie('authorized', 1, time() + $cookieExpires);

          // Set first name cookie
          setcookie('first_name', $firstName, time() + $cookieExpires);
      }

      // // If keep logged in is checked, we set a value in the db, to be used with a session
      if($_POST['keep_logged_in'] !== NULL){
        $keepLoggedInQuery = mysql_query("INSERT INTO users(KeepLoggedIn) VALUES(1)");
        $db->exec($keepLoggedInQuery);
      }

      // Redirect to index.php
      header("Location: index.php");
      exit;
  }

?>

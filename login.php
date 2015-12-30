<?php

  /*
   * User login page
   */

   include('includes/init.php');

   if(!empty($_POST['email']) && !empty($_POST['password'])) {
      // Setup $_POST vars
      // TODO replace with PDO alternative
      $email = mysql_real_escape_string($_POST['email']);
      $password = $_POST['password'];

      // Lookup users table for email address and get password hash
      try {
          $results = $db->query("SELECT * FROM users WHERE Email =  '" . $email . "'");
      } catch (Exception $e){
          echo "Your email ould not be found in the database..";
          exit;
      }

      $dbUserArray = ($results->fetchAll(PDO::FETCH_ASSOC));

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
          $_SESSION['Email']        = $email;
          $_SESSION['UserID']       = $UserID;
          $_SESSION['FirstName']    = $firstName;
          $_SESSION['LastName']     = $lastName;
          $_SESSION['KeepLoggedIn'] = $KeepLoggedIn;

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
      // if($_POST['keep-logged-in']){
      //   $keepLoggedInQuery = mysql_query("INSERT INTO users(keeploggedin) VALUES('true')");
      //   $db->exec($keepLoggedInQuery);
      // }

      // Redirect to index.php
      header("Location: index.php");
      exit;
  }

  include('includes/footer.php');

?>

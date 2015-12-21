<?php

  /**
   *
   * This file allows users to register with their email address and password
   * and then redirects back to index.php
   *
   */

  include('includes/header.php');
  include('includes/init.php');

  if(!empty($_POST['email']) && !empty($_POST['password'])) {
    $firstName  = mysql_real_escape_string($_POST['first-name']);
    $lastName   = mysql_real_escape_string($_POST['last-name']);
    $email      = mysql_real_escape_string($_POST['email']);
    $password   = $_POST['password'];
    $password   = password_hash($password, PASSWORD_DEFAULT);
    $checkemail = mysql_query("SELECT * FROM users WHERE Email = '". $email ."'");

    if(mysql_num_rows($checkemail) == 1) {
      echo "<h1>Error</h1>";
      echo "<p>Sorry, that username is taken. Please go back and try again.</p>";
    } else {

      $registerQuery = "INSERT INTO users(First Name, Last Name, Email, password) VALUES(
        '" . $firstName . "',
        '" . $lastName . "',
        '" . $email . "',
        '" . $password . "')";
      $db->exec($registerQuery);

      if($registerQuery) {
        echo "<h1>Success</h1>";
        echo "<p>Your account was successfully created. Please <a href=\"login.php\">click here to login</a>.</p>";
        // rediret back to index.php
        header("Location: index.php");
        exit;

      } else {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, your registration failed. Please go back and try again.</p>";
      }
    }
  } else { ?>

    <h1>Register</h1>

    <p>Please enter your details below to register.</p>

    <form method="post" action="register.php" name="registerform" id="registerform">
    <fieldset>
      <div class="input-wrap">
          <label for="first-name">Fist Name:</label><input type="text" name="first-name" id="first-name" />
      </div>
      <div class="input-wrap">
          <label for="last-name">Last Name:</label><input type="text" name="last-name" id="last-name" />
      </div>
      <div class="input-wrap">
          <label for="email">Email Address:</label><input type="text" name="email" id="email" />
      </div>
      <div class="input-wrap">
          <label for="password">Password:</label><input type="password" name="password" id="password" />
      </div>
      <input type="submit" name="register" id="register" value="Register" />
    </fieldset>
    </form>

      <?php
  }

  inlude('includes/footer.php');

?>

<?php
  include('includes/header.php');
  include('includes/db-config.php');

  if(!empty($_POST['email']) && !empty($_POST['password']))
  {
       $email = mysql_real_escape_string($_POST['email']);
       $password = $_POST['password'];
       $password = password_hash($password, PASSWORD_DEFAULT);

       $checkemail = mysql_query("SELECT * FROM users WHERE Email = '". $email ."'");

       if(mysql_num_rows($checkemail) == 1) {
          echo "<h1>Error</h1>";
          echo "<p>Sorry, that username is taken. Please go back and try again.</p>";
       } else {

          $registerQuery = "INSERT INTO users(Email, password) VALUES('" . $email . "', '" . $password . "')";
          $db->exec($registerQuery);

          if($registerQuery) {
              echo "<h1>Success</h1>";
              echo "<p>Your account was successfully created. Please <a href=\"login.php\">click here to login</a>.</p>";
          } else {
              echo 'test';
              echo "<h1>Error</h1>";
              echo "<p>Sorry, your registration failed. Please go back and try again.</p>";
          }
       }
  } else {
  ?>

     <h1>Register</h1>

     <p>Please enter your details below to register.</p>

      <form method="post" action="register.php" name="registerform" id="registerform">
      <fieldset>
          <label for="email">Email Address:</label><input type="text" name="email" id="email" /><br />
          <label for="password">Password:</label><input type="password" name="password" id="password" /><br />
          <input type="submit" name="register" id="register" value="Register" />
      </fieldset>
      </form>

      <?php
  }

  inlude('includes/footer.php');

?>

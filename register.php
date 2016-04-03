<?php

  /**
   *
   * This file allows users to register with their email address and password
   * and then redirects back to index.php
   *
   */

  include_once('includes/config.php');
  include_once('includes/header.php');

  ?>
    <h1>Register</h1>

    <p>Please enter your details below to register.</p>

    <form method="post" action="validate.php" name="registerform" id="registerform">
    <fieldset>
      <div class="input-wrap">
          <label for="first-name">First Name:</label>
          <input type="text" name="first-name" id="first-name" value="Richard" />
      </div>
      <div class="input-wrap">
          <label for="last-name">Last Name:</label>
          <input type="text" name="last-name" id="last-name" value="Huf" />
      </div>
      <div class="input-wrap">
          <label for="email">Email Address:</label>
          <input type="text" name="email" id="email" value="richardhuf84@gmail.com" />
      </div>
      <div class="input-wrap">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" value="12345" />
      </div>
      <input type="submit" name="register" id="register" value="Register" />
    </fieldset>
    </form>

  <?php include('includes/footer.php') ?>

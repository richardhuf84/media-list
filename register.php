<?php

  /**
   *
   * This file allows users to register with their email address and password
   * and then redirects back to index.php
   *
   */

  include('includes/header.php');
  include('includes/init.php');

  ?>
    <h1>Register</h1>

    <p>Please enter your details below to register.</p>

    <form method="post" action="validate.php" name="registerform" id="registerform">
    <fieldset>
      <div class="input-wrap">
          <label for="first-name">First Name:</label>
          <input type="text" name="first-name" id="first-name" value="Melissa" />
      </div>
      <div class="input-wrap">
          <label for="last-name">Last Name:</label>
          <input type="text" name="last-name" id="last-name" value="Marshall" />
      </div>
      <div class="input-wrap">
          <label for="email">Email Address:</label>
          <input type="text" name="email" id="email" value="melissa01@gmail.com" />
      </div>
      <div class="input-wrap">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" value="12345" />
      </div>
      <input type="submit" name="register" id="register" value="Register" />
    </fieldset>
    </form>

  <?php include('includes/footer.php') ?>

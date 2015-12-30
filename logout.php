<?php

  // remove all session variables
  session_unset();

  // destroy the session
  session_destroy();

  // Reset cookie variables
  setcookie('authorized', "", time() - 3600);
  setcookie('first_name', "", time() - 3600);

  // Redirect to index.php
  header("Location: index.php");
  exit;

  ?>

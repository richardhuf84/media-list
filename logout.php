<?php
  include_once("includes/init.php");

  $_SESSION = array();
  session_destroy();

  // Redirect to index.php
  header("Location: index.php");
  exit;
  ?>

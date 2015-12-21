<?php

  // Error reporting
  // error_reporting(E_ALL); ini_set('display_errors', 'On');

  // Include functions file
  include_once('functions.php');

  // Start a session
  session_start();

  // Connect to DB
  include_once('db-config.php');

  // Read entries
  include_once('read.php');



?>

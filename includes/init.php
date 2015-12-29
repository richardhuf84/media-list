<?php

  // // If session is not started, start one.
  if($_SESSION == 0) {
    session_start();
    $sessionID = session_id();
  }

  // Error reporting
  // error_reporting(E_ALL); ini_set('display_errors', 'On');

  // Include functions file
  include_once('functions.php');

  // Connect to DB
  include_once('db-config.php');

  // Read entries
  include_once('read.php');

?>

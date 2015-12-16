<?php

  // Try to connect to the database
  try {
      $db = new PDO("mysql:host=localhost;dbname=media;port=8889","root","root");
      $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $db->exec("SET NAMES 'utf8'");
  } catch (Exception $e) {
      echo "Could not connect to database";
      exit;
  }

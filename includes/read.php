<?php

  include_once('config.php');

  if(isset($_SESSION) && isset($_SESSION['UserID'])) {

    // READ
    try {
        $results = $db->query("SELECT mediaid, title, year, plot, posterURL, director, genre, media_type FROM media WHERE userID = " . $_SESSION['UserID'] . " ORDER BY mediaid DESC");
    } catch (Exception $e){
        echo "Data could not be retrieved from the database.";
        exit;
    }

    $mediaList = ($results->fetchAll(PDO::FETCH_ASSOC));
  }

?>

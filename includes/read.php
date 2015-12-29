<?php

  // var_dump($_SESSION['UserID']);

  if(isset($_SESSION) && isset($_SESSION['UserID'])) {
    // echo 'we have a session and a user id';
    // echo 'test';
    // READ
    // Get list of dvd's from dvds table ordered by id asc
    try {
        $results = $db->query("SELECT mediaid, title, year, plot, posterURL, director, genre, media_type FROM media WHERE userID = " . $_SESSION['UserID'] . " ORDER BY mediaid DESC");
    } catch (Exception $e){
        echo "Data could not be retrieved from the database.";
        exit;
    }

    $mediaList = ($results->fetchAll(PDO::FETCH_ASSOC));
  }

?>

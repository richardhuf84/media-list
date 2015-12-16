<?php

  // READ
  // Get list of dvd's from dvds table ordered by id asc
  try {
      $results = $db->query("SELECT id, title, year, plot, posterURL, director, genre, media_type FROM media ORDER BY id DESC");
  } catch (Exception $e){
      echo "Data could not be retrieved from the database.";
      exit;
  }

  $mediaList = ($results->fetchAll(PDO::FETCH_ASSOC));

?>

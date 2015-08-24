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

    // CREATE
    // If request method is post, insert dvd title into the database
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        // Check for imdbid 
        if ($_POST['dvd-imdbid']) {
            $dvdIMDBID = trim($_POST['dvd-imdbid']);
            $dvdIMDBID = filter_var($dvdIMDBID, FILTER_SANITIZE_STRING);

            // Query to see if imdbid exists in the database
            try {
                $results = $db->query("SELECT imdbid FROM dvds");
            } catch (Exception $e){
                echo "Data could not be retrieved from the database.";
                exit;
            }

            $queryForIMDBID = [];
            $queryForIMDBID = ($results->fetchAll(PDO::FETCH_ASSOC));

            if ($queryForIMDBID[0]['imdbid'] == $dvdIMDBID) {
                $errorMessage = 'This title already exists in the database.';
            } else {

                if ($_POST['update'] == 'add') {
                   
                    if ($_POST['dvd-title'] && $_POST['dvd-year']) {

                        // Reset vars
                        $dvdTitle = '';
                        $dvdYear = '';

                        // Trim whitespace from title
                        $dvdTitle   = trim($_POST["dvd-title"]);
                        // Sanitize input
                        $dvdTitle   = filter_var($dvdTitle, FILTER_SANITIZE_STRING);
                        // Encode title as url
                        $urlEncodedTitle = urlencode($dvdTitle);

                        // DVD Year
                        $dvdYear    = $_POST["dvd-year"];

                        // JSON call
                        $json=file_get_contents("http://www.omdbapi.com/?t=$urlEncodedTitle&y=$dvdYear");
                        $details=json_decode($json);

                        if ($details->Response=='True') {   
                            $dvdIMDBID     = $details->imdbID;
                            $dvdPoster     = $details->Poster;
                            $dvdDirector   = $details->Director;
                            $dvdWriter     = $details->Writer;
                            $dvdActors     = $details->Actors;
                            $dvdPlot       = $details->Plot;
                            $dvdIMDBRating = $details->imdbRating;
                            $dvdGenre      = $details->Genre;
                        }

                        // Insert new dvd item POST values into the database
                        $sqlInsert = "INSERT INTO dvds(imdbid, title, year, plot, posterURL, director, genre) VALUES(
                            '" . $dvdIMDBID . "',
                            '" . $dvdTitle . "',
                            '" . $dvdYear . "',
                            '" . $dvdPlot . "',
                            '" . $dvdPoster . "',
                            '" . $dvdDirector . "',
                            '" . $dvdGenre . "')";
                        $db->exec($sqlInsert);

                        // unset($_POST['dvd-title']);
                        // unset($_POST['dvd-year']);
                        // unset($_POST['dvd-imdbid']);
                    }
                }
            }
        }
      
        // DELETE
        if($_POST['update'] == 'delete') {
            foreach($_POST['delete'] as $key => $value) {
                $sqlDelete = "DELETE from dvds WHERE id = $key";
                $db->exec($sqlDelete);
            }    
        }
    }

    // READ
    // Get list of dvd's from dvds table ordered by id asc
    try {
        $results = $db->query("SELECT id, title, year, plot, posterURL, director, genre FROM dvds ORDER BY id DESC");
    } catch (Exception $e){
        echo "Data could not be retrieved from the database.";
        exit;
    }

    $DVDS = ($results->fetchAll(PDO::FETCH_ASSOC));

?>

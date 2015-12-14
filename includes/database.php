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
        if ($_POST['media-imdbid']) {
            $mediaIMDBID = trim($_POST['media-imdbid']);
            $mediaIMDBID = filter_var($mediaIMDBID, FILTER_SANITIZE_STRING);

            // Query to see if imdbid exists in the database
            try {
                $results = $db->query("SELECT imdbid FROM media");
            } catch (Exception $e){
                echo "Data could not be retrieved from the database.";
                exit;
            }

            $queryForIMDBID = [];
            $queryForIMDBID = ($results->fetchAll(PDO::FETCH_ASSOC));

            if ($queryForIMDBID[0]['imdbid'] == $mediaIMDBID) {
                $errorMessage = 'This title already exists in the database.';
            } else {

                if ($_POST['update'] == 'add') {

                    if ($_POST['media-title'] && $_POST['media-year']) {

                        // Add cookie to track submission
                        // include_once('cookie.php');

                        // Reset vars
                        $mediaTitle = '';
                        $mediaYear = '';

                        // Trim whitespace from title
                        $mediaTitle   = trim($_POST["media-title"]);
                        // Sanitize input
                        $mediaTitle   = filter_var($mediaTitle, FILTER_SANITIZE_STRING);
                        // Encode title as url
                        $urlEncodedTitle = urlencode($mediaTitle);

                        // Media Year
                        $mediaYear    = $_POST["media-year"];

                        // JSON call
                        $json=file_get_contents("http://www.omdbapi.com/?t=$urlEncodedTitle&y=$mediaYear");
                        $details=json_decode($json);

                        if ($details->Response=='True') {
                            $mediaIMDBID     = $details->imdbID;
                            $mediaPoster     = $details->Poster;
                            $mediaDirector   = $details->Director;
                            $mediaWriter     = $details->Writer;
                            $mediaActors     = $details->Actors;
                            $mediaPlot       = $details->Plot;
                            $mediaIMDBRating = $details->imdbRating;
                            $mediaGenre      = $details->Genre;
                        }

                        // Media type (eg. dvd, bluray)
                        $mediaType = '';

                        // Set value of media type
                        if($_POST['media-type'] == 'bluray') {
                            $mediaType = 'bluray';
                        } else if($_POST['media-type'] == 'dvd') {
                            $mediaType = 'dvd';
                        }

                        // Insert new dvd item POST values into the database
                        $sqlInsert = "INSERT INTO media(imdbid, title, year, plot, posterURL, director, genre, media_type) VALUES(
                            '" . $mediaIMDBID . "',
                            '" . $mediaTitle . "',
                            '" . $mediaYear . "',
                            '" . $mediaPlot . "',
                            '" . $mediaPoster . "',
                            '" . $mediaDirector . "',
                            '" . $mediaGenre . "',
                            '" . $mediaType . "')";
                        $db->exec($sqlInsert);

                        // header("Location: http://localhost:8888/media-list/index2.php");
                    }
                }
            }
        }

        // DELETE
        if($_POST['update'] == 'delete') {
            foreach($_POST['delete'] as $key => $value) {
                $sqlDelete = "DELETE from media WHERE id = $key";
                $db->exec($sqlDelete);
            }
        }
    }

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

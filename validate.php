<?php

  include_once('includes/config.php');

  // validate.php performs form validation and CRUD operations, then redirects back to index.php

  if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    /**
     *
     * CREATE
     * insert media title into the database
     *
     */

    // Check for imdbid
    if (isset($_POST['media-imdbid'])) {

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

          // header("Location: index.php");
          // exit;

        } else {

            if (isset($_POST['update']) && ($_POST['update'] == 'add')) {

                if ($_POST['media-title'] && $_POST['media-year']) {

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
                    $json = file_get_contents("http://www.omdbapi.com/?t=$urlEncodedTitle&y=$mediaYear");
                    $details = json_decode($json);

                    if ($details->Response == 'True') {
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

                    // UserID
                    $userID = $_SESSION['UserID'];

                    // Insert new dvd item POST values into the database
                    $sqlInsert = "INSERT INTO media(userid, imdbid, title, year, plot, posterURL, director, genre, media_type) VALUES(
                        '" . $userID . "',
                        '" . $mediaIMDBID . "',
                        '" . $mediaTitle . "',
                        '" . $mediaYear . "',
                        '" . $mediaPlot . "',
                        '" . $mediaPoster . "',
                        '" . $mediaDirector . "',
                        '" . $mediaGenre . "',
                        '" . $mediaType . "')";
                    $db->exec($sqlInsert);
                }

                header("Location: index.php");
                exit;

            }
        }
    }

    // Delete entry

    // DELETE
    if(isset($_POST['update']) && $_POST['update']  == 'delete') {
        foreach($_POST['delete'] as $key => $value) {
            $sqlDelete = "DELETE from media WHERE mediaid = $key";
            $db->exec($sqlDelete);

            header("Location: index.php");
            exit;
        }
    }

    // Register User

    if(!empty($_POST['email']) && !empty($_POST['password'])) {
      global $firstName  = $_POST['first-name'];
      global $lastName   = $_POST['last-name'];
      global $email      = $_POST['email'];
      $password   = $_POST['password'];
      $password   = password_hash($password, PASSWORD_DEFAULT);

      // Check if email already exists in database
      try {
          $checkEmailExists = $db->query("SELECT * FROM users WHERE Email = '" . $email . "'");
      } catch (Exception $e){
          echo "Data could not be retrieved from the database.";
          exit;
      }

      //var_dump($checkEmailExists);

      // if($checkEmailExists) == 1) {
      //   echo 'Email already exists';
      //   // redirect back to index.php
      //   // TODO set GET var to alert user that the email already exists in the database
      //   header("Location: index.php?registration=true&emailexists=true");
      //   exit;
      // }

      $registerQuery = "INSERT INTO users(FirstName, LastName, Email, password) VALUES(
        '" . $firstName . "',
        '" . $lastName . "',
        '" . $email . "',
        '" . $password . "')";
      $db->exec($registerQuery);

      // if($registerQuery) {
      //     // TODO set GET var to alert user that their registration is successful, and ask them to login
      //     header("Location: index.php?registered=true");
      //     exit;
      //
      //   // } else {
      //   // //  header("Location: register.php");
      //   // //  exit;
      //   }
      // }

      // Send an email to tell the user that they have registered.
      // We use Gmail's SMTP server
      // $mail = new PHPMailer;
      //
      // //Enable SMTP debugging.
      // $mail->SMTPDebug = 3;
      // //Set PHPMailer to use SMTP.
      // $mail->isSMTP();
      // //Set SMTP host name
      // $mail->Host = "smtp.gmail.com";
      // //Set this to true if SMTP host requires authentication to send email
      // $mail->SMTPAuth = true;
      // //Provide username and password
      // $mail->Username = "richardhuf84@gmail.com";
      // $mail->Password = "messatsu";
      // //If SMTP requires TLS encryption then set it
      // $mail->SMTPSecure = "tls";
      // //Set TCP port to connect to
      // $mail->Port = 587;
      //
      // $mail->From = "richardhuf84@gmail.com";
      // $mail->FromName = "Media List";
      //
      // $mail->addAddress("richardhuf84@gmail.com", "Richard");
      //
      // $mail->isHTML(true);
      //
      // $mail->Subject = "Welcome to the Media List App!";
      // $mail->Body = "<i>Congratulations</i>";
      // $mail->AltBody = "This is the plain text version of the email content";
      //
      // if(!$mail->send()) {
      //     echo "Mailer Error: " . $mail->ErrorInfo;
      // } else {
      //     echo "Message has been sent successfully";
      // }
      //
      // if(!$mail->send()) {
      //     echo "Mailer Error: " . $mail->ErrorInfo;
      // } else {
      //     echo "Message has been sent successfully";
      // }

      header("Location: index.php");
      exit;

    }
  }

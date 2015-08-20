<!doctype html>
<!--[if lt IE 7 ]><html itemscope itemtype="http://schema.org/Product" id="ie6" class="ie ie-old" lang="en-US" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 7 ]>   <html itemscope itemtype="http://schema.org/Product" id="ie7" class="ie ie-old" lang="en-US" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 8 ]>   <html itemscope itemtype="http://schema.org/Product" id="ie8" class="ie ie-old" lang="en-US" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 9 ]>   <html itemscope itemtype="http://schema.org/Product" id="ie9" class="ie" lang="en-US" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if gt IE 9]><!--><html itemscope itemtype="http://schema.org/Product" lang="en-US" prefix="og: http://ogp.me/ns#"><!--<![endif]-->
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <title>Media List - Ali & Rich</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Favicons -->
    <link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="http://scotch.io/favicon.ico">

    <!-- Open Sans -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

    <!-- Normalise -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" rel="stylesheet" type="text/css">

    <!-- JQuery UI CSS -->
    <!--<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" />-->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Main stylesheet -->
    <link href='css/style.css' rel='stylesheet' type='text/css'>

    <!-- Jquery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Jquery UI -->
    <!--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
    
    <!-- Main js file -->
    <script src="js/scripts.js"></script>

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

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

        if ($_POST['dvd-title'] && $_POST['dvd-year']) {

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
            // print_r($json);

            $details=json_decode($json);

            if($details->Response=='True') {   
                $dvdIMDBID     = $details->imdbID;
                $dvdPoster     = $details->Poster;
                $dvdDirector   = $details->Director;
                $dvdWriter     = $details->Writer;
                $dvdActors     = $details->Actors;
                $dvdPlot       = $details->Plot;
                $dvdIMDBRating = $details->imdbRating;
                // "Title : ".$details->Title.';
                // "Year : ".$details->Year.';
                // "Rated : ".$details->Rated.';
                // "Runtime : ".$details->Runtime.';
                // "Genre : ".$details->Genre.';
                // "Language : ".$details->Language.';
                // "Country : ".$details->Country.';
                // "Awards : ".$details->Awards.';
                // "Metascore : ".$details->Metascore.';
                // "IMDB Votes : ".$details->imdbVotes.';
            }

            // Insert new dvd item POST values into the database
            $sqlInsert = "INSERT INTO dvds(title, year, plot, posterURL, director) VALUES('" . $dvdTitle . "','" . $dvdYear . "','" . $dvdPlot . "','" . $dvdPoster . "','" . $dvdDirector . "')";
            $db->exec($sqlInsert);


        } // else {
            // $errorMessage = "You must specify a title and year";    
        // }

        // DELETE
        foreach($_POST['delete'] as $key => $value) {
            $sqlDelete = "DELETE from dvds WHERE id = $key";
            $db->exec($sqlDelete);
        }    

        // Unset $_POST so page refresh won't submit the data again
        unset($_POST);
    }

    // READ
    // Get list of dvd's from dvds table ordered by id asc
    try {
        $results = $db->query("SELECT id, title, year, plot, posterURL, director FROM dvds ORDER BY id DESC");
    } catch (Exception $e){
        echo "Data could not be retrieved from the database.";
        exit;
    }

    $DVDS = ($results->fetchAll(PDO::FETCH_ASSOC));

    ?>

    <header class="site-header">
        <h1 class="site-logo">Ali & Rich's DVD List</h1>
<!--         <nav class="site-nav">
            <ul class="site-nav-ul">
                <li>DVD's</li>
            </ul>
        </nav> -->
    </header>
 
    <section class="page-wrap">
        <?php if (isset($errorMessage) && !empty($errorMessage)) {
            print "<p class='error-message'>$errorMessage <span class='error-message-close'>X</span></p>"; 
        } ?>

        <form class="dvd-submit-form" method="post" action="index.php">
            <fieldset class="fieldset-add-title">
                <div class="field-dvd-title">
                    <label class="label-dvd-title" for="dvd-title">DVD Title</label>
                    <input type="text" name="dvd-title" id="dvd-title" autocomplete="off">
                </div>
                <div class="field-dvd-year">
                    <label class="label-dvd-year" for="dvd-year">Year of release</label>
                    <select id="dvd-year" name="dvd-year">            
                        <option value="">Please select</option>
                        <?php 
                        $currentYear = date("Y");

                        for ($i = 0; $i < 70; $i++) {
                            $previousYear = $currentYear - $i;
                            print "<option value='" . $previousYear . "'>" . $previousYear . "</option>";                
                    } ?>
                    </select>
                </div>
                <button type="submit" name="add" value="add"><i class="fa fa-plus-circle">Add</i></button>
            </fieldset>        
            <ul class="dvd-list">
                <?php
                foreach ($DVDS as $DVD) {
                    $dvdID          = $DVD['id'];
                    $dvdTitle       = $DVD['title'];
                    $dvdYear        = $DVD['year'];
                    $dvdPlot        = $DVD['plot'];
                    $dvdPoster      = $DVD['posterURL'];
                    $dvdDirector    = $DVD['director'];

                    ?>
                        <li id="dvd-<?php print $dvdID; ?>" class="media-item cf">
                            <p class="media-item-title-year">
                                <span class="media-item-title"><?php print $dvdTitle; ?></span> - <span class="media-item-year"><?php print $dvdYear; ?></span>
                            </p> 
                            <div class="media-item-edit">
                                <a href="#" class="media-item-detail-toggle">Details</a>
                                <input type="checkbox" name="delete[<?php print $dvdID; ?>]" class="delete-item" id="delete[<?php print $dvdID; ?>]">
                                <label for="delete[<?php print $dvdID; ?>]"><i class="fa fa-trash-o"></i></label>
                            </div>
                            <div class="media-item-detail">
                                <div class="media-item-detail-poster">
                                    <img src="<?php print $dvdPoster; ?>" class="media-item-poster-img">
                                </div>
                                <div class="media-item-detail-meta">
                                    <div class="media-item-plot">
                                        <p><?php print $dvdPlot; ?></p>
                                    </div>
                                    <dvd class="media-item-director">
                                        <p>
                                            <strong>Directed by:</strong> <span><?php print $dvdDirector; ?></span>
                                        </p>
                                    </div>
                                    <!-- TODO: add more details -->
                                </div>
                            </div>
                        </li>
                <?php } ?>
            </ul>
            <button type="submit" name="delete" class="submit-delete"><i class="fa fa-trash-o"></i>Delete</button>
        </form>

        <footer class="site-footer">
            <p>Another awesome PHP app by <a href="http://richardhuf.com.au" class="site-credit">Richard Huf</a></p>
        </footer>
    </section>

</body>
</html>
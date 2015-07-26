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

    <!-- Main stylesheet -->
    <link href='css/style.css' rel='stylesheet' type='text/css'>

    <!-- Scripts -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    
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

// =============

    // the form has fields for name, email, and message
    // $name = trim($_POST["name"]);
    // $email = trim($_POST["email"]);
    // $message = trim($_POST["message"]);

// =============

    // If request method is post, insert dvd title into the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dvdTitle   = trim($_POST["dvd-title"]);
        $dvdYear    = trim($_POST["dvd-year"]);
        $dvdToDelete = trim($_POST["id"]);

        // Error handling: the fields dvd-title and dvd-year are required

        // If there is no dvd being deleted,
        // perform error handling on dvd title entry
        // if ($dvdToDelete == "") {
        if ($dvdTitle == "" && $dvdYear !== "") {
            $error_message = "You must specify a value for DVD title.";
        } elseif($dvdTitle !== "" && $dvdYear == "") {
            $error_message = "You must specify a value for year.";
        } elseif($dvdTitle == "" && $dvdYear == "") {
            $error_message = "You must specify a value for DVD title and year.";
        }
        // If any dvd's are to be deleted, empy the values of dvdTitile and dvdYear, so nothing gets entered.    
        // } else if($dvdToDelete !== "") {
        //     $dvdTitle   = "";
        //     $dvdYear    = "";
        // }

        // Insert new dvd item POST values into the database
        $sqlInsert = "INSERT INTO dvds(title, year) VALUES('" . $dvdTitle . "','" . $dvdYear . "')";
        $db->exec($sqlInsert);

        // Delete dvd items checked as delete
        // $sqlDelete = "DELETE FROM dvds WHERE id='" . $dvdToDelete . "'";
        // $db->exec($sqlDelete);

        // TODO
        // cleanup so that subsequesnt page refreshes don't add multiple items into the db
    }

    // Get list of dvd's from dvds table ordered by id asc
    try {
        $results = $db->query("SELECT id, title, year FROM dvds ORDER BY year DESC");
    } catch (Exception $e){
        echo "Data could not be retrieved from the database.";
        exit;
    }

    $DVDS = ($results->fetchAll(PDO::FETCH_ASSOC));

    ?>

    <section class="page-wrap">

        <header class="site-header">
            <h1 class="site-logo">Ali & Rich's DVD List</h1>
    <!--         <nav class="site-nav">
                <ul class="site-nav-ul">
                    <li>DVD's</li>
                </ul>
            </nav> -->
            <?php if (isset($error_message) && !empty($error_message)) {
                print "<p class='error-message'>$error_message</p>"; 
            } ?>
        </header>

        <form class="dvd-submit-form" method="post" action="index.php">
            <fieldset class="fieldset-add-title">
                <label for="dvd-title">DVD Title</label>
                <input type="text" name="dvd-title" id="dvd-title">
                <label for="dvd-year">Year of release</label>
                <select id="dvd-year" name="dvd-year">            
                    <option value="">Please select</option>
                    <?php 
                    $currentYear = date("Y");

                    for ($i = 0; $i < 30; $i++) {
                        $previousYear = $currentYear - $i;
                        print "<option value='" . $previousYear . "'>" . $previousYear . "</option>";                
                } ?>
                </select>
                <input type="reset" value="Reset">
            </fieldset>        
            <ul id="sortable" class="dvd-list">
                <?php
                foreach ($DVDS as $DVD) {
                    $dvdID = $DVD['id'];
                    $dvdTitle = $DVD['title'];
                    $dvdYear = $DVD['year'];

                    print "
                        <li id='dvd-" . $dvdID . "' class='media-item'>
                            <span class='icon-move'></span>
                            <span class='media-item-title'>" . $dvdTitle . "</span> - <span class='media-item-year'>" . $dvdYear . "</span> <span class='media-item-desc-toggle'>Description</span><div class='delete-dvd-wrap'><input type='checkbox' name='" . $dvdID . "' class='delete-item' id='" . $dvdID . "' ><label for='" . $dvdID . "'>Delete</label></div><div class='media-item-desc'></div></li>";
                }
                ?>
            </ul>
            <input type="submit" value="Submit">
        </form>

        <footer class="site-footer">
            <p>Another awesome PHP app by <a href="http://richardhuf.com.au" class="site-credit">Richard Huf</a></p>
        </footer>
    </section>

</body>
</html>
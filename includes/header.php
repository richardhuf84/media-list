<!doctype html>
<!--[if lt IE 7 ]><html itemscope itemtype="http://schema.org/Product" id="ie6" class="ie ie-old" lang="en-US" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 7 ]>   <html itemscope itemtype="http://schema.org/Product" id="ie7" class="ie ie-old" lang="en-US" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 8 ]>   <html itemscope itemtype="http://schema.org/Product" id="ie8" class="ie ie-old" lang="en-US" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if IE 9 ]>   <html itemscope itemtype="http://schema.org/Product" id="ie9" class="ie" lang="en-US" prefix="og: http://ogp.me/ns#"><![endif]-->
<!--[if gt IE 9]><!--><html itemscope itemtype="http://schema.org/Product" lang="en-US" prefix="og: http://ogp.me/ns#"><!--<![endif]-->
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <title>Media List</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Favicons -->
    <!-- <link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="favicon.ico"> -->

    <!-- Open Sans -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

    <!-- Normalise -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" rel="stylesheet" type="text/css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Main stylesheet -->
    <link href='css/build/style.css' rel='stylesheet' type='text/css'>

    <script src="js/libs/jquery-2.1.0.min.js"></script>

    <!-- Main js file -->
    <script src="js/scripts.min.js"></script>

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>

    <header class="site-header">
        <div class="user-profile">
          <?php
          if($_COOKIE['authorized']) {
            echo get_gravatar('richardhuf84@gmail.com', 80, '404', 'pg', True, [
              'class'=>'profile-image',
              'alt'=> $_SESSION['FirstName']
               ]);
            echo "<p>Hi, " . $_COOKIE['first_name'] . "</p>";
            echo "<p>Your User ID is " . $_SESSION['UserID'] . "</p>";
            echo "<p class='logout-link'><a href='logout.php'>Logout</a>";
          } else { ?>
          <h3>Login</h3>
          <form method="post" action="login.php" name="loginform" id="loginform">
          <fieldset>
              <div class="input-wrap">
                <label for="email">Email:</label><input type="text" name="email" id="email" value="" placeholder="Email Address" autofocus />
              </div>
              <div class="input-wrap">
              <label for="password">Password:</label><input type="password" name="password" id="password" value="" placeholder="Your password" />
              <div class="input-wrap">
                <label for="keep-logged-in"><input type="checkbox" id="keep-logged-in" name="keep-logged-in">Keep me logged in</label>
              </div>
            </div>
              <input type="submit" name="login" id="login" value="Login" />
              <p class="message register">Not yet a member? <a href="register.php">Register</a>.</p>
              <p class="message forgot-password"><a href="forgot-password.php">I forgot my password</a></p>
          </fieldset>
          </form>
          <?php } ?>
        </div>
        <h1 class="site-logo"><a href="/">Media List</a></h1>
        <p class="site-tagline"><em>Keep track of your Blu Ray and DVD collection.</em></p>
    </header>

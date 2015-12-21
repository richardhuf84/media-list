<?php

  include("includes/header.php");
  include("includes/db-config.php");

  $_SESSION = array();
  session_destroy();
?>
<meta http-equiv="refresh" content="0;index.php">

<?php include("includes/footer.php"); ?>

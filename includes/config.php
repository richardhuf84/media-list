<?php

  /**
   * file: config.php
   */


   /**
   *****************************************************************************
   * TODO - refactor everything to use a database class.
   * http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/
   */


   // Load functions.php
   //  include_once('../functions.php');

   /**
    * If session is not started, start one.
    */
   if($_SESSION == 0) {
     session_start();
     $sessionID = session_id();
   }

   /**
    * Enable PHP Error reporting
    */
   error_reporting(E_ALL);
   ini_set('display_errors', 'On');


  /**
   * DB config
   * Try to connect to the database
   */



  // try {
  //    $db = new PDO("mysql:host=localhost;dbname=media;port=3306","root","root");
  //    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  //    $db->exec("SET NAMES 'utf8'");
  //  } catch (Exception $e) {
  //    echo "Could not connect to database";
  //    exit;
  //  }

  // Include database class
  include 'database.class.php';

  // Define configuration
  define("DB_HOST", "localhost");
  define("DB_USER", "root");
  define("DB_PASS", "root");
  define("DB_NAME", "media");

  $database = new Database();

  // $database->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');

 /**
  * Global Functions
  */

 /**
  * Generates a number of years as options to be added to a select list
  */
  function generateYearOptions($num) {
    $currentYear = date("Y");

    for ($i = 0; $i < $num; $i++) {
       $previousYear = $currentYear - $i;
       print "<option value='" . $previousYear . "'>" . $previousYear . "</option>";
    }
  }

  /**
   * Get either a Gravatar URL or complete image tag for a specified email address.
   *
   * @param string $email The email address
   * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
   * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
   * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
   * @param boole $img True to return a complete IMG tag False for just the URL
   * @param array $atts Optional, additional key/value attributes to include in the IMG tag
   * @return String containing either just a URL or a complete image tag
   * @source http://gravatar.com/site/implement/images/php/
   */
   function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
       $url = 'http://www.gravatar.com/avatar/';
       $url .= md5( strtolower( trim( $email ) ) );
       $url .= "?s=$s&d=$d&r=$r";
       if ( $img ) {
           $url = '<img src="' . $url . '"';
           foreach ( $atts as $key => $val )
               $url .= ' ' . $key . '="' . $val . '"';
           $url .= ' />';
       }
       return $url;
   }

   /**
    * Get Users details from the database
    *
    * @param bool $firstname return 'firstname'
    * @param bool $lastname return 'lastname'
    * @param bool $userid return 'userid'
    * @param bool $email return 'email'
    */
    $first   = '';
    $last    = '';
    $userid  = '';
    $email   = '';
    $atts =  [
      'first' => 'first',
      'last' => 'last',
      'userid' => 'userid',
      'email' => 'email'
    ];
    function user_details( $atts ) {
      $output = $atts['first'] == 'first' ? 'first name from DB' : '';
      return $output;
    }

    /**
     * Read data from database
     */

     // TODO: add back in
     if(isset($_SESSION) && isset($_SESSION['UserID'])) {

       // READ
       try {
           $medialist = $database->query("SELECT mediaid, title, year, plot, posterURL, director, genre, media_type FROM media WHERE userID = " . $_SESSION['UserID'] . " ORDER BY mediaid DESC");
       } catch (Exception $e){
           echo "Data could not be retrieved from the database.";
           exit;
       }

      //  $mediaList = ($results->fetchAll(PDO::FETCH_ASSOC));

      //  var_dump ()$_SESSION['UserID']);

       // Set variable for users first name
      //  try {
      //    $firstNameQuery = $db->query("SELECT FirstName FROM users WHERE UserID = 41")
      //  } catch (Exception $e){
      //      echo "Data could not be retrieved from the database.";
      //      exit;
      //  }
       //
      //  $firstName = ($firstNameQuery->fetchAll(PDO::FETCH_ASSOC));
     }

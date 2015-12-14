<?php
  //
  // $AUTH_COOKIE_NAME = 'Cookie';
  // $cookie_value = '1';
  //
  // setcookie(
  //   $AUTH_COOKIE_NAME,
  //   $cookie_value,
  //   time() + cookie_expiration(),
  //   $BASE_DIRECTORY,
  //   null,
  //   false,
  //   true
  // );


  // Setting new cookie
  // =============================
  // echo 'test 2';

  $int = 3600;
  setcookie("cookie","1",time()+$int);
  /* name is your cookie's name
  value is cookie's value
  $int is time of cookie expires */

  // Getting Cookie
  // =============================
  echo $_COOKIE["cookie"];


?>

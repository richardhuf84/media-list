<?php

  // Generates a number of years as options to be added to a select list
  function generateYearOptions($num) {
      $currentYear = date("Y");

      for ($i = 0; $i < $num; $i++) {
          $previousYear = $currentYear - $i;
          print "<option value='" . $previousYear . "'>" . $previousYear . "</option>";
      }
  }

  // Base URL
  function base_url() {
    return "http://localhost:8888/media-list";
  }

  // // Wrap output in <pre> tag
  // function ml_pretty_dump($content) {
  //   $output = "<pre>", var_dump($content) . "</pre>";
  //
  //   return $output;
  // }

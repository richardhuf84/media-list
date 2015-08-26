<?php

	// Generates a number of years as options to be added to a select list
	function generateYearOptions($num) {
        $currentYear = date("Y");

	    for ($i = 0; $i < $num; $i++) {
	        $previousYear = $currentYear - $i;
	        print "<option value='" . $previousYear . "'>" . $previousYear . "</option>"; 
	    }                  
	}
?>
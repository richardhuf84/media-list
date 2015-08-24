$(document).ready(function() {

	var searchField 		= $('#dvd-title'); 
	var yearField 			= $('#dvd-year');
	var imdbidField			= $('#dvd-imdbid');
	var typingTimer;                //timer identifier
	var doneTypingInterval = 1000;  //time in ms

	// Search OMDB for title 
	function omdbAjaxCall() {
		var jqxhr = $.getJSON('http://www.omdbapi.com/?t=' + searchField.val() + '&type=movie', function(data) {
		
		}).done(function(data) {
			
			// if search result is undefined, give error message
			if(searchField.val() !== '' && typeof data['Title'] == 'undefined') {
				// alert('please refine search');
				$('.suggestion').html('<p>No results found. Please refine your search terms.</p>');
			}

			console.log(data);

			// Set value of search field to returned title
			searchField.val(data['Title']);

			// set value of yeaar select to returned year
			yearField.val(data['Year']);

			// set hidden imdbid field to imdbid
			imdbidField.val(data['imdbID']);

			// Populate suggestion item content
			if(typeof data['Title'] !== 'undefined') {
				var suggestionItemHTML = '';
				suggestionItemHTML += '<img class="suggestion-poster" src=' + data['Poster'] + ' alt=' + data['Title'] + '>';
				suggestionItemHTML += '<h3 class="suggestion-title">' + data['Title'] + '</h3>';
				suggestionItemHTML += '<p class="suggestion-year">' + data['Year'] + '</p>';
				suggestionItemHTML += '<p class="suggestion-plot">' + data['Plot'] + '</p>';

				$('.suggestion').html(suggestionItemHTML);
			} 

		});
	}	

	// Start ajax call after user stops typing for a few seconds
	//on keyup, start the countdown
	searchField.on('keyup', function () {
	  clearTimeout(typingTimer);
	  typingTimer = setTimeout(doneTyping, doneTypingInterval);
	});

	//on keydown, clear the countdown 
	searchField.on('keydown', function () {
	  clearTimeout(typingTimer);
	});

	//user is "finished typing," do something
	function doneTyping () {
	  	omdbAjaxCall();
	}

	// Toggle media item details
	$('.media-item-detail-toggle').click(function(e) {
		e.preventDefault();
		$(this).parent().next().slideToggle(300);
	});

	// Error message close
	$('.error-message-close').click(function() {
		$(this).parent().fadeOut();
	});

	// If there is more than one media item, enable check all checkbox 
	if($('.media-item').length > 1) {
		console.log('media item is greater than one');
		$('#check-all-delete').prop('disabled', false);
	}

	// Check all delete checkboxes
	$('#check-all-delete').click(function() {
		// If this check all checkbox is checked
		if($(this).is(':checked')) {
			// Check all delete checkboxes
			$('.delete-item').prop('checked', true);
			// Change Check all checkbox label
			$('label[for="check-all-delete"]').text('Uncheck all');
		} else {
			// Uncheck all delete checkboxes
			$('.delete-item').prop('checked', false);
			// CHange check all checkbox label
			$('label[for="check-all-delete"]').text('Check all');
		}
	});

});
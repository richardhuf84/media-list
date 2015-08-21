$(document).ready(function() {

	var searchField 		= $('#dvd-title'); 
	var yearField 			= $('#dvd-year');
	var typingTimer;                //timer identifier
	var doneTypingInterval = 3000;  //time in ms, 3 second for example

	// Search OMDB for title 
	function omdbAjaxCall() {
		var jqxhr = $.getJSON('http://www.omdbapi.com/?t=' + searchField.val() + '&type=movie', function(data) {
		
		}).done(function(data) {
			
			// if search result is undefined, give error message
			if(searchField.val() !== '' && typeof data['Title'] == 'undefined') {
				// alert('please refine search');
				$('.suggestion').html('<p>No results found. Please refine your search terms.</p>');
			}

			// Set value of search field to returned title
			searchField.val(data['Title']);

			// set value of yeaar select to returned year
			yearField.val(data['Year']);

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
		console.log('done typing');
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

});
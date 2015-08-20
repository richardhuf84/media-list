$(document).ready(function() {

	// 	$.getJSON('http://www.omdbapi.com/?t=' + OMDBTitle + '&y=&plot=long&r=json', function(data){
	// 		return (data[9]);
	// 	});

	

	// var jqxhr = $.getJSON('http://www.omdbapi.com/?t=' + dvdTitle + '&y=&plot=long&r=json', function(data) {

	// }).done(function(data) {
	// 	console.log(data['Plot']);
	// });

	// Search OMDB for title 
	$('#dvd-title').blur(function(e) {
		console.log('Blur');
		e.preventDefault();
		var searchTitle = $('#dvd-title').val();
		console.log(searchTitle);
		
		var jqxhr = $.getJSON('http://www.omdbapi.com/?t=' + searchTitle + '', function(data) {
		}).done(function(data) {
			console.log(data['Title']);
			// Set value of search field to returned title
			$('#dvd-title').val(data['Title']);
			// set value f yeaar select to returned year
			$('#dvd-year').val(data['Year']);

		});

	});

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
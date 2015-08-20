$(document).ready(function() {

	// 	$.getJSON('http://www.omdbapi.com/?t=' + OMDBTitle + '&y=&plot=long&r=json', function(data){
	// 		return (data[9]);
	// 	});

	

	// var jqxhr = $.getJSON('http://www.omdbapi.com/?t=' + dvdTitle + '&y=&plot=long&r=json', function(data) {

	// }).done(function(data) {
	// 	console.log(data['Plot']);
	// });

	// Search OMDB for title 
	$('#dvd-title').blur(function() {
		var searchTitle = $('#dvd-title').val();		
		var jqxhr = $.getJSON('http://www.omdbapi.com/?t=' + searchTitle + '&type=movie', function(data) {
		}).done(function(data) {
			console.log(data['Title']);
			// Set value of search field to returned title
			$('#dvd-title').val(data['Title']);
			// set value f yeaar select to returned year
			$('#dvd-year').val(data['Year']);
			// Set poster img for suggestion title

			// Populate suggestion item content
			if(typeof data['Title'] !== 'undefined') {
				var suggestionItemHTML = '';
				suggestionItemHTML += '<img class="suggestion-poster" src=' + data['Poster'] + ' alt=' + data['Title'] + '>';
				suggestionItemHTML += '<h3 class="suggestion-title">' + data['Title'] + '</h3>';
				suggestionItemHTML += '<p class="suggestion-year">' + data['Year'] + '</p>';
				suggestionItemHTML += '<p class="suggestion-plot">' + data['Plot'] + '</p>';

				console.log(suggestionItemHTML);
				$('.suggestion').html(suggestionItemHTML);
			} 

			if($('#dvd-title').val() === '') {
				$('.suggestion').html('');
			}
		});
	});

	// $('#dvd-title').autocomplete({
	// 	source: function( request, response ) {
 //        $.ajax({
 //          url: 'http://www.omdbapi.com/?t=',
 //          dataType: "jsonp",
 //          data: {
 //            q: request.term
 //          },
 //          success: function( data ) {
 //            response( data );
 //          }
 //        });
 //      },
 //      minLength: 3,
 //      select: function( event, ui ) {
 //        log( ui.item ?
 //          "Selected: " + ui.item.label :
 //          "Nothing selected, input was " + this.value);
 //      },
 //      open: function() {
 //        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
 //      },
 //      close: function() {
 //        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
 //      }
	// });
	

	// Toggle media item details
	$('.media-item-detail-toggle').click(function(e) {
		e.preventDefault();
		$(this).parent().next().slideToggle(300);

		// // window.setTimeout(2000);
		// $(this).parent().next().find('.media-item-poster-img').toggle();
	});

	// Error message close
	$('.error-message-close').click(function() {
		$(this).parent().fadeOut();
	});

});
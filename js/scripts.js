$(document).ready(function() {
    // $(function() {
    //     $( "#sortable" ).sortable();
    //     $( "#sortable" ).disableSelection();
    // });
	$('.icon-move').hide();

	// Loop through each dvd title and get the description from OMDB
	var dvdCount = $('.media-item').length;
	// console.log(dvdCount);
	// for(var i = 0; i < dvdCount; i++) {

	// }

	$('.media-item').each(function(i) {
		// dvd title to query OMDB with
		var dvdTitle = $(this).find('.media-item-title').text();
		// make lowecase
		dvdTitle = dvdTitle.toLowerCase();
		// replace and spaces with +
		dvdTitle = dvdTitle.split(' ').join('+');

		// console.log(dvdTitle);

		$.getJSON('http://www.omdbapi.com/?t=' + dvdTitle + '&y=&plot=long&r=json', function(data) {
			// var items = [];

			console.log(data);
			// console.log(i + 1);
			// $('.media-item-desc:nth-child(' + i + ')').html(data['Plot']);
			$('.media-item-desc:nth-child(' + (i + 1) + ')').text(data['Plot']);

			// console.log(this);

			// console.log(data);
			// $.each( data, function( key, val ) {
			//     items.push( "<p id='" + key + "'>" + val + "</p>" );
  	// 		});

			// console.log(items);
			// console.log(this);		
		
			// $(this).find('.media-item-desc').append(items[9]);

			// console.log(data);

			// $( "<ul/>", {
			//     "class": "my-new-list",
     		//	html: items.join( "" )
  	 		//	}).appendTo( "body" );
			// });

			// console.log(dvdCount);

			// $('.media-item-desc').each(function(e) {
				// console.log(this.length);
				// $(this).html(items[9]);
				// console.log(items);
				// for (var i = 0; i < dvdCount; i++) {

				// }

			// });

		});

	});
});



////

// $.get("demo_test.asp", function(data, status){
// 		alert("Data: " + data + "\nStatus: " + status);
//   });
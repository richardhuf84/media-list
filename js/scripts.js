$(document).ready(function() {
    // $(function() {
    //     $( "#sortable" ).sortable();
    //     $( "#sortable" ).disableSelection();
    // });
	$('.icon-move').hide();

	// Loop through each dvd title and get the description from OMDB
	// var dvdCount = $('.media-item').length;
	// console.log(dvdCount);
	// for(var i = 0; i < dvdCount; i++) {

	// }

	// $('.media-item').each(function(e) {
	// 	// dvd title to query OMDB with
	// 	var dvdTitle = $(this).find('.media-item-title').text();
	// 	// make lowecase
	// 	dvdTitle = dvdTitle.toLowerCase();
	// 	// replace and spaces with +
	// 	dvdTitle = dvdTitle.split(' ').join('+');

	// 	console.log(dvdTitle);

	// 	// create a variable for this, so we can use it inside a loop later
	// 	$this = $(this);

	// 	var jqxhr = $.getJSON('http://www.omdbapi.com/?t=' + dvdTitle + '&y=&plot=long&r=json', function(data) {

	// 	}).done(function(data) {
	// 		console.log(data['Plot']);
	// 	});

	// });

	dvdTitleArray = [];
	mediaItem = $('.media-item');
	$('.media-item').each(function() {
		// 	// dvd title to query OMDB with
		var dvdTitle = $(this).find('.media-item-title').text();
		// make lowecase
		dvdTitle = dvdTitle.toLowerCase();
		// replace and spaces with +
		dvdTitle = dvdTitle.split(' ').join('+');
		// console.log(dvdTitle);

		// create a variable for this, so we can use it inside a loop later
		$this = $(this);

		dvdTitleArray.push(dvdTitle);
	});

	// for (var i = 1; i < dvdTitleArray.length; i++) {
	for (var i in dvdTitleArray) {
		descDiv = $('.media-item:nth-child(' + i + ')').find('.media-item-desc');
		// arrayItem = dvdTitleArray[i]; 
		// console.log(arrayItem);

		// dvdAJAX = $.getJSON('http://www.omdbapi.com/?t=' + dvdTitleArray[i] + '&y=&plot=long&r=json', function(data){
		// 	// console.log(descDiv);
		// 	// descDiv.text(data);
			
		// 	// var items = [];
		// 	// $.each( data, function( key, val ) {
		//  //    	items.push( "<p id='" + key + "'>" + val + "</p>" );
  // 	// 		});
		// 	// console.log(items);
		
		// 	// descDiv.text(items[9]);
		// 	return(data.Title);


		// });
		// document.write(dvdAJAX);


		// function getImage(dvdTitleArray) { 
		// $.ajax({ 
		//     type: "GET",
		//     dataType: "json",
		//     url: "http://www.omdbapi.com/?t=" + dvdTitleArray,
		//     success: function(data){
		//         return $.get(data.Plot); 
		//     },
		//     async:false,
		//     error: function() {
		//         return "Image not found.";
		//     }
		// });
		// }

		// getImage(dvdTitleArray[i]);

		// dvdData = JSON.parse(dvdAJAX);

		// dvdAJAX = dvdAJAX[i]['Title'];

		// dvdAJAX = dvdAJAX.responseText.makeArray();

		// console.log(dvdAJAX);
		// descDiv.text(dvdAJAX);

		// $.getJSON('http://www.omdbapi.com/?t=' + dvdTitleArray[i] + '&y=&plot=long&r=json', function(data){
		// currentTitle = dvdTitleArray[2];
		// console.log(i);
		// console.log(currentTitle);
		// });
		// }).done(function(data) {

			// if(('.media-item-desc').text() !== "") {
			// $this.find('.media-item-desc.empty').first().text(data['Plot']).removeClass('empty');
			// console.log(data['Plot']);
			// }
		// });
	}

	// function getPlot(dvdTitle) {
	// 	OMDBTitle = dvdTitle.toLowerCase();
	// 	// replace and spaces with +
	// 	OMDBTitle = OMDBTitle.split(' ').join('+');
	// 	// console.log(dvdTitle);

	// 	$.getJSON('http://www.omdbapi.com/?t=' + OMDBTitle + '&y=&plot=long&r=json', function(data){
	// 		return (data[9]);
	// 	});
	// }

	// var itemPlot = getPlot('The Matrix');

	// console.log(itemPlot);

	// });

	// $.getJSON('http://www.omdbapi.com/?t=' + dvdTitle + '&y=&plot=long&r=json', function(data) {

	// }).done(function(data) {
	// 	console.log(data['Plot']);
	// });

	// console.log(dvdTitleArray);

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



	// if media-item-detail is empty, hide detail button
	// if ($('.media-item-detail-poster').length == 0 || $('.media-item-detail-plot').length == 0) {
		// console.log('details are empty');
	//}

});
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

	for (var i = 0; i < dvdCount; i++) {
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

	$.getJSON('http://www.omdbapi.com/?t=' + dvdTitle + '&y=&plot=long&r=json', function(data) {

	}).done(function(data) {
		console.log(data['Plot']);
	});

	// console.log(dvdTitleArray);

});
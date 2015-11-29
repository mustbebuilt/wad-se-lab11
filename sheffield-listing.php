
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Sheffield Cineworld Listing</title>
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">

<header>
<h1>Sheffield Cineworld</h1>
<nav>
<ul>
<li><a href="index.php">Database List</a></li>
<li><a href="sheffield-listing">What's On</a></li>
</ul>
</nav>
</header>

<div id="filmList">
</div>
   


<footer>
<p>&copy; 2015</p>
</footer>

</div>
<script src="scripts/jquery-1.11.3.min.js"></script>
<script>
// list all cineworld cinemasx
// https://www2.cineworld.co.uk/developer/api/films
// http://www2.cineworld.co.uk/api/quickbook/cinemas?key=@qD9NqMc
// /assets/media/films/6994_still.jpg
 $.ajax({
			url: 'http://www2.cineworld.co.uk/api/quickbook/films',
            type: 'GET',
            data: {key: '<YOURKEY>', full: true, cinema: <CINEMA_NUMBER>},
            dataType: 'jsonp', // Setting this data type will add the callback parameter for you
            success: parseTimes
        });
		
function parseTimes(response, status) {
    var html = '';

    // Check for errors from the server
    if (response.errors) {
        $.each(response.errors, function() {
            html += '<li>' + this + '</li>';
        });
    } else {
        $('span.film.count').text(response.films.length);
        $.each(response.films, function() {
            html += '<div class="imgGrid"><p class="filmName"><a href="showings.php?edi='+this.edi+'">' + this.title + '</a></p>';
			html += '<a href="showings.php?edi='+this.edi+'"><img src="'+this.poster_url+'"></a><p>' + this.classification + '</p></div>';
        });
    }

    // Faster than doing a DOM call to append each node
    $('#filmList').append(html);
}
</script>
</body>
</html>
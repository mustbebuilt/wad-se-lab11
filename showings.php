<?php
$edi =  filter_var($_GET['edi'], FILTER_VALIDATE_INT);
$today = date('Ymd');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0,initial-scale=1">
<title>Sheffield Cineworld Listing</title>
<link href="css/mobileFirst.css" rel="stylesheet" type="text/css">
<link href="css/desktop.css" media="only screen and (min-width:601px)" rel="stylesheet" type="text/css">
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

<section id="filmTimings">
</section>
   



<footer>
<p>&copy; 2016</p>
</footer>

</div>
<script src="scripts/jquery-3.1.1.min.js"></script>
<script>
// list all cineworld cinemas
// https://www2.cineworld.co.uk/developer/api/films
// http://www2.cineworld.co.uk/api/quickbook/cinemas?key=@qD9NqMc
// http://www.cineworld.com/api/quickbook/performances?key=key&cinema=23&film=54321&date=20100801
 $.ajax({
			url: 'http://www.cineworld.co.uk/api/quickbook/performances',
            type: 'GET',
            data: {key: '@qD9NqMc', cinema: 54, film: <?php echo $edi;?>, date:<?php echo $today;?>},
            dataType: 'jsonp', // Setting this data type will add the callback parameter for you
            success: parseFilms
        });
		
function parseFilms(response, status) {
    var html = '';

    // Check for errors from the server
    if (response.errors) {
        $.each(response.errors, function() {
            html += '<p>' + this + '</p>';
        });
    } else {
       if(response.performances.length > 0){
        $.each(response.performances, function() {
            html += '<p>' + this.time + ' (available to book? '
                    + (this.available ? 'yes' : 'no') + ')</p>';
        });
	   }else{
		   html = '<p>No performances listed</p>';
	   }
    }

    // Faster than doing a DOM call to append each node
    $('#filmTimings').append(html);
}
</script>
</body>
</html>
<?php 
ini_set('display_errors', 1);
require_once('../../includes/conn.inc.php'); 
$queryFilms = "SELECT * FROM movies";
$resultFilms = $mysqli->query($queryFilms);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Database Film Listing</title>
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
<header>
<h1>Database Film Listing &raquo;&raquo; the AJAX lab</h1>
<nav>
<ul>
<li><a href="index.php">Database List</a></li>
<li><a href="sheffield-listing">What's On</a></li>
</ul>
</nav>
</header>

<?php
while($rowFilms = $resultFilms->fetch_assoc()){
echo "<div class=\"grid\">";
echo "<div class=\"filmName\">{$rowFilms['filmName']}</div>";
echo "<div class=\"preview\"><a href=\"#\" data-id=\"{$rowFilms['filmID']}\" class=\"getPreview\">Preview</a> | <a href=\"fullDetails.php?filmID={$rowFilms['filmID']}\">Full Details</a></div>";
echo "<div class=\"fullDetails\"></div>";
echo "</div>";
}
?>
<footer>
<p>&copy; 2015</p>
</footer>
</div>
<script src="scripts/jquery-1.11.3.min.js"></script>
<script src="scripts/listing.js"></script>
</body>
</html>
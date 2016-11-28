<?php 
ini_set('display_errors', 1);
require_once('includes/conn.inc.php'); 
$sql = "SELECT * FROM movies";
$stmt = $pdo->query($sql);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0,initial-scale=1">
<title>Database Film Listing</title>
<link href="css/mobileFirst.css" rel="stylesheet" type="text/css">
<link href="css/desktop.css" media="only screen and (min-width:601px)" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
<header>
<h1>Database Film Listing (the AJAX lab)</h1>
<nav>
<ul>
<li><a href="index.php">Database List</a></li>
<li><a href="sheffield-listing.php">What's On</a></li>
</ul>
</nav>
</header>
<main>
<?php
while($row = $stmt->fetchObject()){
	echo "<div class=\"grid\">";
	echo "<div class=\"filmName\">{$row->filmName}</div>";
	echo "<div class=\"preview\"><a href=\"#\" data-id=\"{$row->filmID}\" class=\"getPreview\">Preview</a> | <a href=\"fullDetails.php?filmID={$row->filmID}\">Full Details</a></div>";
	echo "<div class=\"fullDetails\"></div>";
	echo "</div>";
}
?>
</main>
<footer>
<p>&copy; 2016</p>
</footer>
</div>
<script src="scripts/jquery-3.1.1.min.js"></script>
<script src="scripts/listing.js"></script>
</body>
</html>
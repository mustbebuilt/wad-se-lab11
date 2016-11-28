<?php 
//ini_set('display_errors', 1);
require('includes/conn.inc.php'); 
require('includes/functions.inc.php'); 
$sFilmID = safeInt($_GET['filmID']);
$stmt = $pdo->prepare("SELECT * FROM movies WHERE filmID = :filmID");
$stmt->bindParam(':filmID', $sFilmID, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetchObject();
$ratingAr = json_decode($row->userRating, true);
$userRatingAvg = round($ratingAr['Score']/$ratingAr['Reviews'], 2);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0,initial-scale=1">
<title><?php echo $row->filmName; ?></title>
<link href="css/mobileFirst.css" rel="stylesheet" type="text/css">
<link href="css/desktop.css" media="only screen and (min-width:601px)" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">

<header>
<h1>Film Details</h1>
<nav>
<ul>
<li><a href="index.php">Database List</a></li>
<li><a href="sheffield-listing.php">What's On</a></li>
</ul>
</nav>
</header>

<section>
<div>
<?php
	echo "<h2>{$row->filmName}</h2>";
	echo "<p>Average User Rating: <span class=\"currentRating\">{$userRatingAvg}</span></p>";
?>
	
    <form>
    <input type="hidden" name="filmID" value="<?php echo $row->filmID;?>">
    <label>Rate this film</label>
    <p>
  	    <label>0<input type="radio" name="userRating" value="0"></label>
  	    <label>1<input type="radio" name="userRating" value="1"></label>
  	    <label>2<input type="radio" name="userRating" value="2"></label>
  	    <label>3<input type="radio" name="userRating" value="3"></label>
  	    <label>4<input type="radio" name="userRating" value="4"></label>
        <label>5<input type="radio" name="userRating" value="5"></label>
    </p>
    </form>
    
<?php
	echo "<h2>&pound;{$row->filmPrice}</h2>";
	echo "<p>{$row->filmDescription}</p>";

?>
</div>
<div>
<?php
	echo "<img src=\"images/{$row->filmImage}\" alt=\"{$row->filmName}\" class=\"rightImg\">"
?>
</div>

</section>
<section>
<div>
<h3>You might also like:</h3>
<ul class="suggestions">
</ul>
</div>
<div>
<h3>Nearest cinema:</h3>
<div id="myMap">

</div>
</div>
</section>

<footer>
<p>&copy; 2016</p>
</footer>

</div>
<script src="scripts/jquery-3.1.1.min.js"></script>
</body>
</html>
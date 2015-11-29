<?php 
ini_set('display_errors', 1);
require_once('../../includes/conn.inc.php'); 
$stmt = $mysqli->prepare("SELECT filmID, filmName, filmDescription, filmImage, filmPrice, userRating FROM movies WHERE filmID = ?");
$stmt->bind_param('i', $_GET['filmID']);
$stmt->execute(); 
$stmt->bind_result($filmID, $filmName, $filmDescription, $filmImage, $filmPrice, $userRating);
$stmt->fetch();
$stmt->close();
$ratingAr = json_decode($userRating, true);
$userRatingAvg = round($ratingAr['Score']/$ratingAr['Reviews'], 2);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $filmName; ?></title>
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">

<header>
<h1>Film Details</h1>
<nav>
<ul>
<li><a href="index.php">Database List</a></li>
<li><a href="sheffield-listing">What's On</a></li>
</ul>
</nav>
</header>

<section>
<div class="leftBox">
<?php
	echo "<h2>{$filmName}</h2>";
	echo "<p>Average User Rating: <span class=\"currentRating\">{$userRatingAvg}</span></p>";
?>
	
    <form>
    <input type="hidden" name="filmID" value="<?php echo $filmID;?>">
    <label>Rate this film</label>
    <p>
  	    <label>0<input type="radio" name="filmReview" value="0" id="filmReview_0" <?php echo ($filmReview == 0) ? 'checked="checked"' : ''; ?>></label>
  	    <label>1<input type="radio" name="filmReview" value="1" id="filmReview_1" <?php echo ($filmReview == 1) ? 'checked="checked"' : ''; ?>></label>
  	    <label>2<input type="radio" name="filmReview" value="2" id="filmReview_2" <?php echo ($filmReview == 2) ? 'checked="checked"' : ''; ?>></label>
  	    <label>3<input type="radio" name="filmReview" value="3" id="filmReview_3" <?php echo ($filmReview == 3) ? 'checked="checked"' : ''; ?>></label>
  	    <label>4<input type="radio" name="filmReview" value="4" id="filmReview_4" <?php echo ($filmReview == 4) ? 'checked="checked"' : ''; ?>></label>
        <label>5<input type="radio" name="filmReview" value="5" id="filmReview_5" <?php echo ($filmReview == 5) ? 'checked="checked"' : ''; ?>></label>
    </p>
    </form>
    
<?php
	echo "<h2>&pound;{$filmPrice}</h2>";
	echo "<p>{$filmDescription}</p>";

?>
</div>
<div class="rightBox">
<?php
	echo "<img src=\"images/{$filmImage}\" alt=\"{$filmName}\" class=\"rightImg\">"
?>
</div>

</section>
<section>
<div class="leftBox">
<h3>You might also like:</h3>
<ul class="suggestions">
</ul>
</div>
<div class="rightBox">
<h3>Nearest cinema:</h3>
<div id="myMap">

</div>
</div>
</section>

<footer>
<p>&copy; 2015</p>
</footer>

</div>
<script src="scripts/jquery-1.11.3.min.js"></script>

</body>
</html>
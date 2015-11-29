<?php 
header('Content-Type: application/json');
require('../../../includes/conn.inc.php'); 
$filmID =  filter_var($_POST['filmID'], FILTER_VALIDATE_INT);
$filmReview =  filter_var($_POST['filmReview'], FILTER_VALIDATE_INT);
$stmt = $mysqli->prepare("SELECT userRating FROM movies WHERE filmID = ?");
$stmt->bind_param('i', $filmID);
$stmt->execute(); 
$stmt->bind_result($userRating);
$stmt->fetch();
$stmt->close();
//{"Reviews":"0","Score":"0"}
if(is_null($userRating)){
	$newRating = array('Reviews'=>1, 'Score'=>$filmReview);
}else{
	$newRating= json_decode($userRating, true);
	$newRating['Reviews']++;
	$newRating['Score']+=$filmReview;
}

$backToJson = json_encode($newRating);
$stmt = $mysqli->prepare("UPDATE movies SET userRating = ? WHERE filmID = ?");
$stmt->bind_param('si', $backToJson, $filmID);
$stmt->execute(); 
$stmt->close();
// add the echo to return the JSON
?>

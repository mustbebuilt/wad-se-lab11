<?php 
header('Content-Type: application/json');
require('../includes/conn.inc.php');
require('../includes/functions.inc.php');
$sFilmID = safeInt($_POST['filmID']);
$sUserRating = safeInt($_POST['userRating']);
$stmt = $pdo->prepare("SELECT userRating FROM movies WHERE filmID = :filmID");
$stmt->bindParam(':filmID', $sFilmID, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetchObject();
//{"Reviews":"0","Score":"0"}
if(is_null($row->userRating)){
	$newRating = array('Reviews'=>1, 'Score'=>$sUserRating);
}else{
	$newRating= json_decode($row->userRating, true);
	$newRating['Reviews']++;
	$newRating['Score']+=$sUserRating;
}
$backToJson = json_encode($newRating);
$stmt = $pdo->prepare("UPDATE movies SET userRating = :userRating WHERE filmID = :filmID");
$stmt->bindParam(':filmID', $sFilmID, PDO::PARAM_INT);
$stmt->bindParam(':userRating', $backToJson, PDO::PARAM_STR);
$stmt->execute(); 
// add the echo to return the JSON
?>

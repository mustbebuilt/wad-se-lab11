<?php
//ini_set('display_errors', 1);
header('Content-Type: application/json');
require('../includes/conn.inc.php');
require('../includes/functions.inc.php');
$sFilmID = safeInt($_GET['filmID']);
$stmt = $pdo->prepare("SELECT filmDescription, filmPrice FROM movies WHERE filmID = :filmID");
$stmt->bindParam(':filmID', $sFilmID, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetchObject();
// add return array and JSON here 

?>

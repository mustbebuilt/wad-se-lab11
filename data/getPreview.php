<?php
header('Content-Type: application/json');
require('../../../includes/conn.inc.php'); 
$stmt = $mysqli->prepare("SELECT filmDescription, filmPrice FROM movies WHERE filmID = ?");
mysqli_set_charset($mysqli, "utf8");
$stmt->bind_param('i', $_GET['filmID']);
$stmt->execute(); 
$stmt->bind_result($filmDescription, $filmPrice);
$stmt->fetch();
$stmt->close();
// add return array and JSON here 
?>

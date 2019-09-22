<?php 
require_once "lotery.php";

$lotery = new Lotery();
$datetime = $_GET["date"] ?? '';
$datetime .= isset($_GET["time"]) ? " ".$_GET["time"] : "";
$next_lotery = $lotery->calc_next_date($datetime);
echo $next_lotery;
?>
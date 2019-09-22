<?php 
require_once "models/CoreModel.php";

if (empty($_GET["action"])) {
    echo "Wrong url";
    die;
}

$input = $_GET["action"];

require_once $input.".php";


?>
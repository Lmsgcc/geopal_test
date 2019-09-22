<?php 

$server = "localhost";
$username = "root";
$password = "";


$connection = new mysqli($server, $username, $password);

if($connection->connect_error)
{
    die("failed to connect to database");
}

echo "success";
$connection->query("USE test");
$search_parameters = [];

$input = filter_var_array($_GET, [
    "id" => FILTER_SANITIZE_NUMBER_INT,
    "name" => FILTER_SANITIZE_STRING,
    "age" => FILTER_SANITIZE_NUMBER_INT,
    "job_title" => FILTER_SANITIZE_STRING
]);



$query = "SELECT name, age, job_title from exads_test WHERE 1 = 1 ";
foreach($input as $key => $value)
{
    if(!empty($value))
    {
        $query .= " and $key = '$value'";
    }
}


$results = $connection->query($query);
var_dump($results->fetch_array());
$connection->close();
?>
<?php 

// Database configuration

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'blogs';


$conections = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

mysqli_set_charset($conections, "utf8");

if(mysqli_connect_errno() > 0){
    die('Unable to connect to database [' . mysqli_connect_error() . ']');
}

?>
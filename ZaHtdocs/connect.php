<?php
header('Content-Type: text/html; charset=utf-8');

$servername= "localhost";
$username= "root";
$password= "";
$basename= "clanak";

define('UPLPATH','img/');

// Create connection
$dbc= mysqli_connect($servername, $username, $password, $basename) or die('Error connectingto MySQL server.'.mysqli_error());
mysqli_set_charset($dbc, "utf8");
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "doctrack";

$connect = mysqli_connect($servername, $username, $password, $database);

if(!$connect){
	die("Unable to connect to the database");
}
?>
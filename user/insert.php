<?php

$username = "root";
$password = "";

//$database = "doctrack";//$database = "doctrack";
//$host = "172.16.0.147";
$servername = "localhost";

$connection = mysqli_connect('$servername', '$username', '$password');

if(!$connection){
	echo 'Connection error!';
}

if(mysqli_select_db($connection, 'doctrack')){
	echo 'No database selected';
}

$name = $_POST['username'];
$pass = $_POST['password'];

$sql = "INSERT INTO users (username, password) VALUES ('$name', '$pass')";

if(mysqli_query($connection, $sql)){
	echo 'Nothing is inserted.'
}else{
	echo 'Data inserted';
}

header("refresh:2; url=index.php");
?>
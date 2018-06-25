<?php
//$con = mysqli_connect("localhost", "root", "", "doctrack");
//if (mysqli_connect_errno()){
//	echo "Connection Error" . mysqli_connect_error();
//}

$servername = "localhost";
$username = "root";
$password = "";
$database = "doctrack";

$connection = mysqli_connect($servername, $username, $password, $database);

//if($mysqli === false){
	//die("Error: connection not successful." . $connection->error);
//}

//$sql = "INSERT INTO users (password) VALUES (?)";

//if($connection->query($sql) === TRUE){
	//echo "Logged In";
//}else{
	//echo "Error:" . $sql . "<br>" . $connection->error;
//}

//$connection->close();
//header("location: adminlogin.php");
//things here
?>
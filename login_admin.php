<?php
include('db.php');

$_SESSION['loggedIn'] = 'FALSE';

if (isset($_POST['adminpass'])){ 
	$pwd=$_POST['adminpass'];
}

$sql="SELECT * FROM user WHERE userLevel=2;"; //admin

$result = mysqli_query($con, $sql); // admin

$row = mysqli_fetch_assoc($result);
$admnpwd = $row['pwd'];//database, admin

// ADMIN
if(strcmp($admnpwd, $pwd) != 0){
	die("You have entered an invalid password");
}else{
 	session_start();
	$_SESSION['loggedIn'] = 'TRUE';
	header("location: admin-home.php");
}
?>
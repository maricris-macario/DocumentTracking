<?php

include('dbconnect.php');

if(isset($_POST['username'])){
	$username=$_POST['username'];
}

if (isset($_POST['password'])){ 
	
	$pwd=$_POST['password'];
}

$sql="SELECT * FROM user WHERE pwd='".$pwd."' and userLevel='1'"; //admin

$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);
$ur = $row['username'];
$pass = $row['pwd'];//database

if($pwd == $pass){
	session_start();
	$_SESSION['username'] = $ur;
	$_SESSION['pwd'] = $pass;
	header("location: ../admin-home.php");
}else{
 		die("You have entered an invalid username or password");
}
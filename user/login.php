<?php

include('dbconnect.php');

if (isset($_POST['username'])){ 
	
	$username=$_POST['username'];//html
}

if (isset($_POST['password'])){ 
	
	$pwd=$_POST['password'];
}

$sql="SELECT * FROM user WHERE username='".$username."' and pwd='".$pwd."' "; //ADD: and userLevel = '2'

$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);
$ur = $row['username'];
$pass = $row['pwd'];//database

 if(strcmp($username, $ur) != 0){

 	die("You have entered an invalid username or password");
 }else if(strcmp($pwd, $pass) != 0){
 	die("You have entered an invalid username or password");
 }else{
 	if(mysqli_num_rows($result) == 1){
 		session_start();
 		$_SESSION['login_user']=strtoupper($user);
 		header("location:home.php");
 	}else{
 		die("You have entered an invalid username or password");
 	}
 	}




?>
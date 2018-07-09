<?php
include('db.php');

$_SESSION['loggedIn'] = 'FALSE';

if (isset($_POST['username'])){ 
	$username=$_POST['username'];
}

if (isset($_POST['password'])){ 
	$pwd=$_POST['password'];
}

$sql="SELECT * FROM user WHERE username='{$username}' and pwd='{$pwd}' AND userLevel=1;"; //user

$result = mysqli_query($con, $sql); // user

$row = mysqli_fetch_assoc($result);
$ur = $row['username']; // user
$usrpwd = $row['pwd'];//database, user

// USER
if(strcmp($username, $ur) != 0){
	die("You have entered an invalid username");
}else if(strcmp($usrpwd, $pwd) != 0){
	die("You have entered an invalid password");
}else{
	if(mysqli_num_rows($result) == 1){
		session_start();
		$_SESSION['login_user']=$ur;
		$_SESSION['loggedIn'] = 'TRUE';
		header("location: nyr.php");
	}else{
		die("You have entered an invalid username or password");
	}
}
?>
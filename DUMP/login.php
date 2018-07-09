<?php
include('db.php');

if (isset($_POST['username'])){ 
	$username=$_POST['username'];
}
if (isset($_POST['password'])){ 
	$userpass=$_POST['password'];
}
if (isset($_POST['adminpass'])) {
	$adminpass = $_POST['adminpass'];
}

$sql= "SELECT * FROM user;";
$getInfo = mysqli_query($con, $sql);
if (mysqli_num_rows($getInfo) > 0) {
	while ($cred = mysqli_fetch_assoc($getInfo)) {
		// verify USER
		if (isset($_POST['submit_user'])) {
			if (strcmp($username, $cred['username']) === 0 && strcmp($userpass, $cred['pwd']) && $cred['userLevel'] === '2') {
				session_start();
				$_SESSION['login_user']=$ur;
				$_SESSION['loggedIn'] = 'TRUE';
				header("location: nyr.php");
			} else {
				die("You have entered invalid credentials");
			}
		}
		if (isset($_POST['submit_admin'])) {
			if (strcmp($adminpass, $cred['pwd']) && $cred['userLevel'] === '1') {
				session_start();
				$_SESSION['loggedIn'] = 'TRUE';
				header("location: admin-home.php");
			} else {
				die("You have entered an invalid password");
			}
		}
	}
}
?>
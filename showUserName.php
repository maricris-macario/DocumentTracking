<?php
include('db.php');

	$ses = $_SESSION['login_user'];

	$queryUser = "SELECT completeName FROM user WHERE username = '$ses' ";

	$userResult = mysqli_query($queryUser);
	$rowName = mysqli_fetch_array($userResult);
	$userName = $rowName['completeName'];

	echo $userName;
?>
<?php
include('db.php');

	$ses = $_SESSION['login_user'];//mapapalitan pa to

	$queryName = "SELECT userOffice from user where userOffice = '$ses' ";//mapapalitan pa to

	$nameResult = mysqli_query($queryName);
	$rowName = mysqli_fetch_array($nameResult);
	$offName = $rowName['userOffice']; //mapapalitan pa to

	echo $offName;
?>
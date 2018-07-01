<?php
include('db.php');

	$ses = $_SESSION['login_user'];

	$queryName = "SELECT officeName FROM user LEFT JOIN office ON user.officeID = office.officeID WHERE username = '{$ses}';";

	$nameResult = mysqli_query($con, $queryName);
	$rowName = mysqli_fetch_array($nameResult);
	$offName = $rowName['officeName'];

	echo $offName;
?>
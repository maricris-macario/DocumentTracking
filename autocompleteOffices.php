<?php
	include ('db.php');
	session_start();
	if (isset($_POST['search'])) {
		$search = $_POST['search'];
		$queryOffices = "SELECT * FROM office WHERE officeName LIKE %'{$search}'%;";
		$getOffices = mysqli_query($con, $queryOffices);
		while ($o = mysqli_fetch_array($getOffices)) {
			$offices[] = array("value"=>$o['officeID'], "label"=>$o['officeName']);
		}
		echo json_encode($offices);
	}
?>
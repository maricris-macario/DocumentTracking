<?php
include ('db.php');
session_start();
$user = $_SESSION['login_user']; // get username
$queryInfo = "SELECT userID, user.officeID, officeName FROM user LEFT JOIN office ON user.officeID = office.officeID WHERE username='{$user}';";
$getInfo = mysqli_query($con, $queryInfo);
$info = mysqli_fetch_assoc($getInfo);
$officeID = $info['officeID'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// resubmit cancelled slip
	if (isset($_POST['reactivate'])) {
		$resubmit = $_POST['reactivate'];
		$queryReactivate = "UPDATE routing SET status = 'Not Yet Recorded' WHERE slipID = '{$resubmit}';";
		if (mysqli_query($con, $queryReactivate)) {
			header("location: nyr.php");
			exit();
		}else{
			echo mysqli_error($connection);
			exit();
		}
	}
	// mark as 'in'
	if (isset($_POST['markIn'])) {
		$markIn = $_POST['markIn'];
		$queryMarkIn = "UPDATE routing SET status = 'Not Yet Recorded' WHERE slipID = '{$markIn}';";
		if (mysqli_query($con, $queryMarkIn)) {
			header("location: in.php");
			exit();
		}else{
			echo mysqli_error($con);
			exit();
		}
	}

	if (isset($_POST['forwardToOffc'])) {
		if (isset($_POST['fwdSlp_subj'])) {
			$fwdSlp_subj = $_POST['fwdSlp_subj'];
		}
		if (isset($_POST['fwdSlp_docType'])) {
			$fwdSlp_docType = $_POST['fwdSlp_docType'];
		}
		if (isset($_POST['fwdSlp_priLvl'])) {
			$fwdSlp_priLvl = $_POST['fwdSlp_priLvl'];
		}
		if (isset($_POST['fwdSlp_docNum'])) {
			$fwdSlp_docNum = $_POST['fwdSlp_docNum'];
		}
		if (isset($_POST['fwdSlp_det'])) {
			$fwdSlp_det = $_POST['fwdSlp_det'];
		}
		if (isset($_POST['fwdSlp_priNum'])) {
			$fwdSlp_priNum = $_POST['fwdSlp_priNum'];
		}
		$queryInsertSlip = "insert into slip (prioritylvl, documentNum, typeID, subject, details, officeID, date) values ('{$fwdSlp_priLvl}', '{$fwdSlp_docNum}', '{$fwdSlp_docType}', '{$fwdSlp_subj}', '{$fwdSlp_det}', '{$officeID}', '2018-06-29');";
		$execQueryInsrtSlp = mysqli_query($con, $queryInsertSlip);
		$newFwdSlipID = mysqli_insert_id($con);
		if (isset($_POST['sendToOffc'])) {
			$offcs = $_POST['sendToOffc'];
			foreach ($offcs as $o) {
				$queryInsertRouting = "insert into routing (slipID, officeID, dateOut, status, priorityNum) values ('{$newFwdSlipID}', '{$o}', '2018-06-29', 'Out', '{$fwdSlp_priNum}');";
				mysqli_query($con, $queryInsertRouting);
			}
			header('location: out.php');
			exit();
			/*if (mysqli_query($con, $queryInsertRouting)) {
				header('location: out.php');
				exit();
			}else{
				echo mysqli_error($con);
				exit();
			}*/
		}
	}
}
?>
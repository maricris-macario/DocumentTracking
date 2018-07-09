<?php
include ('db.php');
session_start();
$user = $_SESSION['login_user']; // get username
$queryInfo = "SELECT userID, user.officeID, officeName FROM user LEFT JOIN office ON user.officeID = office.officeID WHERE username='{$user}';";
$getInfo = mysqli_query($con, $queryInfo);
$info = mysqli_fetch_assoc($getInfo);
$officeID = $info['officeID']; // office of the logged in user
$currentDate = date('Y-m-d');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// resubmit cancelled slip
	if (isset($_POST['reactivate'])) {
		$resubmit = $_POST['reactivate'];
		if (isset($_POST['resub_canSlip'])) {
			$resub_canSlip = $_POST['resub_canSlip'];
		}
		if (isset($_POST['resub_canPriNum'])) {
			$resub_canPriNum = $_POST['resub_canPriNum'];
		}
		if (isset($_POST['resub_recvOffc'])) {
			$resub_recvOffc = $_POST['resub_recvOffc'];
		}
		//$queryReactivate = "UPDATE routing SET status = 'Not Yet Recorded' WHERE slipID = '{$resubmit}';";
		// query - resubmit slip, doc gets out, record as resubmitted
		$queryReactivate = "INSERT routing (slipID, officeID, resubmitDate, status, priorityNum) VALUES ('{$resub_canSlip}', '{$officeID}', '{$currentDate}', 'Resubmitted', '{$resub_canPriNum}');";
		// query - not yet received in the recipient office
		$queryNYR = "INSERT routing (slipID, officeID, dateIn, status, priorityNum) VALUES ('{$resub_canSlip}', '{$resub_recvOffc}', '{$currentDate}', 'Not Yet Recorded', '{$resub_canPriNum}');";
		if (mysqli_query($con, $queryReactivate) && mysqli_query($con, $queryNYR)) {
			header("location: resubmitted.php");
			exit();
		}else{
			echo mysqli_error($con);
			exit();
		}
	}
	// mark a document as IN when received from Not Yet Received page..
	if (isset($_POST['markIn'])) {
		$markIn = $_POST['markIn'];
		if (isset($_POST['mIn_slipID'])) {
			$mIn_slipID = $_POST['mIn_slipID'];
		}
		if (isset($_POST['mIn_recvOffc'])) {
			$mIn_recvOffc = $_POST['mIn_recvOffc'];
		}
		if (isset($_POST['mIn_priNum'])) {
			$mIn_priNum = $_POST['mIn_priNum'];
		}
		//$queryMarkIn = "UPDATE routing SET status = 'In' WHERE routingID = '{$markIn}';";
		$queryMarkIn = "INSERT routing (slipID, officeID, resubmitDate, status, priorityNum) VALUES ('{$mIn_slipID}', '{$mIn_recvOffc}', '{$currentDate}', 'In', '{$mIn_priNum}');";
		if (mysqli_query($con, $queryMarkIn)) {
			header("location: in.php");
			exit();
		}else{
			echo mysqli_error($con);
			exit();
		}
	}
	// send to other office
	if (isset($_POST['forwardToOffc'])) {
		/*if (isset($_POST['fwdSlp_slipID'])) {
			$fwdSlp_slipID = $_POST['fwdSlp_slipID'];
		}*/
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
		$queryInsertSlip = "INSERT INTO slip (prioritylvl, documentNum, typeID, subject, details, officeID, date) VALUES ('{$fwdSlp_priLvl}', '{$fwdSlp_docNum}', '{$fwdSlp_docType}', '{$fwdSlp_subj}', '{$fwdSlp_det}', '{$officeID}', '{$currentDate}');";
		//$execQueryInsrtSlp = mysqli_query($con, $queryInsertSlip);
		if (mysqli_query($con, $queryInsertSlip)) {
			$newFwdSlipID = mysqli_insert_id($con);
		} else {
			echo mysqli_error($con);
		}
		if (isset($_POST['sendToOffc'])) {
			$offcs = $_POST['sendToOffc'];
			foreach ($offcs as $o) {
				// insert query for routing OUT for the sender of the slip..
				$queryInsertRoutingIn = "INSERT INTO routing (slipID, officeID, dateOut, status, priorityNum) VALUES ('{$newFwdSlipID}', '{$o}', '{$currentDate}', 'Out', '{$fwdSlp_priNum}');";
				$execInsertRoutingIn = mysqli_query($con, $queryInsertRoutingIn);
				// insert query for routing NOT YET RECEIVED by the recipient office/s..
				$queryInsertRoutingNYR = "INSERT INTO routing (slipID, officeID, dateIn, status, priorityNum) VALUES ('{$newFwdSlipID}', '{$o}', '{$currentDate}', 'Not Yet Recorded', '{$fwdSlp_priNum}');";
				//$execInsertRoutingNYR = mysqli_query($con, $queryInsertRoutingNYR);
				if (mysqli_query($con, $queryInsertRoutingNYR)) {
					continue;
				} else {
					echo mysqli_error($con);
				}
			}
			header('location: out.php');
			exit();
		}
	}
	// return to sender
	if (isset($_POST['returnSendr'])) {
		$routingID = $_POST['returnSendr'];
		if (isset($_POST['ret_slipID'])) {
			$ret_slipID = $_POST['ret_slipID'];
		}
		if (isset($_POST['ret_sender'])) {
			$ret_sender = $_POST['ret_sender']; // officeID of the sender
		}
		// search for originating office user....
		// need routingID, slipID, officeID....
		$srchOrigOffcUsr = "SELECT routing.slipID, routingID, slip.officeID AS originatingOffice, userID FROM routing LEFT JOIN slip ON routing.slipID = slip.slipID JOIN office ON office.officeID = slip.officeID JOIN type ON slip.typeID = type.typeID LEFT JOIN user ON slip.officeID = user.officeID WHERE slip.officeID = '{$ret_sender}' AND routing.slipID = '{$ret_slipID}' AND routingID = '{$routingID}';";
		$getOrigOffcUsr = mysqli_query($con, $srchOrigOffcUsr);
		$fetchOrigOffcUsr = mysqli_fetch_assoc($getOrigOffcUsr);
		$ret_sender_usr = $fetchOrigOffcUsr['userID']; // originator (USER)
		// office recorded doc as RETURNED
		$queryRet = "INSERT routing (slipID, officeID, dateOut, status) VALUES ('{$ret_slipID}', '{$officeID}', '{$currentDate}', 'Returned');";
		// originator recorded as RETURNED, doc returned to them for revisions, etc....
		$queryInRet = "INSERT routing (slipID, officeID, dateIn, status) VALUES ('{$ret_slipID}', '{$ret_sender}', '{$currentDate}', 'Returned');";
		if (mysqli_query($con, $queryRet) && mysqli_query($con, $queryInRet)) {
			header('location: returned.php');
			exit();
		}
	}
	// cancel slip from OUT
	if (isset($_POST['out_cancelSlp'])) {
		if (isset($_POST['can_slipID'])) {
			$can_slipID = $_POST['can_slipID'];
		}
		if (isset($_POST['can_recvOffc'])) {
			$can_recvOffc = $_POST['can_recvOffc'];
		}
		// record as CANCELLED by the sender
		$queryCancel = "INSERT routing (slipID, officeID, status, priorityNum, cancelDate) VALUES ('{$can_slipID}', '{$officeID}', 'Cancelled', '0', '{$currentDate}');";
		// ... as well as record CANCELLED in the recipient office
		$queryRecvrCancel = "INSERT routing (slipID, officeID, status, priorityNum) VALUES ('{$can_slipID}', '{$can_recvOffc}', 'Cancelled', '0');";
		if (mysqli_query($con, $queryCancel) && mysqli_query($con, $queryRecvrCancel)) {
			header("location: cancelled.php");
			exit();
		}
	}
	// cancel slip from SLIP - delete
	if (isset($_POST['slip_cancelSlp'])) {
		$slip_cancelSlp = $_POST['slip_cancelSlp'];
		$queryCancel = "DELETE FROM slip WHERE slipID='{$slip_cancelSlp}';";
		if (mysqli_query($con, $queryCancel)) {
		 	header("location: user.php");
		 	exit(); // ma edit pa
		} else {
			echo mysqli_error($con);
			exit();
		}
	}
	// edit slip
	if (isset($_POST['editSlp'])) {
		$editSlp_slipID = $_POST['editSlp'];
		if (isset($_POST['editSlp_date'])) {
			$editSlp_date = $_POST['editSlp_date'];
		}
		if (isset($_POST['editSlp_offcname'])) {
			$editSlp_offcname = $_POST['editSlp_offcname'];
		}
		if (isset($_POST['editSlp_docNum'])) {
			$editSlp_docNum = $_POST['editSlp_docNum'];
		}
		if (isset($_POST['editSlp_subj'])) {
			$editSlp_subj = $_POST['editSlp_subj'];
		}
		if (isset($_POST['editSlp_docType'])) {
			$editSlp_docType = $_POST['editSlp_docType'];
		}
		if (isset($_POST['editSlp_priLvl'])) {
			$editSlp_priLvl = $_POST['editSlp_priLvl'];
		}
		if (isset($_POST['editSlp_details'])) {
			$editSlp_details = $_POST['editSlp_details'];
		}
		$queryEditSlip = "UPDATE slip SET prioritylvl='{$editSlp_priLvl}', documentNum='{$editSlp_docNum}', typeID='{$editSlp_docType}', subject='{$editSlp_subj}', details='{$editSlp_details}', officeID='{editSlp_offcname}', dateCreated='{$editSlp_date}' WHERE slipID='{$editSlp_slipID}';"; // ma edit pa
		if (mysqli_query($con, $queryEditSlip)) {
			header("location: user.php");
			exit();
		} else {
			echo mysqli_error($con);
			exit();
		}
	}
	// mark status 'Revision' for revision
	if (isset($_POST['revise'])) {
		$rev_routingID = $_POST['revise'];
		$queryRevise = "UPDATE routing SET status='Revision' WHERE routingID='{$rev_routingID}' AND remarks IS NOT NULL;";
		if (mysqli_query($con, $queryRevise)) {
			header("location: revision.php");
			exit();
		} else {
			echo mysqli_error();
			exit();
		}
	}
}
?>
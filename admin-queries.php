<?php
//include($_SERVER['DOCUMENT_ROOT'] . '/pma_all/admindbconnect.php');
include ('admindbconnect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// add new user
	if (isset($_POST['user_cname'])) {
		$cname = $_POST['user_cname'];
		echo $cname . '<br>';
	}
	if (isset($_POST['user_uname'])) {
		$username = $_POST['user_uname'];
		echo $username . '<br>';
	}
	if (isset($_POST['user_pwd'])) {
		$password = $_POST['user_pwd'];
		echo $password .'<br>';
	}
	/*if (isset($_POST['user_office'])) {
		$office = $_POST['user_office'];
	}*/
	if (isset($_POST['newUsr_officeID'])) {
		$user_officeID = $_POST['newUsr_officeID'];
	}
	if (isset($_POST['user_lvl'])) {
		$usrLvl = $_POST['user_lvl'];
		echo $usrLvl . '<br>';
	}
	
	if (isset($_POST['submitNewUser'])) {
		$insertUser = "insert into user (completeName, username, pwd, userLevel, status, officeID) values ('{$cname}', '{$username}', '{$password}', '{$usrLvl}', 'Active', '{$user_officeID}');";
		//mysqli_query($connection, $insertUser);
		//$new_usr_id = mysqli_insert_id($connection);
		//$insertUserOffice = "insert into office_user (userID, officeID) values ('{$new_usr_id}', '{$user_officeID}');";
		if (mysqli_query($connection, $insertUser)) {
			header("location: admin-home.php#users");
			exit();
		} else {
			echo mysqli_error($connection);
			exit();
		}
	}

		// add new office
	if (isset($_POST['office_name'])) {
		$oname = $_POST['office_name'];
	}
	if (isset($_POST['office_desc'])) {
		$office_desc = $_POST['office_desc'];
	}
	if (isset($_POST['office_loc'])) {
		$office_location = $_POST['office_loc'];
	}
	if (isset($_POST['submitNewOffice'])) {
		$insertOffice = "insert into office (officeName, description, location) values ('{$oname}', '{$office_desc}', '{$office_location}');";
		if (mysqli_query($connection, $insertOffice)) {
			header("location: admin-home.php#office");
			exit();
		} else {
			echo mysqli_error($connection);
			exit();
		}
	}
	
		// add new doc type
	if (isset($_POST['doc_type'])) {
		$docType = $_POST['doc_type'];
	}
	if (isset($_POST['submitNewDocType'])) {
		$insertDocType = "insert into type (docType) values ('{$docType}');";
		if (mysqli_query($connection, $insertDocType)) {
			header("location: admin-home.php#doctype");
			exit();
		} else {
			echo mysqli_error($connection);
			exit();
		}
	}

		// update user info
	if (isset($_POST['update_user'])) {
		$userid = $_POST['update_user'];
		if (isset($_POST['cname'])) {
			$tbl_cname = $_POST['cname'];
		}
		if (isset($_POST['uname'])) {
			$tbl_uname = $_POST['uname'];
		}
		if (isset($_POST['user_office'])) {
			$tbl_offcname = $_POST['user_office'];
		}
		if (isset($_POST['u_status'])) {
			$tbl_status = $_POST['u_status'];
		}
		if (isset($_POST['u_lvl'])) {
			$tbl_usrlvl = $_POST['u_lvl'];
		}
		$updateUser = "UPDATE user SET completeName = '{$tbl_cname}', username = '{$tbl_uname}', status = '{$tbl_status}', userLevel = '{$tbl_usrlvl}', officeID = '{$tbl_offcname}' WHERE userID = '{$userid}';";
		if (mysqli_query($connection, $updateUser)) {
			header("location: admin-home.php#users");
			die();
		} else {
			echo mysqli_error($connection);
			die();
		}
	}

	// update office info
	if (isset($_POST['update_office'])) {
		$officeid = $_POST['update_office'];
		if (isset($_POST['office_name'])) {
			$office_name = $_POST['office_name'];
		}
		if (isset($_POST['officeDesc'])) {
			$officeDesc = $_POST['officeDesc'];
		}
		if (isset($_POST['officeLoc'])) {
			$officeLoc = $_POST['officeLoc'];
		}
		$updateOffice = "UPDATE office SET officeName = '{$office_name}', description = '{$officeDesc}', location = '{$officeLoc}' WHERE officeID = {$officeid};";
		if (mysqli_query($connection, $updateOffice)) {
			header("location: admin-home.php#office");
			die();
		} else {
			echo mysqli_error($connection);
			die();
		}
	}
}
?>
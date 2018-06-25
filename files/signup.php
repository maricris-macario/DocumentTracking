<?php
if(isset($_POST['submit'])){
	include_once 'dbconnect.php';
	$username = mysqli_real_escape_string($connect, $_POST['username']);
	$pwd = mysqli_real_escape_string($connect, $_POST['pwd']);


	if(empty($pwd)){
		header("Location: signup.php?signup=empty");
		exit();
	}else{
		if(!preg_match("/^[a-zA-Z]*$/", $username) || !preg_match("/^[a-zA-Z]*$/", $pwd){
			header("Location: signup.php?signup=invalid");
			exit();
		}else{
			$sql = "SELECT * FROM user WHERE userID ='$userID'";
			$result = mysqli_query($connect, $sql);
			$resultCheck = mysqli_num_rows($result);

			if($resultCheck > 0){
				header("Location: signup.php?signup=usertaken");
				exit();
			}else{
				$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
				$sql = "INSERT INTO user (user_username, user_pwd) VALUES ('$username', '$pwd');";
				$result = mysql_query($connect, $sql);
				header("Location: signup.php?signup=success");
				exit();
			}
		}
		}
	}

}else{
	header("Location: signup.php");
	exit();
}



?>
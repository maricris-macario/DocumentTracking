<?php
session_start();

if(isset($_POST['submit'])){
	include 'dbconnect.php';
	//$username = mysqli_real_escape_string($connect, $_POST['username']);
	$pwd = mysqli_real_escape_string($connect, $_POST['pwd']);

	if(empty($pwd)){

	}else{
		$sql = "SELECT pwd FROM user WHERE pwd='$pwd'";
		$result = mysqli_query($connect, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck < 1){
			header("Location: index.php?login=empty");
			exit();
		}else{
			if($row = mysqli_fetch_assoc($result)){
				//echo $row['username'];
				$hashedPwdCheck = password_verify($pwd, $row['pwd']);
				if($hashedPwdCheck == false){
					header("Location: index.php?login=error");
					exit();
				}elseif ($hashedPwdCheck == true) {
					$_SESSION['pwd'] = $row['pwd'];
					header("Location: samplelandingpage.php?login=success");
					exit();
				}
			}
		}
	}
}else{
	header("Location: samplelandingpage.php?login=error");
	exit();
}



?>

<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
	<h6>Welcome</h6>
</body>
</html>
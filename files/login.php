<?php

include('dbconnect.php');

$username = $_POST['username'];
$password = $_POST['password'];

$username = stripslashes($username);
$password = stripcslashes($password);

$sql = "SELECT * FROM user where username='".$username."' and pwd='".$password."';";
$result = mssql_query($sql);

$row = mssql_fetch_assoc($result);
$uname = $row['username'];
$pass = $row['password'];

if(strcmp($username, $uname) != 0){
	die("<script type="text/javascript">alert('invalid username'); history.go(-1); </script>");
}else if (strcmp($password, $pass) != 0) {
	die("<script type="text/javascript">alert('invalid password'); history.go(-1); </script>")
}else{
	if(mssql_num_rows($result)==1){
		session_start();
		$_SESSION['login_user']=strtoupper($username);
		header("location:")
	}
}
//session_start();
//$errormes = '';
//if(isset($_POST['submit'])){
//	if(empty($_POST['username']) || ($_POST['password'])){
//		$errormes = "Username or password do ot match/invalid";
//	}else{
//		$username = $_POST['username'];
//		$password = $_POST['password'];
//		$connection = mysql_connect("localhost", "root", "");
//		$database = mysql_select_db("doctrack", $connection);
//		$query = mysql_query("select * from user where password = '$password' AND username = '$username'", $connection);
//		$rows = mysql_num_rows($query);
//		if($rows == 1){
//			$_SESSION['login_user'] = $username;
//			header("location: index.php");
//		}else{
//			$errormes = "Invalid username or password";
//		}
//			mysql_close($connection);
//	}
//}


//include('dbconnect.php');

//$user = $_POST['username'];
//$password = $_POST['password'];

//$query = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
?>
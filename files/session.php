<?php
	$connection = mysql_connect("localhost", "root", "");
	$db = mysqql_select_db("doctrack", $connection);
	session_start();
	$user_check = $_SESSION['login_user'];
	$ses_sql = mysql_query("select username, password from user where username = '$user_check'", $connection);
	$row = mysql_fetch_assoc($ses_sql);
	$login_session = $row['username', 'password'];
	if(!isset($login_session)){
		mysql_close($connection);
		header('Location: index.php')
	}
?>
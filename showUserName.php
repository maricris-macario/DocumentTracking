<?php
include('db.php');
//require_once('login.php');
$ses = $_SESSION['login_user'];

$queryUser = "SELECT completeName FROM user WHERE username = '{$ses}' ";

$userResult = mysqli_query($con, $queryUser);
$rowName = mysqli_fetch_array($userResult);
$userName = $rowName['completeName'];

echo $userName;
?>
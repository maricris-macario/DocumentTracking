<?php

//include('dbconnect.php');

session_start();

if(session_destroy()){
	header("location:userlogin.php");
}
?>
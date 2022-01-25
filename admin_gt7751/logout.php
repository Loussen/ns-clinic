<?php
ob_start(); session_start();
$_SESSION["user_programs"]=0;
foreach($_SESSION as $key=>$val){
	if(substr($key,0,5)=='login') unset($_SESSION[$key]);
	if(substr($key,0,5)=='pass') unset($_SESSION[$key]);
}

header("Location: login.php");
?>
<?php
if(!defined('db_name')) { header("Location: ../../../"); exit(); die(); }
// Data of user
if(isset($_SESSION["user_id"])) $user_id=safe($_SESSION["user_id"]); else $user_id='';
if(isset($_SESSION["user_pass"])) $user_pass=safe($_SESSION["user_pass"]); else $user_pass='';

$user_logged=false;
$user=mysqli_fetch_assoc(mysqli_query($db,"select * from users where id='$user_id' "));
if(md5($user["pass"])==$user_pass ) $user_logged=true;
if(!$user_logged) unset($user);

if($user_logged && $user["favorites"]!='') $favorites=explode(",",$user["favorites"]);
else $favorites=array();
?>
<?php
ob_start();

//if(!isset($_SESSION))
//{
    session_start();
//}
//ini_set('display_errors', 'On');
//error_reporting(E_ALL);
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(0);
$timezone = "Asia/Baku";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);

// You can change them...
if(!defined('host')) define('host','localhost');
if(!defined('username')) define('username','root');
if(!defined('password')) define('password','');
if(!defined('db_name')) define('db_name','nsclinic');
$admin_folder='admin_gt7751';
$site="http://localhost/nsclinic";	// sonda / iwaresi qoyulmasin ve admin_folder burada qeyd edilmesin. ondan 1 vahid onceki foldere qeder qeyd edilsin.

$time=time();	//$time+=3600;	// eger saat 1 saat + ve ya - olarsa tenzimle.
$cookieExpire=21600;

if(!isset($_SESSION["menu_minimize"])) $_SESSION["menu_minimize"]=false;

require_once 'connect_db.php';
?>

<?php
function connect(){
    global $db;
    $db=mysqli_connect(host,username,password,db_name) or die(mysqli_error() );
    return $db;
}
connect();
//mysqli_query($db, "SET time_zone = '+4:00'");
mysqli_query($db,"set names utf8");
ini_set('max_execution_time', 300);
ini_set('memory_limit', '-1');
define('SITE_PATH',$site);		// URL of site


if(!isset($only_connect_db)){
	function safe($value,$strip=false,$youtube_allowFullScreen=true){
		if(!is_array($value))
		{
			$value=trim($value);
			if($strip) $value=strip_tags($value);
			$from=array("'","\\"); $to=array('&single_quot;',"\\\\");
			$value=str_replace($from, $to, $value);
			if($youtube_allowFullScreen) $value=str_replace('<iframe src="http', '<iframe allowFullScreen="allowFullScreen" src="http', $value);
			
			$from=array('&uuml;','&ouml;','&ccedil;','&Uuml;','&Ouml;','&Ccedil;');
			$to=array('ü','ö','ç','Ü','Ö','Ç');
			$value=str_replace($from, $to, $value);
		}
		return $value;
	}
	
	$js=''; $css=''; $jQuery=''; $active=1; $cookieExpire=21600;
	$time=time();	//$time+=3600;	// eger saat 1 saat + ve ya - olarsa tenzimle.
	
	if(!isset($_SESSION["menu_minimize"])) $_SESSION["menu_minimize"]=false;
	
	$doCache=false;
	if($doCache){
		if(!is_dir( __DIR__ .'/../../../cache')) mkdir(__DIR__ .'/../../../cache', 0755);
		require_once 'cache.class.php';
		$cache = new Cache();
		$cache->eraseExpired();
		if(isset($_GET["eraseAll"])) $cache->deleteAllCacheFiles();
		if(isset($_GET["eraseFile"])){ $cacheFileName=addslashes($_GET["eraseFile"]);	$cache->setCache($cacheFileName);		$cache->eraseAll(); }
	}

	if($doCache){
		$cacheFileName='connect_db';
		$cache->setCache($cacheFileName);
	}
	
	if($doCache){
		$cacheName="get_settings";
		$get_settings=$cache->get($cacheName);
		if($get_settings===false){
			$get_settings=mysqli_fetch_assoc(mysqli_query($db,"select * from settings"));
			$cache->store($cacheName,$get_settings);
		}
	}
	else $get_settings=mysqli_fetch_assoc(mysqli_query($db,"select * from settings"));
	
	// get default page
	$default_page=$get_settings["default_page"];
	
	if(isset($_GET["do"])) $do=safe($_GET["do"]); else $do=$default_page;
	if(is_array($do)) $do='';
	$do=basename($do);
	
	require_once "check.php";
	
	// Static update
	if($get_settings["currency"]>0 || $get_settings["namaz"]>0 || $get_settings["wheather"]>0) require_once 'static_update.php';

	require_once 'functions.php';
	require_once "simple_html_dom.php";
	$current_link = 'index.php?'.parse_url($_SERVER['QUERY_STRING'], PHP_URL_PATH);
	
	// Do backup if need
	$folder='backup_sqls';
	if($time-$get_settings["last_backup"]>43200){
		$name = 'backup-' . date("d-m-Y-H.i") . '-' . time();
		backup_database($folder, $name, host, username, password, db_name, '*');
		mysqli_query($db,"update settings set last_backup='$time' ");
		$open = opendir($folder);
		$time = time();
		while ($read = readdir($open)){
			if ($read != '.' && $read != '..'){
				$filemtime = filemtime($folder . '/' . $read);
				$diff	  = $time - $filemtime;
				if ($diff > 864000)
					unlink($folder . '/' . $read);
			}
		}
	}

	// Lang file include
	require_once __DIR__ .'/../../langs/index.php';

	// Current Lang
	if($doCache){
		$cacheName="lang_info";
		$lang_info=$cache->get($cacheName);
		if($lang_info===false){
			$lang_info=mysqli_fetch_assoc(mysqli_query($db,"select full_name from langs where name='$lang_name' "));
			$cache->store($cacheName,$get_settings);
		}
	}
	else $lang_info=mysqli_fetch_assoc(mysqli_query($db,"select full_name from langs where name='$lang_name' "));
	
	// get Langs array
	if($doCache){
		$cacheName="all_langs";
		$all_langs=$cache->get($cacheName);
		if($all_langs===false){
			$all_langs=array();
			$sql=mysqli_query($db,"select name from langs order by position");
			while($row=mysqli_fetch_assoc($sql)){
				$all_langs[]=$row["name"];
			}
			$cache->store($cacheName,$all_langs);
		}
	}
	else{
		$all_langs=array();
		$sql=mysqli_query($db,"select name from langs order by position");
		while($row=mysqli_fetch_assoc($sql)){
			$all_langs[]=$row["name"];
		}
	}
	$lang_count=count($all_langs);
	
	
	if($doCache){
		$cacheName="all_tables";
		$all_tables=$cache->get($cacheName);
		if($all_tables===false){
			$all_tables=array();
			$sql=mysqli_query($db,"SHOW TABLES FROM ".db_name);
			while($row=mysqli_fetch_assoc($sql)){
				$all_tables[]=$row["Tables_in_".db_name];
			}
		}
	}
	else{
		$all_tables=array();
		$sql=mysqli_query($db,"SHOW TABLES FROM ".db_name);
		while($row=mysqli_fetch_assoc($sql)){
			$all_tables[]=$row["Tables_in_".db_name];
		}
	}
	
	$info_home_page=mysqli_fetch_assoc(mysqli_query($db,"select * from home_page "));
	
	$paramsOther=array('delete_file'=>0,'lang_edit'=>0,'delete_file_column'=>0);
	$setParamsZero_all=array('add'=>0,'edit'=>0,'delete'=>0,'up'=>0,'down'=>0,'view'=>0) + $paramsOther;
	$setParamsZero_add=array('edit'=>0,'delete'=>0,'up'=>0,'down'=>0,'view'=>0) + $paramsOther;
	$setParamsZero_edit=array('add'=>0,'delete'=>0,'up'=>0,'down'=>0,'view'=>0) + $paramsOther;
	$setParamsZero_delete=array('add'=>0,'edit'=>0,'up'=>0,'down'=>0,'view'=>0) + $paramsOther;
	$setParamsZero_up=array('add'=>0,'edit'=>0,'delete'=>0,'down'=>0,'view'=>0) + $paramsOther;
	$setParamsZero_down=array('add'=>0,'edit'=>0,'delete'=>0,'up'=>0,'view'=>0) + $paramsOther;
	$setParamsZero_view=array('add'=>0,'edit'=>0,'delete'=>0,'up'=>0,'down'=>0) + $paramsOther;
}
?>
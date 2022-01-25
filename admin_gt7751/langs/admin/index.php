<?php

// URL with lang
if(isset($_GET["get_lang_name"])){
	$get_lang_name=safe($_GET["get_lang_name"]);
	if(mysqli_num_rows(mysqli_query($db,"select id from langs where name='$get_lang_name' "))>0){
		$_SESSION["admin_lang"]=$get_lang_name;
		$site.='/'.$get_lang_name;
	}
}
elseif(isset($_GET["lang"])){
	$change_lang=safe($_GET["lang"]);
	if(mysqli_num_rows(mysqli_query($db,"select id from langs where name='$change_lang' "))>0) $_SESSION["admin_lang"]=$change_lang;
}
else{
	if(isset($_SESSION["admin_lang"])){
		$lang_name=safe($_SESSION["admin_lang"]);
		if(mysqli_num_rows(mysqli_query($db,"select id from langs where name='$lang_name' "))==0){
			$lang_name_info=mysqli_fetch_assoc(mysqli_query($db,"select name from langs where status='1' "));
			$lang_name=strtolower($lang_name_info["name"]);
			$_SESSION["admin_lang"]=$lang_name;
		}
	}
	else{
		$lang_name_info=mysqli_fetch_assoc(mysqli_query($db,"select name from langs where status='1' "));
		$lang_name=strtolower($lang_name_info["name"]);
		$_SESSION["admin_lang"]=$lang_name;
	}
}

$lang_name=safe($_SESSION["admin_lang"]);
if(is_file( __DIR__ .'/'.$lang_name.'/lang.txt')) $included_lang= __DIR__ .'/'.$lang_name.'/lang.txt';
else{
	$open=fopen(__DIR__ .'/'.$lang_name.'/lang.txt','w+');
	fwrite($open,$words);
	fclose($open);
	
	unset($_SESSION["lang_name"]);
	header("Location: $site");
	exit();
}

$lang_data=file_get_contents($included_lang);
if($lang_data!='') $explode_edit_file=json_decode($lang_data,true);
else $explode_edit_file=[];

foreach($explode_edit_file as $key=>$val){
	$var='lang'.($key+1);
	$$var=$val;
}

if(isset($_SERVER['HTTP_REFERER'])) $referer=safe($_SERVER['HTTP_REFERER']); else $referer='';
if($referer=="") $referer="index.php";
if(intval(strpos($referer,"lang="))>0) $referer=substr($referer,0,strlen($referer)-7);
if(isset($_GET["lang"]) && $do!="diller") header("Location: $referer");
?>
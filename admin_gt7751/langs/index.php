<?php
// URL with lang
if(isset($_GET["change_lang_name"])){
	$change_lang_name=safe($_GET["change_lang_name"]);
	if(mysqli_num_rows(mysqli_query($db,"select id from langs where name='$change_lang_name' "))>0){
		if(isset($_SERVER['HTTP_REFERER'])) $referer=safe($_SERVER['HTTP_REFERER']); else $referer='';
        $referer=str_replace(array('/az/','/ru/','/en/','/ch/','/tr/'),'/'.$change_lang_name.'/',$referer);

        if(strpos($referer,"nsagrimerkezi") === false)
        {
            header("Location: ".SITE_PATH);
        }
        else
        {
            header("Location: ".$referer);
        }

        exit;
	}
}

if(isset($_GET["get_lang_name"])){
	$get_lang_name=safe($_GET["get_lang_name"]);
	if(mysqli_num_rows(mysqli_query($db,"select id from langs where name='$get_lang_name' "))>0){
		$_SESSION["lang_name"]=$get_lang_name;
		$site.='/'.$get_lang_name;
	}
	else{
		header("Location: $site/az");
	}
}
elseif(isset($_GET["lang"])){
	$change_lang=safe($_GET["lang"]);
	if(mysqli_num_rows(mysqli_query($db,"select id from langs where name='$change_lang' "))>0) $_SESSION["lang_name"]=$change_lang;
}
else{
	if(isset($_SESSION["lang_name"])){
		$lang_name=safe($_SESSION["lang_name"]);
		if(mysqli_num_rows(mysqli_query($db,"select id from langs where name='$lang_name' "))==0){
			$lang_name_info=mysqli_fetch_assoc(mysqli_query($db,"select name from langs where status='1' "));
			$lang_name=strtolower($lang_name_info["name"]);
			$_SESSION["lang_name"]=$lang_name;
		}
	}
	else{
		$lang_name_info=mysqli_fetch_assoc(mysqli_query($db,"select name from langs where status='1' "));
		$lang_name=strtolower($lang_name_info["name"]);
		$_SESSION["lang_name"]=$lang_name;
	}
}

$lang_name=safe($_SESSION["lang_name"]);
if(is_file( __DIR__ .'/'.$lang_name.'/lang.txt')) $included_lang=__DIR__ .'/'.$lang_name.'/lang.txt';
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
	$$var=decode_text($val);
}

if(isset($_SERVER['HTTP_REFERER'])) $referer=safe($_SERVER['HTTP_REFERER']); else $referer='';
if($referer=="") $referer="index.php";
if(intval(strpos($referer,"lang="))>0) $referer=substr($referer,0,strlen($referer)-7);
if(isset($_GET["lang"]) && $do!="langs") header("Location: $referer");
?>
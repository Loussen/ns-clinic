<?php
require_once "admin_gt7751/pages/__includes/config.php";
//require_once "admin_gt7751/pages/__includes/check_site.php";
if(isset($_POST["process_name"])) $process_name=safe($_POST["process_name"]); else $process_name='';

if($process_name=='add_favorites'){
	//if(!$user_logged) { echo "not_logged"; exit(); }
	
	$liked=intval($_POST["liked"]);
	if(mysqli_num_rows(mysqli_query($db,"select id from users where id='$liked' and active=1 "))>0){
		if(!in_array($liked,$favorites)){
			$favorites[]=$liked;
			echo 'added***'.$lang59.'***'.$lang89;
		}
		else{
			$key = array_search($liked, $favorites);
			unset($favorites[$key]);
			echo 'deleted***'.$lang59.'***'.$lang90;
		}
		
		if($user_logged) mysqli_query($db,"update users set favorites='".implode(",",$favorites)."' where id='$user[id]' ");
		else $_SESSION["favorites"]=$favorites;
	}
}
elseif($process_name=='add_basket'){
	$id=intval($_POST["id"]);
	$color_id=intval($_POST["color_id"]);
	$volume_id=intval($_POST["volume_id"]);
	$count=intval($_POST["count"]);
	
	if(mysqli_num_rows(mysqli_query($db,"select id from products where id='$id' and active=1 "))>0){
		$will_write=$id.'-'.$color_id.'-'.$volume_id;
		$key = array_search($will_write, $baskets);
		
		if(isset($baskets[$key])) $baskets[$will_write]+=$count;
		else $baskets[$will_write]=$count;
		
		$_SESSION["baskets"]=$baskets;
		echo 'added***'.$lang59.'***'.$lang91;
	}
}
elseif($process_name=='remove_basket'){
	$id=intval($_POST["id"]);
	$color_id=intval($_POST["color_id"]);
	$volume_id=intval($_POST["volume_id"]);
	$count=intval($_POST["count"]);
	
	if( mysqli_num_rows(mysqli_query($db,"select id from products where id='$id' and active=1 "))>0 && in_array($id,$baskets) ){
		$will_write=$id.'-'.$color_id.'-'.$volume_id;
		$key = array_search($will_write, $baskets);
		if($baskets[$key]<=$count) unset($baskets[$key]); else $baskets[$key]-=$count;
			
		echo 'removed***'.$lang59.'***'.$lang98;
		$_SESSION["baskets"]=$baskets;
	}
}
elseif($process_name=='clear_basket'){
	$baskets=array();
	$_SESSION["baskets"]=$baskets;
}

?>
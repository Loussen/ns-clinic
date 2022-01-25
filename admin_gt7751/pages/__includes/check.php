<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
// Data of user
if(isset($_SESSION["login".md5(db_name)])) $check_login=safe($_SESSION["login".md5(db_name)]); else $check_login='';
if(isset($_SESSION["pass".md5(db_name)])) $check_pass=safe($_SESSION["pass".md5(db_name)]); else $check_pass='';

if(isset($_SESSION["user_programs"]) && $_SESSION["user_programs"]){
	$check_tb='user_programs';
	$user_programs=true;
}
else{
	$check_tb='admins';
	if(isset($_SESSION["user_programs"])) unset($_SESSION["user_programs"]);
	$user_programs=false;
}

$user=mysqli_fetch_assoc(mysqli_query($db,"select * from $check_tb where login='$check_login' and pass='$check_pass' "));
if(intval($user["id"])==0){
	unset($_SESSION["user_programs"]);
	$filename = basename($_SERVER['REQUEST_URI']);
	if(stripos($_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],'/'.$admin_folder)>0 && $filename!='login.php' && $filename!='license.php'){
		if(is_file('login.php')) { header("Location: login.php"); exit(); die(); }
		elseif(is_file('../login.php')) { header("Location: ../login.php"); exit(); die(); }
		exit(); die();
	}
}

if($get_settings["admin_with_role"]>0){
	$permissions=json_decode($user["permissions"]);
	if($user["role_id"]==1){
		$info_role=mysqli_fetch_assoc(mysqli_query($db,"select permissions from admin_roles where id=1 "));
		$permissions=json_decode($info_role["permissions"]);
	}
	if( isset($do) && $do!='' && ( (!isset($permissions->$do->see) || $permissions->$do->see==0) and $user["role_id"]!=1 )  ) $do=$default_page;
	
	$have_permission=array();
	if(is_object($permissions)){
		foreach($permissions as $key=>$e){
			if($e->see==1) $have_permission[]=$key;
		}
	}
	if(count($have_permission)>0 ){		// && $user["role_id"]!=1
		$js.="will_hide_menu('".implode(",",$have_permission)."');";
	}
	elseif($user["permissions"]=='' ) $js.="will_hide_menu('all');";			// && $user["role_id"]!=1
	
}
else $user["role_id"]=1;

// for users. not admin
if($user_programs){
	$current_user=$user["id"];
	if($user["parent_id"]>0) $current_user_parent=$user["parent_id"]; else $current_user_parent=$user["id"];
	$user_parent_info=mysqli_fetch_assoc(mysqli_query($db,"select * from user_programs where id='$current_user_parent' "));
	$current_user_settings=json_decode($user_parent_info["settings"]);
	$company_info=mysqli_fetch_assoc(mysqli_query($db,"select * from company_info where user_id='$current_user_parent' "));
	$company_cid=$company_info["currency_id"];
	
	if($user_parent_info["expire_time"]<=$time && $do!='company_info' && $do!='logout'){
		header("Location: index.php?do=company_info&er=expire_time"); exit(); die();
	}
	
	// No any currency for this project
	/*
	elseif($company_cid==0 && $do!='company_info' && $do!='logout'){
		header("Location: index.php?do=company_info&er=currency_id"); exit(); die();
	}
	*/
	
	/*
	
	//Check currency setted
	if( mysqli_num_rows(mysqli_query($db,"select id from currency where user_id='$current_user_parent' "))==0 ){
		mysqli_query($db,"insert into currency (user_id) values ($user[id]) ");
	}
	
	$info_currency=mysqli_fetch_assoc(mysqli_query($db,"select * from currency where user_id='$current_user_parent' "));
	foreach($allCurrencies as $aa){
		if( ($info_currency[$aa]=='' or $info_currency[$aa]==0) && $do!='currency' ){
			header("Location: index.php?do=currency&er=currency_not_setted"); exit(); die();
		}
	}
	*/
}
else{
	$current_user=0;
	$current_user_parent=0;
	$user_parent_info=false;
	$current_user_settings=false;
	$company_cid=1;
}

if(!isset($user["full_list_access"])) $user["full_list_access"]='';
$full_list_access=json_decode($user["full_list_access"]);
?>
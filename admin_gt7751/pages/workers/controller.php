<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
if(!$user_programs) header_("Location: index.php");
$do_need="user_programs";
include "pages/__tools/some_params.php";

if($user["parent_id"]>0){
	setFlash("error","Bura daxil olmağa icazəniz yoxdur.");
	header_("Location: index.php?do=$default_page");
}
include "pages/__tools/some_params.php";

if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from $do_need where id='$edit' and parent_id='$current_user_parent' "))==0) header_("Location: index.php?do=$do");


if(isset($_GET["login_this"]) && $user_programs) $login_this=intval($_GET["login_this"]); else $login_this=0;
if($login_this>0 && mysqli_num_rows(mysqli_query($db,"select id from user_programs where id='$login_this' and parent_id='$current_user_parent' "))>0){
	$inf=mysqli_fetch_assoc(mysqli_query($db,"select login,pass from user_programs where id='$login_this' "));
	
	$_SESSION["login".md5(db_name)]=$inf["login"];
	$_SESSION["pass".md5(db_name)]=$inf["pass"];
	$_SESSION["user_programs"]=true;
	header("Location: index.php"); exit(); die();
}


// For paginator
$query_count="select id from $do_need where parent_id='$current_user_parent' and parent_id>0 ";
if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('name','login','email','address','mobile','pass',
		'tickets_view','hotels_view','packages_view','transfers_view','services_view','insurances_view','inner_tours_view',
		'tickets_edit','hotels_edit','packages_edit','transfers_edit','services_edit','insurances_edit','inner_tours_edit',
		'tickets_delete','hotels_delete','packages_delete','transfers_delete','services_delete','insurances_delete','inner_tours_delete',
		'tickets_cancel','hotels_cancel','packages_cancel','transfers_cancel','services_cancel','insurances_cancel','inner_tours_cancel',
		'tickets_older','hotels_older','packages_older','transfers_older','services_older','insurances_older','inner_tours_older', 'payments_older'
		);
	include "pages/__tools/check_post_datas.php";
	$pass=md5(md5($pass));
	
	$permissions_save=array();
	if($get_settings["admin_with_role"]==1){
		$MUI=mysqli_fetch_assoc(mysqli_query($db,"select permissions from user_programs where id='$current_user_parent' "));
		$MUI_permissions=json_decode($MUI["permissions"]);
		
		foreach($menu_names as $key=>$val){
			$var=$does[$key].'___see';		if(isset($_POST[$var]) && $_POST[$var]==1 && $MUI_permissions->{$does[$key]}->see==1) $see_=1; else $see_=0;
			$var=$does[$key].'___add';		if(isset($_POST[$var]) && $_POST[$var]==1 && $MUI_permissions->{$does[$key]}->add==1) $add_=1; else $add_=0;
			$var=$does[$key].'___edit';		if(isset($_POST[$var]) && $_POST[$var]==1 && $MUI_permissions->{$does[$key]}->edit==1) $edit_=1; else $edit_=0;
			$var=$does[$key].'___delete';	if(isset($_POST[$var]) && $_POST[$var]==1 && $MUI_permissions->{$does[$key]}->delete==1) $delete_=1; else $delete_=0;
			$var=$does[$key].'___position';	if(isset($_POST[$var]) && $_POST[$var]==1 && $MUI_permissions->{$does[$key]}->position==1) $position_=1; else $position_=0;
			$var=$does[$key].'___active';	if(isset($_POST[$var]) && $_POST[$var]==1 && $MUI_permissions->{$does[$key]}->active==1) $active_=1; else $active_=0;
			
			$permissions_save[$does[$key]]=array('see'=>$see_,'add'=>$add_,'edit'=>$edit_,'delete'=>$delete_,'position'=>$position_,'active'=>$active_);
		}
	}
	$permissions_save=json_encode($permissions_save);
	
	if($login=='') $error="Login daxil edilməyib";
	elseif($pass==md5(md5("")) && $add==1) $error="Şifrə boş qala bilməz";

	if($error=="" && ($edit>0 || $add>0) ){
		include "pages/__includes/setSettingsParams.php"; $user_settings=json_encode($user_settings);
		
		if(!isset($tickets_view)) $tickets_view=0;
		if(!isset($hotels_view)) $hotels_view=0;
		if(!isset($packages_view)) $packages_view=0;
		if(!isset($transfers_view)) $transfers_view=0;
		if(!isset($services_view)) $services_view=0;
		if(!isset($insurances_view)) $insurances_view=0;
		if(!isset($inner_tours_view)) $inner_tours_view=0;
		
		if(!isset($tickets_edit)) $tickets_edit=0;
		if(!isset($hotels_edit)) $hotels_edit=0;
		if(!isset($packages_edit)) $packages_edit=0;
		if(!isset($transfers_edit)) $transfers_edit=0;
		if(!isset($services_edit)) $services_edit=0;
		if(!isset($insurances_edit)) $insurances_edit=0;
		if(!isset($inner_tours_edit)) $inner_tours_edit=0;
		
		if(!isset($tickets_delete)) $tickets_delete=0;
		if(!isset($hotels_delete)) $hotels_delete=0;
		if(!isset($packages_delete)) $packages_delete=0;
		if(!isset($transfers_delete)) $transfers_delete=0;
		if(!isset($services_delete)) $services_delete=0;
		if(!isset($insurances_delete)) $insurances_delete=0;
		if(!isset($inner_tours_delete)) $inner_tours_delete=0;
		
		if(!isset($tickets_cancel)) $tickets_cancel=0;
		if(!isset($hotels_cancel)) $hotels_cancel=0;
		if(!isset($packages_cancel)) $packages_cancel=0;
		if(!isset($transfers_cancel)) $transfers_cancel=0;
		if(!isset($services_cancel)) $services_cancel=0;
		if(!isset($insurances_cancel)) $insurances_cancel=0;
		if(!isset($inner_tours_cancel)) $inner_tours_cancel=0;
		
		if(!isset($tickets_older)) $tickets_older=0;
		if(!isset($hotels_older)) $hotels_older=0;
		if(!isset($packages_older)) $packages_older=0;
		if(!isset($transfers_older)) $transfers_older=0;
		if(!isset($services_older)) $services_older=0;
		if(!isset($insurances_older)) $insurances_older=0;
		if(!isset($inner_tours_older)) $inner_tours_older=0;
		if(!isset($payments_older)) $payments_older=0;
		

		$full_list_access["tickets"]["view"]=intval($tickets_view);
		$full_list_access["hotels"]["view"]=intval($hotels_view);
		$full_list_access["packages"]["view"]=intval($packages_view);
		$full_list_access["transfers"]["view"]=intval($transfers_view);
		$full_list_access["services"]["view"]=intval($services_view);
		$full_list_access["insurances"]["view"]=intval($insurances_view);
		$full_list_access["inner_tours"]["view"]=intval($inner_tours_view);
		
		$full_list_access["tickets"]["edit"]=intval($tickets_edit);
		$full_list_access["hotels"]["edit"]=intval($hotels_edit);
		$full_list_access["packages"]["edit"]=intval($packages_edit);
		$full_list_access["transfers"]["edit"]=intval($transfers_edit);
		$full_list_access["services"]["edit"]=intval($services_edit);
		$full_list_access["insurances"]["edit"]=intval($insurances_edit);
		$full_list_access["inner_tours"]["edit"]=intval($inner_tours_edit);
		
		$full_list_access["tickets"]["delete"]=intval($tickets_delete);
		$full_list_access["hotels"]["delete"]=intval($hotels_delete);
		$full_list_access["packages"]["delete"]=intval($packages_delete);
		$full_list_access["transfers"]["delete"]=intval($transfers_delete);
		$full_list_access["services"]["delete"]=intval($services_delete);
		$full_list_access["insurances"]["delete"]=intval($insurances_delete);
		$full_list_access["inner_tours"]["delete"]=intval($inner_tours_delete);
		
		$full_list_access["tickets"]["cancel"]=intval($tickets_cancel);
		$full_list_access["hotels"]["cancel"]=intval($hotels_cancel);
		$full_list_access["packages"]["cancel"]=intval($packages_cancel);
		$full_list_access["transfers"]["cancel"]=intval($transfers_cancel);
		$full_list_access["services"]["cancel"]=intval($services_cancel);
		$full_list_access["insurances"]["cancel"]=intval($insurances_cancel);
		$full_list_access["inner_tours"]["cancel"]=intval($inner_tours_cancel);
		
		$full_list_access["tickets"]["older"]=intval($tickets_older);
		$full_list_access["hotels"]["older"]=intval($hotels_older);
		$full_list_access["packages"]["older"]=intval($packages_older);
		$full_list_access["transfers"]["older"]=intval($transfers_older);
		$full_list_access["services"]["older"]=intval($services_older);
		$full_list_access["insurances"]["older"]=intval($insurances_older);
		$full_list_access["inner_tours"]["older"]=intval($inner_tours_older);
		$full_list_access["payments"]["older"]=intval($payments_older);
		
		$full_list_access=json_encode($full_list_access);
		

		if($add==1){
			mysqli_query($db,"insert into $do_need (parent_id,name,login,email,address,mobile,pass,active,permissions,settings,full_list_access) values ('$current_user_parent','$name','$login','$email','$address','$mobile','$pass','1','$permissions_save','$user_settings','$full_list_access') ");
		}
		elseif($edit>0){
			mysqli_query($db,"update $do_need set name='$name', login='$login',email='$email',address='$address',mobile='$mobile',settings='$user_settings',full_list_access='$full_list_access' where id='$edit' ");
			if( $pass!=md5(md5("")) ){
				mysqli_query($db,"update $do_need set pass='$pass' where id='$edit' ");
			}
			
			if($get_settings["admin_with_role"]==1){
				mysqli_query($db,"update $do_need set permissions='$permissions_save' where id='$edit' ");
			}
		}
		setFlash("ok","Məlumatlar uğurla yadda saxlanıldı.");
		header_("Location: ".addFullUrl(array('add'=>0,'edit'=>0)));
	}
}
elseif($delete>0 && mysqli_num_rows(mysqli_query($db,"select id from $do_need where id='$delete' and parent_id='$current_user_parent' "))>0)
{
	$info=mysqli_fetch_assoc(mysqli_query($db,"select * from $do_need where id='$delete' "));
	if(in_array('important',$get_table_name_columns) && $info["important"]==1) $error="Bu məlumatı silmək olmaz.";
	elseif(mysqli_num_rows(mysqli_query($db,"select id from $do_need where id!='$delete' "))==0) $error="Son istifadəçini silmək olmaz.";
	else{
		if(isset($imageFolder)) deleteOldFiles($do_need,$delete,$imageFolder);
		mysqli_query($db,"delete from $do_need where id='$delete' ");
		$ok="Məlumat silindi.";
		include "pages/__tools/reposition.php";
	}
}

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do_need where id='$edit' "));
	$for_permissions=mysqli_fetch_assoc(mysqli_query($db,"select permissions from $do_need where id='$current_user_parent' "));
	$for_permissions=json_decode($for_permissions["permissions"]);
	$full_list_access=json_decode($information["full_list_access"]);

$CUS=mysqli_fetch_assoc(mysqli_query($db,"select settings from user_programs where parent_id='$current_user_parent' ")); $current_user_settings=json_decode($CUS["settings"]);

?>
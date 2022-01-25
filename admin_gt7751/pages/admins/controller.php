<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";
if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$edit' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }

// For paginator
$query_count="select id from $do where id>0 ";
if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('login','pass','role_id');
	include "pages/__tools/check_post_datas.php";
	
	$permissions_save=array();
	if($get_settings["admin_with_role"]==1){
		$role_id=intval($role_id);

		foreach($menu_names as $key=>$val){
			$var=$does[$key].'___see';		if(isset($_POST[$var]) && $_POST[$var]==1) $see_=1; else $see_=0;
			$var=$does[$key].'___add';		if(isset($_POST[$var]) && $_POST[$var]==1) $add_=1; else $add_=0;
			$var=$does[$key].'___edit';		if(isset($_POST[$var]) && $_POST[$var]==1) $edit_=1; else $edit_=0;
			$var=$does[$key].'___delete';	if(isset($_POST[$var]) && $_POST[$var]==1) $delete_=1; else $delete_=0;
			$var=$does[$key].'___position';	if(isset($_POST[$var]) && $_POST[$var]==1) $position_=1; else $position_=0;
			$var=$does[$key].'___active';	if(isset($_POST[$var]) && $_POST[$var]==1) $active_=1; else $active_=0;
			
			$permissions_save[$does[$key]]=array('see'=>$see_,'add'=>$add_,'edit'=>$edit_,'delete'=>$delete_,'position'=>$position_,'active'=>$active_);
		}
	}
	$permissions_save=json_encode($permissions_save);
	
	if($login!="" && ($edit>0 || $add>0) ){
		if($add==1){
			$salt=saltGenerator();
			$pass=md5(md5($pass).$salt);
			mysqli_query($db,"insert into $do (login,pass,salt,role_id,active,permissions) values ('$login','$pass','$salt','0','1','$permissions_save') ");
			$ok="Məlumatlar yadda saxlanıldı.";
			$last_id=mysqli_insert_id($db);
			$ok="Məlumatlar yadda saxlanıldı.";
			if($get_settings["admin_with_role"]==1){
				if($role_id>0){
					$info_role=mysqli_fetch_assoc(mysqli_query($db,"select permissions from admin_roles where id='$role_id' "));
					$permissions_save=$info_role["permissions"];
				}
				mysqli_query($db,"update $do set permissions='$permissions_save',role_id='$role_id' where id='$last_id' ");
			}
		}
		else{
			mysqli_query($db,"update $do set login='$login' where id='$edit' ");
			if($pass!=""){
				$salt=saltGenerator();
				$pass=md5(md5($pass).$salt);
				mysqli_query($db,"update $do set pass='$pass',salt='$salt' where id='$edit' ");
				if($edit==$user["id"]) $_SESSION["pass".md5(db_name)]=$pass;
			}
			
			if($get_settings["admin_with_role"]==1){
				if($role_id>0){
					$info_role=mysqli_fetch_assoc(mysqli_query($db,"select permissions from admin_roles where id='$role_id' "));
					$permissions_save=$info_role["permissions"];
				}
				mysqli_query($db,"update $do set permissions='$permissions_save',role_id='$role_id' where id='$edit' ");
			}
			
			if($edit==$user["id"]) $_SESSION["login"]=$login;
			$ok="Məlumatlar yadda saxlanıldı.";
		}
		$hideForm='hide';
	}
}
elseif($_POST && !check_csrf_(safe($_POST["csrf_"]),$do) ){
	$add=0; $edit=0; $hideForm='hide';
}
elseif($delete>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$delete' "))>0)
{
	$info=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$delete' "));
	if(in_array('important',$get_table_name_columns) && $info["important"]==1) $error="Bu məlumatı silmək olmaz.";
	elseif(mysqli_num_rows(mysqli_query($db,"select id from $do where id!='$delete' "))==0) $error="Son istifadəçini silmək olmaz.";
	else{
		if(isset($imageFolder)) deleteOldFiles($do,$delete,$imageFolder);
		mysqli_query($db,"delete from $do where id='$delete' ");
		$ok="Məlumat silindi.";
		include "pages/__tools/reposition.php";
	}
}

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$edit' "));
?>
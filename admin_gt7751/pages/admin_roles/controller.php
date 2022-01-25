<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";
if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$edit' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }

// For paginator
$query_count="select id from $do where id>0 ";
if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('name');
	include "pages/__tools/check_post_datas.php";
	
	$permissions_save=array();
	if($get_settings["admin_with_role"]==1){
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
	
	if($error=='' && ($edit>0 || $add>0) ){
		include "pages/__tools/create_only_langs_query.php";
		
		if($edit>0){
			mysqli_query($db,"update $do set name='$name',permissions='$permissions_save' where id='$edit' ");
			mysqli_query($db,"update user_programs set permissions='$permissions_save' where role_id='$edit' ");
		}
		elseif($add>0) mysqli_query($db,"insert into $do (name,permissions,position,active) values ('$name','$permissions_save','$position','$active') ");
		$ok="Məlumatlar uğurla yadda saxlanıldı.";
		$hideForm='hide';
	}
}
elseif($delete>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$delete' "))>0)
{
	mysqli_query($db,"delete from $do where id='$delete' ");
	$ok="Məlumat silindi.";
	include "pages/__tools/reposition.php";
}
include "pages/__tools/position_changer.php";

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$edit' "));
?>
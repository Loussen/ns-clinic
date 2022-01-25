<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";
if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$edit' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }

// For paginator
$query_count="select id from $do where id>0 ";

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('category_id','question','answer');
	include "pages/__tools/check_post_datas.php";
	
	// version 1
	/*
		You can change any variables in here
	*/
	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		if($edit>0) mysqli_query($db,"update $do set $query_update where id='$edit' ");
		else mysqli_query($db,"insert into $do (position,active,$query_insert) values ('$position','$active',$query_insert_val) ");
		$ok="Məlumatlar uğurla yadda saxlanıldı.";
		$hideForm='hide';
	}
	
	// version 2
	//$datas_which_update=array('category_id');
	//$datas_which_insert=array('category_id','position','active');
	/*
		You can change any variables in here
	*/
	/*
	if($error==''){
		include "pages/__tools/create_full_query.php";
		
		if($edit>0) 	mysqli_query($db,$query_update);
		else			mysqli_query($db,$query_insert);
		$ok="Məlumatlar uğurla yadda saxlanıldı.";
		$hideForm='hide';
	}
	*/
	
}
elseif($delete>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$delete' "))>0)
{
	$info=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$delete' "));
	if(in_array('important',$get_table_name_columns) && $info["important"]==1) $error="Bu məlumatı silmək olmaz.";
	else{
		if(isset($imageFolder)) deleteOldFiles($do,$delete,$imageFolder);
		mysqli_query($db,"delete from $do where id='$delete' ");
		$ok="Məlumat silindi.";
		include "pages/__tools/reposition.php";
	}
}
include "pages/__tools/position_changer.php";

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$edit' "));
?>
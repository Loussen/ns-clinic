<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";

if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$edit' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }

// For paginator
$query_count="select id from $do where id>0 ";
$imageFolder='../images/'.$do;
checkFolderIsset($imageFolder);

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('datetime','hour','name','text');
	include "pages/__tools/check_post_datas.php";
	$hour=explode(":",$hour);
	if($datetime!=""){
		$datetime=explode("/",$datetime);
		$datetime=mktime($hour[0],$hour[1],date("s"),$datetime[1],$datetime[0],$datetime[2]);
	}
	else $datetime=$time;

	if($$Name=='') $error='Başlıq daxil edilməyib. (Dil: '.$lang_name.')';
	
	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		// print_r($query_update);
		// die;
		if($edit>0) mysqli_query($db,"update $do set $query_update,datetime='$datetime' where id='$edit' ");
		else mysqli_query($db,"insert into $do (position,datetime,active) values ('$position','$datetime','$active') ");
		$ok="Məlumatlar uğurla yadda saxlanıldı.";
		$hideForm='hide';
		
		if($edit>0) $data_id=$edit; else $data_id=mysqli_insert_id($db);
		$uploadedFile=fileUpload('document');
	}
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
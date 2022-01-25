<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";
if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$edit' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }

// For paginator
$query_count="select id from $do where id>0 and parent_id=0 ";
$imageFolder='../images/'.$do;
checkFolderIsset($imageFolder);

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('name','text','icon_code','link','parent_id');
	include "pages/__tools/check_post_datas.php";
	
	if($$Name=='') $error='Ad daxil edilməyib. (Dil: '.$lang_name.')';

	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		
		if($edit>0) mysqli_query($db,"update $do set $query_update,parent_id='$parent_id',icon_code='$icon_code' where id='$edit' ");
		else mysqli_query($db,"insert into $do (parent_id,link,position,icon_code,active,$query_insert) values ('$parent_id','$link','$position','$icon_code','$active',$query_insert_val) ");
		$ok="Məlumatlar uğurla yadda saxlanıldı.";
		$hideForm='hide';
		
		if($edit>0) $data_id=$edit; else $data_id=mysqli_insert_id($db);
		$uploadedFile=fileUpload('image');
		if($uploadedFile!=''){
			makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,800,800);
		}
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
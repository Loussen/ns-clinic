<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";


if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$edit' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }

// For paginator
$query_count="select id from $do where id>0 ";
$imageFolder='../images/'.$do;

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('video_url','name');
	include "pages/__tools/check_post_datas.php";
	
	if($$Name=='') $error='Başlıq daxil edilməyib. (Dil: '.$lang_name.')';
	
	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		
		if($edit>0) mysqli_query($db,"update $do set $query_update,video_url='$video_url' where id='$edit' ");
		else mysqli_query($db,"insert into $do (position,video_url,active,$query_insert) values ('$position','$video_url','$active',$query_insert_val) ");
				
		$ok="Məlumatlar uğurla yadda saxlanıldı.";
		$hideForm='hide';
		
		if($edit>0) $data_id=$edit; else $data_id=mysqli_insert_id($db);
	}
}
elseif($_POST && !check_csrf_(safe($_POST["csrf_"]),$do) ){
	$add=0; $edit=0; $hideForm='hide';
}
elseif($delete>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$delete' "))>0)
{
	$info=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$delete' "));
	if( !in_array('important',$get_table_name_columns) or ( in_array('important',$get_table_name_columns) && $info["important"]==0 ) ){
		mysqli_query($db,"delete from $do where id='$delete' ");
		$ok="Məlumat silindi.";
		include "pages/__tools/reposition.php";
	}
	elseif(in_array('important',$get_table_name_columns) && $info["important"]==1) $error="Bu məlumatı silmək olmaz.";
}
elseif($delete>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$delete' "))>0)
{
	$info=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$delete' "));
	if(in_array('important',$get_table_name_columns) && $info["important"]==1) $error="Bu məlumatı silmək olmaz.";
	else{
		mysqli_query($db,"delete from $do where id='$delete' ");
		$ok="Məlumat silindi.";
		include "pages/__tools/reposition.php";
	}
}
include "pages/__tools/position_changer.php";

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$edit' "));
?>
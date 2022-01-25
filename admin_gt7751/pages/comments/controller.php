<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";
if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$edit' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }if(isset($_POST["information_id"])) $information_id=intval($_POST["information_id"]); else $information_id='';if(isset($_REQUEST["table_name"])) $table_name=safe($_REQUEST["table_name"]); else $table_name=0;

// For paginator
$query_count="select id from $do where id>0 ";if($table_name!='') $query_count.=" and table_name='$table_name' ";if($information_id>0) $query_count.=" and information_id='$information_id' ";

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('name','comment');
	include "pages/__tools/check_post_datas.php";

	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		if($edit>0) mysqli_query($db,"update $do set name='$name',comment='$comment' where id='$edit' ");
		//else mysqli_query($db,"insert into $do (position,active,$query_insert) values ('$position','$active',$query_insert_val) ");
		$ok="Məlumatlar uğurla yadda saxlanıldı.";
		$hideForm='hide';
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
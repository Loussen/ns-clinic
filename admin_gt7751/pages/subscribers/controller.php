<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";

// For paginator
$query_count="select id from $do where id>0 ";

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('from_name','title','message');
	include "pages/__tools/check_post_datas.php";

	$from=mysqli_fetch_assoc(mysqli_query($db,"select email from contacts"));
	if($message!="")
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers  .= "From: ".$from_name." <".$from["email"]."> \n";
		$headers  .= "Reply-To: ".$from["email"];
	
		$sql=mysqli_query($db,"select * from $do order by id");
		while($row=mysqli_fetch_assoc($sql)){
			@mail($row["email"],$title,decode_text($message),$headers);
		}
		$ok="Məktub bütün maillərə göndərildi.";
	}
	else $error="Məktub daxil edilməyib.";
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
?>
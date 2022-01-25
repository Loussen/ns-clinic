<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

// Delete datas image
if($delete_file>0 && !$_POST && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$delete_file' "))>0)
{
	if(isset($_GET["delete_file_column"])) $delete_file_column=safe($_GET["delete_file_column"]); else $delete_file_column='';
	if($delete_file_column!='' && in_array($delete_file_column,$get_table_name_columns) ){
		if($settings_inner["upload_important"]>0) $error="Fayl mütləqdir. Silmək olmaz.";
		else{
			deleteOldFiles($do,$delete_file,$imageFolder, $delete_file_column);
			mysqli_query($db,"update $do set $delete_file_column='' where id='$delete_file'");
		}
	}
}
?>
<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";

$imageFolder='../images/'.$do;
checkFolderIsset($imageFolder);

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) && $settings_inner["edit_available"]>0 )
{
	$datas_post=array('name','full_text');
	include "pages/__tools/check_post_datas.php";

	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		
		mysqli_query($db,"update $do set $query_update ");
		$ok="Məlumatlar uğurla yadda saxlanıldı.";
		
		$data_id=1;
		$uploadedFile=fileUpload('image');
		$uploadedFile2=fileUpload('image2');
		if($uploadedFile!=''){
//			makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,300,200);
		}
	}
}
elseif($_POST && !check_csrf_(safe($_POST["csrf_"]),$do) ){
	$add=0; $edit=0; $hideForm='hide';
}
include "pages/__tools/position_changer.php";

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do"));
?>
<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";

$imageFolder='../images/'.$do;
checkFolderIsset($imageFolder);

$edit=1;

if(isset($_POST["submit_insert_update"]) && $settings_inner["edit_available"]>0 ) // && check_csrf_(safe($_POST["csrf_"]),$do)
{
	$datas_post=array('');
	include "pages/__tools/check_post_datas.php";

	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		
		//mysqli_query($db,"update $do set $query_update, gundem='$gundem' ");
		
		$data_id=1;
		$uploadedFile=fileUpload('image_arge');
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,360,360);
		
		$uploadedFile=fileUpload('image_kalite');
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,360,360);
		
		$uploadedFile=fileUpload('image_marka');
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,360,360);
		
		$uploadedFile=fileUpload('image_footer',false);
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/'.$uploadedFile,0,0);
		//if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,360,360);
		
		$uploadedFile=fileUpload('image_about',false);
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/'.$uploadedFile,0,0);
		//if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,360,360);
		
		$uploadedFile=fileUpload('image_about1');
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,600,600);
		
		$uploadedFile=fileUpload('image_about2');
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,600,600);
		
		$uploadedFile=fileUpload('image_about3');
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,600,600);
		
		$uploadedFile=fileUpload('image_contact',false);
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/'.$uploadedFile,0,0);
		//if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,600,600);
		
		$uploadedFile=fileUpload('image_sunar1');
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,600,600);
		
		$uploadedFile=fileUpload('image_sunar2');
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,600,600);
		
		$uploadedFile=fileUpload('image_sunar3');
		if($uploadedFile!='') makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,600,600);
		
		setFlash('ok','Məlumatlar uğurla yadda saxlanıldı.');
		header_("Location: ".addFullUrl());
	}
}
include "pages/__tools/position_changer.php";

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do"));
?>
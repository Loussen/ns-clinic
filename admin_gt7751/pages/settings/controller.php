<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";

$imageFolder='assets/plugins/images/logo';
checkFolderIsset($imageFolder);

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) && $settings_inner["edit_available"]>0 )
{
	$datas_post=array('admin_name','title_','keywords_','description_','currency','wheather','namaz','admin_with_role','include_site_langs','image_crop','default_page','want_license_pass_change');
	include "pages/__tools/check_post_datas.php";
	
	$image_logo=$_FILES["image_logo"]["tmp_name"];	$image_logoName=$_FILES["image_logo"]["name"];
	$image_fav=$_FILES["image_fav"]["tmp_name"];	$image_favName=$_FILES["image_fav"]["name"];
	
	if($image_logo!='' && !checkFileType($image_logoName)) $error='Şəkil tipi uyğun deyil.';
	elseif($image_fav!='' && !checkFileType($image_favName)) $error='Şəkil tipi uyğun deyil.';
	elseif(!isset($imageFolder) || $imageFolder=='') $error='$imageFolder dəyişəni tanımlanmayıb. Zəhmət olmasa düzəliş edin.';
	
	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		
		mysqli_query($db,"update $do set currency='$currency',wheather='$wheather',namaz='$namaz',admin_with_role='$admin_with_role',include_site_langs='$include_site_langs',
		want_license_pass_change='$want_license_pass_change',admin_name='$admin_name',title_='$title_',keywords_='$keywords_',description_='$description_' ,image_crop='$image_crop', default_page='$default_page' ");
		
		$data_id=1; $edit=1;
		$uploadedFile=fileUpload('image_logo',false);
		$uploadedFile=fileUpload('image_fav',false);
		
		setFlash('ok','Məlumatlar uğurla yadda saxlanıldı.');
		header_("Location: ".addFullUrl());
	}
}
include "pages/__tools/position_changer.php";

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do"));
?>
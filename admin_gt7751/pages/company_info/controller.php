<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
if(!$user_programs) header_("Location: index.php");
include "pages/__tools/some_params.php";

if($user["parent_id"]>0){
	setFlash("error","Bura daxil olmağa icazəniz yoxdur.");
	header_("Location: index.php?do=$default_page");
}

$imageFolder='assets/plugins/images/companies/'.$current_user_parent;
checkFolderIsset($imageFolder);

if(isset($_GET["er"])) $er=safe($_GET["er"]); else $er='';
if($er=='expire_time' && $user_parent_info["expire_time"]<=$time) setFlash('error','Proqramın müddəti başa çatıb. Artırmaq üçün administrator ilə əlaqə saxlayın.');
elseif($er=='currency_id' && $company_cid==0) setFlash('error','Zəhmət olmasa valyutanı seçin');

// For paginator
$query_count="select id from $do where id>0 ";

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('name','expire_time','currency_id');
	include "pages/__tools/check_post_datas.php";
	
	if(intval($currency_id)==0) $error="Valyuta seçilməyib.";
	
	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		
		include "pages/__includes/setSettingsParams.php"; $user_settings=json_encode($user_settings);

		mysqli_query($db,"update sales set settings='$user_settings' where user_id='$current_user_parent' ");
		
		if(mysqli_num_rows(mysqli_query($db,"select id from $do where user_id='$current_user_parent' "))>0){
			mysqli_query($db,"update $do set name='$name',currency_id='$currency_id' where user_id='$current_user_parent' ");
			
			if($currency_id!=$company_cid) doCurrencyUpdate($current_user_parent);
			
			$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where user_id='$current_user_parent' "));
			$data_id=$information["id"];
		}
		else{
			if($name=='') $name=$user["login"];
			mysqli_query($db,"insert into $do (user_id,name,currency_id) values ('$current_user_parent','$name','$currency_id') ");
			$data_id=mysqli_insert_id($db);
		}
		$ok="Məlumatlar uğurla yadda saxlanıldı.";
		
		$uploadedFile=fileUpload('image_logo');
		//if($uploadedFile!=''){ //makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,300,200); }
		
		if($expire_time>0){
			$expire_time_mk=$user["expire_time"]+($expire_time*86400);
			
			if($expire_time==30) $amount=$user["price"]*1*1.0;
			elseif($expire_time==90) $amount=$user["price"]*3*0.9;
			elseif($expire_time==182) $amount=$user["price"]*6*0.8;
			elseif($expire_time==365) $amount=$user["price"]*12*0.7;
			/*
			// burda odeniw prosesleri gedecek. istifadecini odeniw sehifesine yonlendirsin falan
			
			*/
		}
	}
}
$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where user_id='$current_user_parent' "));
$CUS=mysqli_fetch_assoc(mysqli_query($db,"select * from user_programs where id='$current_user_parent' ")); $current_user_settings=json_decode($CUS["settings"]);
?>
<?php
include "pages/__includes/config.php";
include "pages/__includes/check.php";

if(isset($_POST["process_name"])) $process_name=safe($_POST["process_name"]); else $process_name='';
if(isset($_POST["info_id"])) $info_id=intval($_POST["info_id"]); else $info_id=0;
if(isset($_POST["table"])) $table=safe($_POST["table"]); else $table='';
if(isset($_POST["new_active"])) $new_active=intval($_POST["new_active"]); else $new_active=0;

if($process_name=='menu_open_close'){
	$type=safe($_POST["type"]);
	if($type=='minimize') $_SESSION["menu_minimize"]=true;
	else $_SESSION["menu_minimize"]=false;
}

elseif($process_name=='image_crop_saver'){
	$image_name=safe($_POST["image_name"]);
	$image_code=safe($_POST["image_code"]);
	$type_selected_image=safe($_POST["type_selected_image"]);
	
	if($type_selected_image=='jpg' || $type_selected_image=='jpeg') $image_code=str_replace("data:image/jpeg;base64,","",$image_code);
	elseif($type_selected_image=='png') $image_code=str_replace("data:image/png;base64,","",$image_code);
	else $type_selected_image='';
	
	if($type_selected_image!=''){
		$image_code=base64_decode($image_code);
		$open=fopen('assets/'.$image_name.'.'.$type_selected_image,'w+');
		fwrite($open,$image_code);
		fclose($open);
	}
	echo 'saved';
}

elseif($process_name=='' && $table!='' && ( (isset($permissions->$table->active) && $permissions->$table->active==1) or $user["role_id"]==1 ) ){
	if($info_id>0 && $new_active>=0) mysqli_query($db,"update $table set active='$new_active' where id='$info_id' ");
}
?>
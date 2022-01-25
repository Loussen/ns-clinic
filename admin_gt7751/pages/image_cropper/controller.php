<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";

if($get_settings["image_crop"]==0) header_("Location: index.php?do=".$get_settings["default_page"]);

if(isset($_GET["return_url"])) $return_url=safe(base64_decode($_GET["return_url"])); else $return_url='';
if(isset($_GET["image"]) && isset($_GET["image_folder"]) ){
	$image_folder=safe(base64_decode($_GET["image_folder"]));
	$image=safe(base64_decode($_GET["image"]));
	
	$image_src=SITE_PATH.'/'.$admin_folder.'/'.$image_folder.'/'.$image;
	$type_selected_image=explode(".",$image);  $type_selected_image=end($type_selected_image);
	
	$open=opendir('assets/');
	while($read=readdir($open)){
		if(substr_($read,0,6)=='zoomed' && substr_($read,8)==$image){
			unlink('assets/'.$read);
		}
	}
	
	// save image
	if(isset($_GET["save"])) $save=safe($_GET["save"]); else $save='';
	if($save!=''){
		$img='assets/'.$save.'.'.$type_selected_image;
		rename($img,$image_folder.'/thumb_'.$image);
		header_("Location: $return_url");
	}
	//
	
	// zoom out
	if(isset($_GET["zoom_out"])) $zoom_out=safe($_GET["zoom_out"]); else $zoom_out=0;
	if($zoom_out>0 && $zoom_out<=5){
		$path=$image_folder.'/'.$image;
		list($width, $height, $type, $attr) = getimagesize($path);
		$will_zoom='assets/zoomed'.$zoom_out.'_'.$image;
		makeThumb($path,$will_zoom,$width/$zoom_out);
		$image_src=SITE_PATH.'/'.$admin_folder.'/'.$will_zoom;
	}
	//
}
else{
	$image_src=SITE_PATH.'/'.$admin_folder.'/assets/plugins/images/big/img1.jpg';
	$return_url='';
}

if($zoom_out==0) $zoom_out=1;
?>
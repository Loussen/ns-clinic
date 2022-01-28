<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";
$table=str_replace("_gallery","",$do);
if(mysqli_num_rows(mysqli_query($db,"select id from $table where id='$parent_id' "))==0) { header("Location: index.php?do=$table"); exit(); die(); }

if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$edit' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }

// For paginator
$query_count="select id from $do where id>0 and parent_id='$parent_id' ";
$imageFolder='../images/'.$table.'_gallery/'.$parent_id;
checkFolderIsset($imageFolder);

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('name');
	include "pages/__tools/check_post_datas.php";
	
	$images=$_FILES["image"]["tmp_name"];	$imageNames=$_FILES["image"]["name"];

	if($settings_inner["upload_important"]>0 && count($images)==0 && $add>0) $error="Şəkil seçmək mütləqdir.";
	//elseif($$Name=='') $error='Ad daxil edilməyib. (Dil: '.$lang_name.')';

	if($error==''){
		include "pages/__tools/create_only_langs_query.php";

		$count=0;
		foreach($images as $image){
			$imageName=$imageNames[$count];
			if($image!=''){
				if(!checkFileType($imageName)) $error='Şəkil tipi uyğun deyil.';
				else{
					deleteOldFiles($do,$edit,$imageFolder);
					$imageName=fileNameGenerator($imageName);	$uploadImage=$imageFolder.'/'.$imageName;
					move_uploaded_file($image,$uploadImage);
					
					checkMaxSizeImage($uploadImage);
					makeThumb($uploadImage,$imageFolder.'/thumb_'.$imageName,370,370);
				}
				$count++;
			}
			if($edit>0){
				mysqli_query($db,"update $do set $query_update,parent_id='$parent_id',image='$imageName' where id='$edit' ");
				break;
			}
			else mysqli_query($db,"insert into $do (parent_id,image,position,active,$query_insert) values ('$parent_id','$imageName','$position','$active',$query_insert_val) ");
		}
		
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
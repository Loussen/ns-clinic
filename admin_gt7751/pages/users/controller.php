<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";
if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$edit' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }

$imageFolder='../images/'.$do;
checkFolderIsset($imageFolder);

// For paginator
$query_count="select id from $do where id>0 ";

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('name','login','email','pass','birthday','gender','mobile','about','activation','');
	include "pages/__tools/check_post_datas.php";
	
	if($birthday!=""){
		$birthday=explode("/",$birthday);
		$birthday=mktime(0,0,0,$birthday[1],$birthday[0],$birthday[2]);
	}
	else $birthday=$time;
	
	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		
		if($edit>0){
			mysqli_query($db,"update $do set $query_update, name='$name',login='$login',email='$email',about='$about',gender='$gender',mobile='$mobile',birthday='$birthday',activation='$activation' where id='$edit' ");
			if($pass!=""){
				$salt=saltGenerator();
				$pass=md5(md5($pass).$salt);
				mysqli_query($db,"update $do set pass='$pass',salt='$salt' where id='$edit' ");
			}
		}
		else{
			$salt=saltGenerator();
			$pass=md5(md5($pass).$salt);
			mysqli_query($db,"insert into $do (name,login,pass,salt,email,about,gender,mobile,create_date,birthday,activation,active,$query_insert) values ('$name','$login','$pass','$salt','$email','$about','$gender','$mobile','$time','$birthday','1','$active',$query_insert_val) ");
		}
		$ok="Məlumatlar uğurla yadda saxlanıldı.";
		$hideForm='hide';
		
		
		if($edit>0) $data_id=$edit; else $data_id=mysqli_insert_id($db);
		$uploadedFile=fileUpload('image');
		if($uploadedFile!=''){
			//makeThumb($imageFolder.'/'.$uploadedFile,$imageFolder.'/thumb_'.$uploadedFile,300,200);
		}
	}
}
elseif($_POST && !check_csrf_(safe($_POST["csrf_"]),$do) ){
	$add=0; $edit=0; $hideForm='hide';
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
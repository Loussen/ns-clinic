<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

if($edit>0) $data_id=$edit; else $data_id=mysqli_insert_id($db);

// For: not multi language and for onyl images
if(isset($image)){
	// single upload
	for($i=0;$i<=10;$i++){
		$var='image'.$i;		if($i==0) $var='image';
		
		if(isset($$var)){
			deleteOldFiles($do,$edit,$imageFolder,$var);
			
			// file name
			$varName=$var.'_name'; $$varName=fileNameGenerator($$varName);
			
			// file path name
			$uploadImage=$imageFolder.'/'.$$varName;
			
			move_uploaded_file($$var,$uploadImage);
			if(checkColumn($do,$var)) mysqli_query($db,"update $do set $var='$$varName' where id='$data_id' ");
		}
	}
}
?>
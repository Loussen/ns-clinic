<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

if(isset($datas_post) && is_array($datas_post)){
	foreach($datas_post as $key){
		if(isset($_POST["$key"])){
			$$key=$_POST["$key"];
			if(!is_array($$key)) $$key=safe($$key);
			else $$key=array_map('safe',$$key);
		}
		else{
			foreach($all_langs as $ln){
				$key_lang=$key.'_'.$ln;
				if(isset($_POST["$key_lang"])){
					$$key_lang=$_POST["$key_lang"];
					if(!is_array($$key_lang)) $$key_lang=safe($$key_lang);
					else $$key_lang=array_map('safe',$key_lang);
				}
			}
		}
	}
}
if(isset($datas_get) && is_array($datas_get)){
	foreach($datas_get as $key){
		if(isset($_GET["$key"])){
			$$key=$_GET["$key"];
			if(!is_array($$key)) $$key=safe($$key);
			else $$key=array_map('safe',$$key);
		}
		else{
			foreach($all_langs as $ln){
				$key_lang=$key.'_'.$ln;
				if(isset($_GET["$key_lang"])){
					$$key_lang=$_GET["$key_lang"];
					if(!is_array($$key_lang)) $$key_lang=safe($$key_lang);
					else $$key_lang=array_map('safe',$key_lang);
				}
			}
		}
	}
}
if(isset($datas_request) && is_array($datas_request)){
	foreach($datas_request as $key){
		if(isset($_REQUEST["$key"])){
			$$key=$_REQUEST["$key"];
			if(!is_array($$key)) $$key=safe($$key);
			else $$key=array_map('safe',$$key);
		}
		else{
			foreach($all_langs as $ln){
				$key_lang=$key.'_'.$ln;
				if(isset($_REQUEST["$key_lang"])){
					$$key_lang=$_REQUEST["$key_lang"];
					if(!is_array($$key_lang)) $$key_lang=safe($$key_lang);
					else $$key_lang=array_map('safe',$key_lang);
				}
			}
		}
	}
}

if($_FILES){
	if(!isset($imageFolder) || $imageFolder=='') $error='$imageFolder dəyişəni tanımlanmayıb. Zəhmət olmasa əlavə edin.';
	else{
		foreach($_FILES as $key=>$val){
			if(substr_($key,0,5)=='image'){
				$image_type='image';
				$errorText1="Şəkil seçmək mütləqdir.";
				$errorText2="Şəklin tipi uyğun deyil.";
			}
			elseif(substr_($key,0,8)=='document'){
				$image_type='document';
				$errorText1="Sənəd seçmək mütləqdir.";
				$errorText2="Sənədin tipi uyğun deyil.";
			}
			elseif(substr_($key,0,5)=='video'){
				$image_type='video';
				$errorText1="Video seçmək mütləqdir.";
				$errorText2="Video faylın tipi uyğun deyil.";
			}
			elseif(substr_($key,0,5)=='music'){
				$image_type='music';
				$errorText1="Musiqi faylını seçmək mütləqdir.";
				$errorText2="Musiqi faylının tipi uyğun deyil";
			}
			else{
				$image_type='other';
				$errorText1="Fayl seçmək mütləqdir.";
				$errorText2="Faylın tipi uyğun deyil.";
			}
				
			if(!is_array(end($val))){
				// single upload
				$$key=$_FILES[$key]["tmp_name"];
				$var_name=$key.'_name'; $$var_name=$_FILES[$key]["name"];
				
				if(isset($settings_inner) && $settings_inner["upload_important"]>0 && $$key=='' && $add>0) $error=$errorText1;
				elseif(!checkFileType($$var_name,$image_type)) $error=$errorText2;
			}
			else{
				// multi upload
				$count_f=0;
				foreach($_FILES[$key]["tmp_name"] as $check){
					if(isset($settings_inner) && $settings_inner["upload_important"]>0 && $check=='' && $add>0) $error=$errorText1;
					elseif(!checkFileType($_FILES[$key]["name"][$count_f],$image_type)) $error=$errorText2;
					$count_f++;
				}
			}
			
		}
	}
}
?>
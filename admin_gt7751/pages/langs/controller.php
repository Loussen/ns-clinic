<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";

if(isset($_GET["main_lang_change"])) $main_lang_change=intval($_GET["main_lang_change"]); else $main_lang_change=0;
if(isset($_GET["lang_edit"])) $lang_edit=intval($_GET["lang_edit"]); else $lang_edit=0;

if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$edit' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }

// For paginator
$query_count="select id from $do where id>0 ";

if($main_lang_change>0 && mysqli_num_rows(mysqli_query($db,"select id from langs where id='$main_lang_change' "))>0)
{
	mysqli_query($db,"update langs set status='0' ");
	mysqli_query($db,"update langs set status='1' where id='$main_lang_change' ");

	setFlash('ok','Esas dil dəyişdirildi.');
	header_("Location: ".addFullUrl(array('main_lang_change'=>0)));
}

if($_POST && $edit==0 && $add=1 && check_csrf_(safe($_POST["csrf_"]),$do) ) // Add
{
	$datas_post=array('name','full_name','flag');
	include "pages/__tools/check_post_datas.php";
	$name=strip_tags(strtolower_($name));
	$flag=explode("/",$flag);	$flag=end($flag);
	
	if($name=='') $error='Ad daxil edilməyib.';
	elseif(strlen($name)!=2) $error='Ad 2 simvoldan ibarət olmalıdır.';
	elseif(preg_match("/^[a-zA-Z]+$/", $name) != 1) $error='Ad düzgün daxil edilməyib.';
	elseif(mysqli_num_rows(mysqli_query($db,"select id from $do where name='$name' "))>0) $error='Bu dil artıq daxil edilib.';
	
	if($error==''){
		mysqli_query($db,"insert into $do (name,full_name,position,active,flag) values ('$name','$full_name','$position','$active','$flag') ");
		$new_insert=mysqli_insert_id($db);
		$hideForm='hide';
		mkdir('langs/'.$name,0777);
		copy('langs/'.$lang_name.'/lang.txt','langs/'.$name.'/lang.txt');
		
		// Butun databazaya bu dile aid columnlari elave edir
		$last_lang=mysqli_fetch_assoc(mysqli_query($db,"select name from $do where name!='$name' order by position desc limit 1"));	$last_lang=$last_lang["name"];
		$len_lang=strlen($last_lang)*-1;
		$sql=mysqli_query($db,"SHOW TABLES FROM ".db_name);
		while($row=mysqli_fetch_assoc($sql)){
			$tb=$row["Tables_in_".db_name];
			$query="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".db_name."' AND TABLE_NAME = '$tb' ";
			$sql2=mysqli_query($db,$query);
			while($row2=mysqli_fetch_assoc($sql2)){
				$column_name=$row2["COLUMN_NAME"];
				if(substr($column_name,$len_lang-1)=='_'.$last_lang){
					$clear_column=str_replace("_".$last_lang,"",$column_name);
					$old_coumn_name=$clear_column.'_'.$last_lang;
					$new_coumn_name=$clear_column.'_'.$name;
					
					if($clear_column=='name' || $clear_column=='question' || $clear_column=='answer') $type="VARCHAR( 255 )";
					elseif($clear_column=='text' || $clear_column=='short_text' || $clear_column=='full_text') $type="TEXT";
					else $type="VARCHAR( 255 )";
					
					$query_alter="ALTER TABLE $tb ADD $new_coumn_name $type NOT NULL after $old_coumn_name ";
					$res=mysqli_query($db,$query_alter);
					if(!$res){
						header_("Location: index.php?do=langs&delete=".$new_insert);
						break;
					}
				}
			}
		}
		
		setFlash('ok','Məlumatlar uğurla yadda saxlanıldı.');
		header_("Location: ".addFullUrl());
	}
}
elseif($edit>0 && $lang_edit==0 && $_POST && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('full_name','flag');
	include "pages/__tools/check_post_datas.php";

	$flag=explode("/",$flag);	$flag=end($flag);
	
	if($full_name=='') $error='Tam ad daxil edilməyib.';
	elseif(preg_match("/^[a-zA-Z]+$/", $full_name) != 1) $error='Tam ad düzgün daxil edilməyib.';
	if($error==''){

		mysqli_query($db,"update $do set full_name='$full_name',flag='$flag' where id='$edit'");
		$hideForm='hide';
		
		setFlash('ok','Məlumatlar uğurla yadda saxlanıldı.');
		header_("Location: ".addFullUrl());
	}
}
elseif($delete>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$delete' "))>0)
{
	$info=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$delete' "));
	if(in_array('important',$get_table_name_columns) && $info["important"]==1) $error="Bu məlumatı silmək olmaz.";
	elseif(mysqli_num_rows(mysqli_query($db,"select id from $do"))==1) $error="Sonuncu dili silmək olmaz.";
	else
	{
		$info_deleted=mysqli_fetch_assoc(mysqli_query($db,"select name from $do where id='$delete' "));
		mysqli_query($db,"delete from $do where id='$delete' ");
		include "pages/__tools/reposition.php";
		if(mysqli_num_rows(mysqli_query($db,"select id from $do where status=0"))==0) mysqli_query($db,"update $do set status=1 order by position limit 1 ");
		unlink('langs/'.$info_deleted["name"].'/lang.txt');	rmdir('langs/'.$info_deleted["name"]);
		
		// Butun databazadan bu dile aid columnlari silir
		$len_lang=strlen($lang_name)*-1;
		$sql=mysqli_query($db,"SHOW TABLES FROM ".db_name);
		while($row=mysqli_fetch_assoc($sql)){
			$tb=$row["Tables_in_".db_name];
			$query="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".db_name."' AND TABLE_NAME = '$tb' ";
			$sql2=mysqli_query($db,$query);
			while($row2=mysqli_fetch_assoc($sql2)){
				$column_name=$row2["COLUMN_NAME"];
				if(substr($column_name,$len_lang-1)=='_'.$lang_name){
					$clear_column=str_replace("_".$lang_name,"",$column_name);
					$deleted_column=$clear_column.'_'.$info_deleted["name"];
					$query_alter="ALTER TABLE $tb DROP $deleted_column";
					mysqli_query($db,$query_alter);
				}
			}
		}
		//
		
		setFlash('ok','Məlumat silindi.');
		header_("Location: ".addFullUrl());
	}
}
elseif($edit>0 && $lang_edit>0 && $_POST && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$words=$_POST["lang_edit"];
	foreach($words as $key=>$val){
		if(is_array($key)) $words[$key]='';
		if($words[$key]=='') unset($words[$key]);
	}
	$words=json_encode($words);
	
	$info_lang=mysqli_fetch_assoc(mysqli_query($db,"select name from $do where id='$edit' "));
	$open=fopen('langs/'.$info_lang["name"].'/lang.txt','w+');
	fwrite($open,$words);
	fclose($open);
	
	$ok="Məlumatlar yadda saxlanıldı.";
	$hideForm='hide';
}

include "pages/__tools/position_changer.php";

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$edit' "));
?>
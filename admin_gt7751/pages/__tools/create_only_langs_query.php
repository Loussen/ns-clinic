<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

if(isset($datas_depends_on_langs) && is_array($datas_depends_on_langs) && count($datas_depends_on_langs)>0){
	$query_update='';	$query_insert='';	$query_insert_val='';
	if(!isset($not_update)) $not_update=array();
	foreach($all_langs as $lang_Nm){
		foreach($datas_depends_on_langs as $key){
			if(!in_array($key,$not_update)){
				if(substr_($key,0,5)!='image' && substr_($key,0,5)!='video' && substr_($key,0,5)!='music' && substr_($key,0,5)!='other' && substr_($key,0,8)!='document'){
					$column=$key."_".$lang_Nm;
					$val=safe($$column);
					$query_update.="$column='$val', ";
					$query_insert.=$column.', ';
					$query_insert_val.="'$val', ";
				}
			}
		}
	}
	$query_update=substr($query_update,0,-2);
	$query_insert=substr($query_insert,0,-2);
	$query_insert_val=substr($query_insert_val,0,-2);
}
else{
	$query_update="id=id";
	$query_insert='id';
	$query_insert_val="''";
}
?>
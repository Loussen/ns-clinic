<?php
// now not using.  now using create_only_lang_query.php

if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

$query_update_='';	$query_insert_='';	$query_insert_val_='';

// Update query
if($langs_have && isset($datas_depends_on_langs) && is_array($datas_depends_on_langs) && count($datas_depends_on_langs)>0){
	$sql=mysqli_query($db,"select name from langs order by position");
	
	while($row=mysqli_fetch_assoc($sql)){
		foreach($datas_depends_on_langs as $key){
			if(substr_($key,0,5)!='image' && substr_($key,0,5)!='video' && substr_($key,0,5)!='music' && substr_($key,0,5)!='other' && substr_($key,0,8)!='document'){
				$column=$var."_".$row["name"];
				$val=safe($$column);
				$query_update_.="$column='$val', ";
				$query_insert_.=$column.', ';
				$query_insert_val_.="'$val', ";
			}
		}
	}
	$query_update_=substr_($query_update_,0,-2);
	$query_insert_=substr_($query_insert_,0,-2);
	$query_insert_val_=substr_($query_insert_val_,0,-2);
}

$query_update="update $do set $query_update_";
if(isset($datas_which_update) && is_array($datas_which_update) && count($datas_which_update) ){
	if($query_update_!='') $query_update.=', ';
	foreach($datas_which_update as $key){
		$val=safe($$key);
		$query_update.="$key='$val', ";
	}
	$query_update=substr_($query_update,0,-2);
}
if($edit>0) $query_update.=" where id='$edit' ";


// Insert query
$query_insert="insert into $do (";
if(isset($datas_which_insert) && is_array($datas_which_insert) && count($datas_which_insert) ){
	$query_insert_val='';
	foreach($datas_which_insert as $key){
		$query_insert.="$key, ";
		$val=safe($$key);
		$query_insert_val.="'$val', ";
	}
	if($query_insert_!='') $query_insert.="$query_insert_";
	else $query_insert=substr_($query_insert,0,-2);
	$query_insert.=") values (".$query_insert_val;
	
	
	if($query_insert_val_!='') $query_insert.="$query_insert_val_";
	else $query_insert=substr_($query_insert,0,-2);
	$query_insert.=")";
}
?>
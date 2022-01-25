<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

// Check this table depends on langs and collect 
$len_lang=strlen($lang_name)*-1;
$langs_have=false;

$datas_depends_on_langs=array();
$get_table_name_columns=array();

if($do!='' && in_array($do,$all_tables) ){
	$datas_depends_on_langs=array();
	$get_table_name_columns=array();
	$sql=mysqli_query($db,"SHOW COLUMNS FROM $do ");
	while($row=mysqli_fetch_assoc($sql)){
		$column_name=$row["Field"];
		$get_table_name_columns[]=$column_name;
		if(substr($column_name,$len_lang-1)=='_'.$lang_name) $langs_have=true;
		
		if(intval(strpos($column_name,"_"))>0){
			foreach($all_langs as $c_lang){
				if(substr($column_name,(strlen($c_lang)*-1)-1)=='_'.$c_lang){
					$clear_column=str_replace("_".$c_lang,"",$column_name);
					if(!in_array($clear_column,$datas_depends_on_langs)) $datas_depends_on_langs[]=$clear_column;
				}
			}
		}
	}
}

if(mysqli_num_rows(mysqli_query($db,"select id from settings_inner where table_name='$do' "))==0 && $do!=''){
	if(in_array('parent_id',$get_table_name_columns)){
		$parent_id_available=1;
		$position_depends_parent_id=1;
	}
	else{
		$parent_id_available=0;
		$position_depends_parent_id=0;
	}
	if(in_array('position',$get_table_name_columns)) $position_available=1; else $position_available=0;
	if(in_array('active',$get_table_name_columns)) $active_available=1; else $active_available=0;
	if(in_array('category_id',$get_table_name_columns)) $category_available=1; else $category_available=0;
	$multiselect_available=0;
	$edit_available=1;
	$delete_available=1;
	$show_per_page_available=1;
	$print_available=1;
	$add_new_available=1;
	$paginator_available=1;
	$show_datacount=1;
	
	mysqli_query($db,"insert into settings_inner (
		table_name,
		parent_id_available,
		position_available,
		position_depends_parent_id,
		multiselect_available,
		active_available,
		edit_available,
		delete_available,
		show_per_page_available,
		print_available,
		add_new_available,
		paginator_available,
		category_available,
		show_datacount
		)
		values(
		'$do',
		'$parent_id_available',
		'$position_available',
		'$position_depends_parent_id',
		'$multiselect_available',
		'$active_available',
		'$edit_available',
		'$delete_available',
		'$show_per_page_available',
		'$print_available',
		'$add_new_available',
		'$paginator_available',
		'$category_available',
		'$show_datacount'
		
		) ");
}

$settings_inner=mysqli_fetch_assoc(mysqli_query($db,"select * from settings_inner where table_name='$do' "));
?>
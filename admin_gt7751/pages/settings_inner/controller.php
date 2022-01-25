<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";
if(isset($_GET["get_table_name"])) $get_table_name=safe($_GET["get_table_name"]); else $get_table_name='about';

$get_table_name_columns=array();
if($get_table_name!='' && in_array($get_table_name,$all_tables) ){
	$sql=mysqli_query($db,"SHOW COLUMNS FROM $get_table_name ");
	while($row=mysqli_fetch_assoc($sql)){
		$column_name=$row["Field"];
		$get_table_name_columns[]=$column_name;
	}
}

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('parent_id_available','position_available','position_desc','position_depends_parent_id','multiselect_available','active_available','edit_available','delete_available', 
	'show_per_page_available','print_available','add_new_available','paginator_available','category_available','upload_important','show_datacount');
	include "pages/__tools/check_post_datas.php";
	
	include "pages/__tools/create_only_langs_query.php";
	
	if(!isset($_POST["parent_id_available"])) $parent_id_available=0;
	if(!isset($_POST["position_available"])) $position_available=0;
	if(!isset($_POST["position_desc"])) $position_desc=0;
	if(!isset($_POST["position_depends_parent_id"])) $position_depends_parent_id=0;
	if(!isset($_POST["multiselect_available"])) $multiselect_available=0;
	if(!isset($_POST["active_available"])) $active_available=0;
	if(!isset($_POST["edit_available"])) $edit_available=0;
	if(!isset($_POST["delete_available"])) $delete_available=0;
	if(!isset($_POST["show_per_page_available"])) $show_per_page_available=0;
	if(!isset($_POST["print_available"])) $print_available=0;
	if(!isset($_POST["add_new_available"])) $add_new_available=0;
	if(!isset($_POST["paginator_available"])) $paginator_available=0;
	if(!isset($_POST["category_available"])) $category_available=0;
	if(!isset($_POST["upload_important"])) $upload_important=0;
	if(!isset($_POST["show_datacount"])) $show_datacount=0;
	
	if($error==''){
		mysqli_query($db,"update $do set 
		parent_id_available='$parent_id_available',
		position_available='$position_available',
		position_desc='$position_desc',
		position_depends_parent_id='$position_depends_parent_id',
		multiselect_available='$multiselect_available',
		active_available='$active_available',
		edit_available='$edit_available',
		delete_available='$delete_available',
		show_per_page_available='$show_per_page_available',
		print_available='$print_available',
		add_new_available='$add_new_available',
		paginator_available='$paginator_available',
		upload_important='$upload_important',
		show_datacount='$show_datacount',
		category_available='$category_available'
		
		where table_name='$get_table_name'
		");
		
		setFlash('ok','Məlumatlar uğurla yadda saxlanıldı.');
		header_("Location: ".addFullUrl());
	}
}

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where table_name='$get_table_name' "));
?>
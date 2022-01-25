<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

// get default params
if(isset($_GET["edit"]) && $settings_inner["edit_available"]>0) $edit=intval($_GET["edit"]); else $edit=0;
if(isset($_GET["add"]) && $settings_inner["add_new_available"]>0 ) $add=intval($_GET["add"]); else $add=0;
if(isset($_GET["delete"]) && $settings_inner["delete_available"]>0 ) $delete=intval($_GET["delete"]); else $delete=0;
	if(isset($checkbox_delete) && $checkbox_delete>0) $delete=$checkbox_delete;
if(isset($_GET["delete_file"]) && $settings_inner["delete_available"]>0) $delete_file=intval($_GET["delete_file"]); else $delete_file=0;
if(isset($_GET["up"]) && $settings_inner["position_available"]>0 && in_array('position',$get_table_name_columns) ) $up=intval($_GET["up"]); else $up=0;
if(isset($_GET["down"]) && $settings_inner["position_available"]>0 && in_array('position',$get_table_name_columns) ) $down=intval($_GET["down"]); else $down=0;
if(isset($_GET["fix_position"])) $fix_position=intval($_GET["fix_position"]); else $fix_position=0;
if(isset($_GET["parent_id"])) $parent_id=intval($_GET["parent_id"]); else $parent_id=0;
if(isset($_GET["category_id"])) $category_id=intval($_GET["category_id"]); else $category_id=0;
if(isset($_GET["view"])) $view=intval($_GET["view"]); else $view=0;

// check some situations
if($edit>0) $add=0;
if($edit==0 && $add==0 && $view==0) $hideForm='hide'; else $hideForm='';

// For after submit
$error=''; $ok='';

// create some variables
if( $settings_inner["position_available"]>0 && in_array('position',$get_table_name_columns) ){
	$orderBy='order by position ';
	if($settings_inner["position_desc"]>0) $orderBy.=' desc';
	$addQ='';
	if(isset($addPositionQuery) && $addPositionQuery!='' ) $addQ=$addPositionQuery;
	if($settings_inner["position_depends_parent_id"]>0 && in_array('parent_id',$get_table_name_columns) && isset($_REQUEST['parent_id']) ) $addQ.=" and parent_id='".intval($_REQUEST['parent_id'])."' ";
	$position=mysqli_fetch_assoc(mysqli_query($db,"select position from $do where id>0 $addQ order by position desc")); $position=intval($position["position"])+1;
}
elseif(in_array('datetime',$get_table_name_columns)) $orderBy='order by datetime desc';
else $orderBy='order by id desc';

// For if datas =='' or !='' in the anywhere (only depends on langs)
$Name='name_'.$lang_name;

if(isset($_POST["csrf_"]) && isset($_POST["submit_insert_update"]) && !check_csrf_(safe($_POST["csrf_"]),$do) ){
	$add=0; $edit=0; $hideForm='hide';
}

if($get_settings["admin_with_role"]==1){
	if( ( (!isset($permissions->$do->add) || $permissions->$do->add==0) and $user["role_id"]!=1 ) && $add>0) { $add=0; $hideForm='hide'; }
	if( ( (!isset($permissions->$do->edit) || $permissions->$do->edit==0) and $user["role_id"]!=1 ) && $edit>0) { $edit=0; $hideForm='hide'; }
	if( ( (!isset($permissions->$do->delete) || $permissions->$do->delete==0) and $user["role_id"]!=1 ) && $delete>0) $delete=0;
	if( ( (!isset($permissions->$do->active) || $permissions->$do->active==0) and $user["role_id"]!=1 ) ) { $up=0; $down=0; }
}

if($edit>0 || $view>0){
	if(in_array('seen_by_admin',$get_table_name_columns)){
		if($edit>0) mysqli_query($db,"update $do set seen_by_admin='$user[id]' where id='$edit' ");
		elseif($view>0) mysqli_query($db,"update $do set seen_by_admin='$user[id]' where id='$view' ");
	}
}
?>
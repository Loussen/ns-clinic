<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

include "pages/__tools/delete_uploaded_file.php";

// Change position
if($settings_inner["position_available"]>0 && in_array('position',$get_table_name_columns) ){
	if($fix_position>0){
		include "pages/__tools/reposition.php";
		$location=addFullUrl(array('fix_position'=>0));
		header("Location: $location");
		exit(); die();
	}
	
	//if(isset($addPositionQuery) && $addPositionQuery!='' ) $addQ=$addPositionQuery; else $addQ='';
	$addQ="";
	if($up>0){
		if($settings_inner["position_depends_parent_id"]>0 && in_array('parent_id',$get_table_name_columns) ){
			$parent_info=mysqli_fetch_assoc(mysqli_query($db,"select parent_id from $do where id='$up' "));
			if($parent_info["parent_id"]>0) $addQ=" and parent_id='$parent_info[parent_id]' ";
		}
	}
	elseif($down>0){
		if($settings_inner["position_depends_parent_id"]>0 && in_array('parent_id',$get_table_name_columns) ){
			$parent_info=mysqli_fetch_assoc(mysqli_query($db,"select parent_id from $do where id='$down' "));
			if($parent_info["parent_id"]>0) $addQ=" and parent_id='$parent_info[parent_id]' ";
		}
	}
	
	if($up>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$up' $addQ "))>0)
	{
		$current_pos=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$up' $addQ ")); $current_pos=$current_pos["position"];
		if($current_pos>1)
		{
			$down_pos=$current_pos-1;
			mysqli_query($db,"update $do set position='-1' where position='$down_pos' $addQ ");
			mysqli_query($db,"update $do set position='$down_pos' where position='$current_pos' $addQ ");
			mysqli_query($db,"update $do set position='$current_pos' where position='-1' $addQ ");
		}
	}
	elseif($down>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$down' $addQ "))>0)
	{
		$current_pos=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$down' $addQ ")); $current_pos=$current_pos["position"];
		$last_pos=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id>0 $addQ order by position desc")); $last_pos=$last_pos["position"];
		if($current_pos<$last_pos)
		{
			$up_pos=$current_pos+1;
			mysqli_query($db,"update $do set position='-1' where position='$up_pos' $addQ ");
			mysqli_query($db,"update $do set position='$up_pos' where position='$current_pos' $addQ ");
			mysqli_query($db,"update $do set position='$current_pos' where position='-1' $addQ ");
		}
	}
	
	if($up>0 || $down>0){
		$location=addFullUrl(array('up'=>0,'down'=>0));
		header("Location: $location");
		exit(); die();
	}
}
?>
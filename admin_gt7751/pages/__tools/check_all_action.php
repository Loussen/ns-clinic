<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

if(isset($_GET["checkboxes"])){
	$checkboxes=safe($_GET["checkboxes"]);
		$checkboxes=substr($checkboxes,1,-1);
		$checkboxes=str_replace("-",",",$checkboxes);
	
	if(isset($_GET["checkbox_del"])) $checkbox_del=intval($_GET["checkbox_del"]); else $checkbox_del=0;
	if(isset($_GET["active"])) $active=intval($_GET["active"]); else $active=0;
	if($checkbox_del==1){
		$checkboxes=explode(",",$checkboxes);
		foreach($checkboxes as $checkbox_delete){
			include "pages/$do/controller.php";
		}
	}
	elseif($active>0){
		if($active==2) $active=0; else $active=1;
		mysqli_query($db,"update $do set active='$active' where id in (".forSqlIn($checkboxes).") ");
	}
	$current_link=remove_qs_key($current_link,'checkboxes');
	$current_link=remove_qs_key($current_link,'active');
	$current_link=remove_qs_key($current_link,'checkbox_del');
	
	header("Location: $current_link"); exit();
}
?>
<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";
if($view>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$view' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }

// For paginator
$query_count="select id from $do where id>0 ";

if($delete>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$delete' "))>0)
{
	mysqli_query($db,"delete from $do where id='$delete' ");
	$ok="Məlumat silindi.";
	include "pages/__tools/reposition.php";
}
include "pages/__tools/position_changer.php";

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$view' "));

$appointment_table = $information['appointment_type'] == 1 ? 'doctors' : 'services';

$row_check = mysqli_fetch_assoc(mysqli_query($db,"select name_az as name from ".$appointment_table." WHERE id = ".$information['checkup_id']));
?>
<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) && $settings_inner["edit_available"]>0 )
{
	$datas_post=array('description','keywords','title');
	include "pages/__tools/check_post_datas.php";

	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		
		mysqli_query($db,"update $do set $query_update ");
		$ok="Məlumatlar uğurla yadda saxlanıldı.";
	}
}

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do"));
?>
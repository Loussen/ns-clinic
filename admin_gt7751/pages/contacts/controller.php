<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";

if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) && $settings_inner["edit_available"]>0 )
{
	$datas_post=array('text','footer','email','facebook','twitter','google','youtube','instagram','mobile','skype','fax','phone','google_map','vkontakte','linkedin','digg','flickr','dribbble','vimeo','myspace','opening_hours');
	include "pages/__tools/check_post_datas.php";
	
	if($error==''){
		include "pages/__tools/create_only_langs_query.php";
		
		mysqli_query($db,"update $do set $query_update, email='$email',facebook='$facebook',twitter='$twitter', vkontakte='$vkontakte',linkedin='$linkedin',digg='$digg',flickr='$flickr', dribbble='$dribbble', vimeo='$vimeo',myspace='$myspace',google='$google',  youtube='$youtube', instagram='$instagram', phone='$phone', mobile='$mobile', skype='$skype', fax='$fax',google_map='$google_map' ");

		$ok="Məlumatlar uğurla yadda saxlanıldı.";
	}
}
$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do"));
?>
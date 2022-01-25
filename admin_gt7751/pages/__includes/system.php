<?php
include 'connect_db.php';
$config_included=true;
$current_link = 'index.php?'.parse_url($_SERVER['QUERY_STRING'], PHP_URL_PATH);

// Lang file include
if(is_file($admin_folder.'/langs/index.php')) include $admin_folder.'/langs/index.php';
if($get_settings["include_site_langs"]>0){
	if(is_file('langs/index.php')) include 'langs/index.php';
	elseif(is_file('../langs/index.php')) include '../langs/index.php';
}
else{
	if(is_file('langs/admin/index.php')) include 'langs/admin/index.php';
	elseif(is_file('../langs/admin/index.php')) include '../langs/admin/index.php';
}

// Current Lang
$lang_info=mysqli_fetch_assoc(mysqli_query($db,"select full_name from langs where name='$lang_name' "));

// Static update
if($get_settings["currency"]>0 || $get_settings["namaz"]>0 || $get_settings["wheather"]>0) include 'static_update.php';

$all_tables=array();
$sql=mysqli_query($db,"SHOW TABLES FROM ".db_name);
while($row=mysqli_fetch_assoc($sql)){
	$all_tables[]=$row["Tables_in_".db_name];
}
$info_home_page=mysqli_fetch_assoc(mysqli_query($db,"select * from home_page "));
$js=''; $css='';
?>
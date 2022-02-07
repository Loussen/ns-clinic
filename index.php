<?php

$start=microtime(true);

require_once "admin_gt7751/pages/__includes/config.php";

//if($_GET['admin'] != 'true') {
//	exit;
//}

if(!isset($_GET["get_lang_name"])){
	$actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	$new=str_replace($site,$site.'/az',$actual_link);
	$new=str_replace('www.','',$new);
	header("Location: $new");
	exit;
}

if(isset($_GET["do"])) $do=safe($_GET["do"]); else $do='home';
$do=str_replace("../","",$do); $do=str_replace("./","",$do);
if(!is_file("includes/pages/".$do.".php")) $do='home';
$info_home_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='home' and active=1"));
$info_contacts=mysqli_fetch_assoc(mysqli_query($db,"select * from contacts"));
$info_description=mysqli_fetch_assoc(mysqli_query($db,"select * from description"));
$info_about=mysqli_fetch_assoc(mysqli_query($db,"select * from about"));
$info_home_page=mysqli_fetch_assoc(mysqli_query($db,"select * from home_page"));
$Name='name_'.$lang_name;
require_once "includes/controller.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once "includes/head.php"; ?>
</head>
<body>

	<!--====== Start Preloader ======-->
	<div id="preloader">
		<div id="loading-center">
			<div id="object"></div>
		</div>
	</div>
	<!--====== End Preloader ======-->

    <?php require_once "includes/top.php" ?>

    <?php require_once "includes/pages/".$do.".php"; ?>

    <?php require_once "includes/footer.php" ?>

	<?php require_once "includes/js.php"; ?>

	<?php
	if(isFlash('errorMsg')) $errorMsg=getFlash('errorMsg');
	if(isFlash('successMsg')) $successMsg=getFlash('successMsg');
	if(isFlash('infoMsg')) $infoMsg=getFlash('infoMsg');

	if($errorMsg!='') $runJs.="<script>getAlert('error','Uğursuz nəticə','".$errorMsg."');</script>";
	if($successMsg!='') $runJs.="<script>getAlert('success','".$lang65."','".$successMsg."');</script>";
	if($infoMsg!='') $runJs.="<script>getAlert('info','İnformasiya','".$infoMsg."');</script>";
	if(isset($runJs)) echo $runJs;
	?>
	<input type="hidden" value="<?=SITE_PATH?>" id="baseurl" />

</body>
</html>

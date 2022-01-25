<?php
$SCT=microtime(true);	$ECT=array();
require_once "pages/__includes/config.php";
if($do=='logout'){header("Location: logout.php"); exit();}
if(!is_file("pages/".$do."/view.php")) $do=$default_page;

// Works for langs
$lang_name='az';	// admins data's lang

require_once "pages/__includes/settings_inner.php";
require_once "pages/__includes/resize_class.php";
require_once "pages/__tools/check_all_action.php";	//check all and delete or deactive or active

// pagination default variables
if(isset($_GET["limit"])) $limit=intval($_GET["limit"]); else $limit=0;
if($limit!=15 && $limit!=25 && $limit!=50 && $limit!=100 && $limit!=999999) $limit=25;
if(isset($_GET["page"])) $page=intval($_GET["page"]); else $page=1;
if($page<1) $page=1;
$start=$page*$limit-$limit;
if($settings_inner["paginator_available"]==0){ $start=0; $limit=999999; $settings_inner["show_per_page_available"]=0; }

$mainSection='Admin';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html> 
<head><?php require_once "pages/__layouts/head.php"; ?></head>
<body class="fix-sidebar <?php if($_SESSION["menu_minimize"]) echo 'content-wrapper'; ?>">
    <div id="wrapper">
        <?php require_once "pages/__layouts/top.php"; ?>
        <?php require_once "pages/__layouts/menu.php"; ?>
        <div id="page-wrapper">
			<?php require_once "pages/".$do."/view.php"; ?>
            <?php require_once "pages/__layouts/footer.php"; ?>
        </div>
    </div>

	<input type="hidden" id="link_url" value="-" />
	<input type="hidden" value="0" id="all_check_changed" />
	<input type="hidden" value="<?php echo $current_link?>" id="current_link" />
	<input type="hidden" value="<?php echo $site?>" id="baseurl" />
	<input type="hidden" value="<?php echo $site.'/'.$admin_folder?>" id="baseurl_admin" />

	<input type="hidden" id="delete_text1" value="Silinəcək məlumat"/>
	<input type="hidden" id="delete_text2" value="Əminsinizmi silməyə?"/>
	<input type="hidden" id="for_js_text1" value="Xəta baş verdi"/>
	<input type="hidden" id="for_js_text2" value="Bu məlumatı silmək olmaz."/>
	<input type="hidden" id="menu_minimize" value="<?php echo decode_text($_SESSION["menu_minimize"])?>"/>
	<?php require_once "pages/__layouts/js.php"; ?>
</body>
</html>
<?php
if(isset($_GET["calcLoadTime"]) || isset($_SESSION["calcLoadTime"]) ) { echo calcLoadTime(); $_SESSION["calcLoadTime"]=true; }
elseif(isset($_GET["calcLoadTimeAll"]) || isset($_SESSION["calcLoadTimeAll"]) ) { echo calcLoadTimeAll(); $_SESSION["calcLoadTimeAll"]=true; }
if(isset($_GET["calcLoadTimeOff"]) || isset($_GET["calcLoadTimeAll"]) ) unset($_SESSION["calcLoadTime"]);
if(isset($_GET["calcLoadTimeAllOff"]) || isset($_GET["calcLoadTime"]) ) unset($_SESSION["calcLoadTimeAll"]);
?>

<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>
<nav class="navbar navbar-default navbar-static-top m-b-0">
	<div class="navbar-header">
		<a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
		<div class="top-left-part">
			<?php
			if($user_programs && $company_info["name"]!='') $admin_name=nl2br(decode_text($company_info["name"]));
			else $admin_name=nl2br(decode_text($get_settings["admin_name"]));
			?>
			<div class="admin_name <?php if($_SESSION["menu_minimize"]) echo 'hide'; ?>">
				<a class="logo" href="index.php" style="color: #000;text-align:center;">
					<label class="logo_label"><?php echo $admin_name; ?></label>
				</a>
			</div>
			
			<a class="logo small_logo" href="index.php" <?php if(!$_SESSION["menu_minimize"]) echo 'style="display:none;"'; ?>>
				<b>
				<?php
				if($user_programs && $company_info["image_logo"]!='') $img=SITE_PATH.'/'.$admin_folder.'/assets/plugins/images/companies/'.$company_info["id"].'/'.$company_info["image_logo"];
				else $img=SITE_PATH.'/'.$admin_folder.'/assets/plugins/images/logo/'.$get_settings["image_logo"];
				?>
					<img src="<?php echo $img;?>" alt="user-img" class="light-logo" style="width:40px;height:40px;">
				</b>
			</a>
		</div>
		<ul class="nav navbar-top-links navbar-left hidden-xs">
			<li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
		</ul>
		<div class="me_nav_text">
			<div class="pull-right font-weight-bold logout_div">
				<b><?php echo ucfirst($user["login"])?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="index.php?do=logout" style="color:#fff;"><i class="icon-logout"></i> Çıxış</a>
			</div>
		</div>
	</div>
</nav>
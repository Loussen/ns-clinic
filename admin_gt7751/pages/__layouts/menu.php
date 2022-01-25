<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse slimscrollsidebar">
		<?php
		$count_letters=mysqli_num_rows(mysqli_query($db,"select id from letters where seen_by_admin='0' "));
		$count_appointment=mysqli_num_rows(mysqli_query($db,"select id from appointment_users where seen_by_admin='0' "));
		if($count_letters>0) $letters_new='<span class="label label-rouded label-danger pull-right">'.$count_letters.'</span>'; else $letters_new='';
        if($count_appointment>0) $appointment_new='<span class="label label-rouded label-danger pull-right">'.$count_appointment.'</span>'; else $appointment_new='';
	
		$count_comments=mysqli_num_rows(mysqli_query($db,"select id from comments where seen_by_admin='0' "));
		if($count_comments>0) $comments_new='<span class="label label-rouded label-danger pull-right">'.$count_comments.'</span>'; else $comments_new='';
		
		if($_SESSION["menu_minimize"]) $addStyle='style="display:none;"'; else $addStyle='';
		
		echo $left_menu_html='
		<div class="user-profile" '.$addStyle.'>
			<div class="dropdown user-pro-body">
				<div><img src="'.SITE_PATH.'/'.$admin_folder.'/assets/plugins/images/logo/'.decode_text($get_settings["image_logo"]).'" alt="user-img" class="w100"></div>
				<a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					'.decode_text(ucfirst($user["login"])).' <span class="caret"></span>
				</a>
				<ul class="dropdown-menu animated flipInY">
					<li><a href="index.php?do='.$default_page.'"><i class="ti-home"></i> Əsas səhifə</a></li>
					<li><a href="index.php?do=admins"><i class="ti-lock"></i> Administrasiya</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="index.php?do=logout"><i class="fa fa-power-off"></i> Çıxış</a></li>
				</ul>
			</div>
		</div>
		
		<ul class="nav second_menu" id="side-menu">
			<li><a href="index.php?do=home_page" class="waves-effect"><i class="fa fa-home fa-lg"></i> <span class="hide-menu">Ana səhifə</span></a></li>
			<li><a href="index.php?do=description" class="waves-effect"><i class="fa fa-list-alt fa-lg"></i> <span class="hide-menu">Description</span></a></li>
			<li><a href="index.php?do=menus" class="waves-effect"><i class="fa fa-navicon fa-lg"></i> <span class="hide-menu">Menyular</span></a></li>
			<li><a href="index.php?do=about" class="waves-effect"><i class="fa fa-newspaper-o fa-lg"></i> <span class="hide-menu">Haqqımızda</span></a></li>
			<li><a href="index.php?do=departments" class="waves-effect"><i class="fa fa-building fa-lg"></i> <span class="hide-menu">Departamentlər</span></a></li>
			<li><a href="index.php?do=doctors" class="waves-effect"><i class="fa fa-users fa-lg"></i> <span class="hide-menu">Həkimlər</span></a></li>
			<li><a href="index.php?do=photo_albums" class="waves-effect"><i class="fa fa-file-image-o fa-lg"></i> <span class="hide-menu">Fotoqalereya</span></a></li>
			<li><a href="index.php?do=videogallery" class="waves-effect"><i class="fa fa-file-video-o fa-lg"></i> <span class="hide-menu">Videoqalereya</span></a></li>
			<li><a href="index.php?do=patients" class="waves-effect"><i class="fa fa-users fa-lg"></i> <span class="hide-menu">Pasiyentlər (Video FB)</span></a></li>
			<li><a href="index.php?do=faq" class="waves-effect"><i class="fa fa-headphones fa-lg"></i> <span class="hide-menu">FAQ</span></a></li>
			<li><a href="index.php?do=sliders" class="waves-effect"><i class="fa fa-sliders fa-lg"></i> <span class="hide-menu">Slider</span></a></li>
			<li><a href="index.php?do=contacts" class="waves-effect"><i class="fa fa-mobile fa-lg"></i> <span class="hide-menu">Əlaqə</span></a></li>
			<li><a href="index.php?do=partners" class="waves-effect"><i class="fa fa-slideshare fa-lg"></i> <span class="hide-menu">Partnyorlar</span></a></li>
			<li><a href="index.php?do=services" class="waves-effect"><i class="fa fa-stack-exchange fa-lg"></i> <span class="hide-menu">Xidmətlərimiz</span></a></li>
			<li><a href="index.php?do=methods" class="waves-effect"><i class="fa fa-newspaper-o fa-lg"></i> <span class="hide-menu">Metodlar</span></a></li>
			<li><a href="index.php?do=appointment" class="waves-effect"><i class="fa fa-newspaper-o fa-lg"></i> <span class="hide-menu">Müayinə (Kontent)</span></a></li>
			<li><a href="index.php?do=appointment_users"><i class="fa fa-envelope-o fa-lg"></i> <span class="hide-menu">Müayinə yazılanlar '.$appointment_new.'</span></a></li>
			<li><a href="index.php?do=news" class="waves-effect"><i class="fa fa-newspaper-o fa-lg"></i> <span class="hide-menu">Xəbərlər</span></a></li>
			<li><a href="index.php?do=letters"><i class="fa fa-envelope-o fa-lg"></i> <span class="hide-menu">Məktublar '.$letters_new.'</span></a></li>
			<li><a href="index.php?do=admin_roles"><i class="fa fa-user fa-lg"></i> <span class="hide-menu">Admin vəzifələri</span></a></li>
			<li><a href="index.php?do=admins"><i class="fa fa-user fa-lg"></i> <span class="hide-menu">Administrasiya</span></a></li>
			<li><a href="index.php?do=langs"><i class="fa fa-language fa-lg"></i> <span class="hide-menu">Dillər</span></a></li>
			<li><a href="index.php?do=settings_inner"><i class="fa fa-wrench fa-lg"></i> <span class="hide-menu">Tənzimləmələr</span></a></li>
			<li><a href="index.php?do=logout"><i class="fa fa-sign-out fa-lg"></i> <span class="hide-menu">Çıxış</span></a></li>
		</ul>

		';
		?>
	</div>
</div>

<?php
/*
<li class="hide"><a href="index.php?do=employees" class="waves-effect"><i class="fa fa-users fa-lg"></i> <span class="hide-menu">Testominals</span></a></li>
<li><a href="index.php?do=subscribers" class="waves-effect"><i class="fa fa-envelope-o fa-lg"></i> <span class="hide-menu">Abunələrə məktub</span></a></li>
<li><a href="index.php?do=faq_categories" class="waves-effect"><i class="fa fa-headphones fa-lg"></i> <span class="hide-menu">FAQ kateqoriya</span></a></li>
<li><a href="index.php?do=faq" class="waves-effect"><i class="fa fa-headphones fa-lg"></i> <span class="hide-menu">FAQ</span></a></li>
<li><a href="index.php?do=about" class="waves-effect"><i class="fa fa-newspaper-o fa-lg"></i> <span class="hide-menu">Haqqımızda</span></a></li>
<li><a href="index.php?do=photo_albums" class="waves-effect"><i class="fa fa-file-image-o fa-lg"></i> <span class="hide-menu">Fotoqalereya</span></a></li>
<li><a href="index.php?do=videogallery" class="waves-effect"><i class="fa fa-file-video-o fa-lg"></i> <span class="hide-menu">Videoqalereya</span></a></li>
<li><a href="index.php?do=sliders" class="waves-effect"><i class="fa fa-sliders fa-lg"></i> <span class="hide-menu">Slider</span></a></li>
<li><a href="index.php?do=banners" class="waves-effect"><i class="fa fa-trello fa-lg"></i> <span class="hide-menu">Bannerlər</span></a></li>
<li><a href="index.php?do=partners" class="waves-effect"><i class="fa fa-slideshare fa-lg"></i> <span class="hide-menu">Partnyorlar</span></a></li>
<li><a href="index.php?do=links" class="waves-effect"><i class="fa fa-external-link fa-lg"></i> <span class="hide-menu">Linklər</span></a></li>
<li><a href="index.php?do=authors" class="waves-effect"><i class="fa fa-pencil-square-o fa-lg"></i> <span class="hide-menu">Yazarlar</span></a></li>
<li><a href="index.php?do=news&news_type=1" class="waves-effect"><i class="fa fa-newspaper-o fa-lg"></i> <span class="hide-menu">Yazar yazıları</span></a></li>
<li><a href="index.php?do=fb_admins" class="waves-effect"><i class="fa fa-user fa-lg"></i> <span class="hide-menu">Fb Admins</span></a></li>
<li><a href="index.php?do=documents" class="waves-effect"><i class="fa fa-newspaper-o fa-lg"></i> <span class="hide-menu">Sənədlər</span></a></li>
<li><a href="index.php?do=letters" class="waves-effect"><i class="fa fa-envelope-o fa-lg"></i> <span class="hide-menu">Məktublar '.$letters_new.'</span></a></li>
<li><a href="index.php?do=comments" class="waves-effect"><i class="fa fa-commenting-o fa-lg"></i> <span class="hide-menu">Şərhlər '.$comments_new.'</span></a></li>
<li><a href="index.php?do=banks" class="waves-effect"><i class="fa fa-building fa-lg"></i> <span class="hide-menu">Banklar</span></a></li>
<li><a href="index.php?do=questions" class="waves-effect"><i class="fa fa-commenting-o fa-lg"></i> <span class="hide-menu">Sorğu</span></a></li>
<li><a href="index.php?do=users" class="waves-effect"><i class="fa fa-users fa-lg"></i> <span class="hide-menu">İstifadəçilər</span></a></li>
<li><a href="index.php?do=admin_roles" class="waves-effect"><i class="fa fa-user fa-lg"></i> <span class="hide-menu">Admin vəzifələri</span></a></li>	
<li><a href="index.php?do=workers" class="waves-effect"><i class="fa fa-user fa-lg"></i> <span class="hide-menu">İşçilərim</span></a></li>
<li><a href="index.php?do=company_info" class="waves-effect"><i class="fa fa-user fa-lg"></i> <span class="hide-menu">Şirkət məlumatları</span></a></li>
<li><a href="index.php?do=settings_inner" class="waves-effect"><i class="fa fa-wrench fa-lg"></i> <span class="hide-menu">Tənzimləmələr</span></a></li>
*/
?>

<?php
$html = str_get_html($left_menu_html);
$menu_names=array();	$hrefs=array();		$does=array();
foreach($html->find('li') as $e){
	$menu_name=$e->plaintext;
	if($e->find('a')){
		$find_a=$e->find('a');
		if(isset($find_a[0])){
			$href=$find_a[0]->href;
			$this_do=explode("do=",$href);	if(isset($this_do[1])) $this_do=$this_do[1]; else $this_do='index';
			if(!in_array($href,$hrefs)){
				$menu_names[]=$menu_name;
				$hrefs[]=$href;
				
				$this_do=explode('&',$this_do); $this_do=$this_do[0];
				$does[]=$this_do;
			}
		}
	}
}
?>
<!-- Section: page title -->
<section class="page-title layer-overlay overlay-theme-colored4-9 section-typo-light bg-img-center" data-tm-bg-img="http://placehold.it/1920x1280">
	<div class="container pt-50 pb-50">
		<div class="section-content">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2 class="title"><?=($do == 'department' or $do == 'departments') ? $lang44 : $info_menu['name_'.$lang_name]?></h2>
					<nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
						<div class="breadcrumbs">
							<span><a href="<?=$site.'/'.$info_home_menu['link']?>" rel="<?=$info_home_menu['name_'.$lang_name]?>"><?=$info_home_menu['name_'.$lang_name]?></a></span>
							<span><i class="fa fa-angle-right"></i></span>
							<span class="active"><?=($do == 'department' or $do == 'departments') ? $lang44 : $info_menu['name_'.$lang_name]?></span>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>
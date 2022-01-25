<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<!-- Section: About -->
<section class="bg-no-repeat bg-img-right" data-tm-bg-img="images/photos/map.png">
	<div class="container pt-lg-90 pb-60 pb-lg-30">
		<div class="section-content mb-100 mb-md-0">
			<div class="row">
				<div class="col-lg-6">
					<div class="tm-sc tm-sc-animated-layer-advanced pt-0 mb-md-100 mb-sm-80">
						<div class="animated-layer-advanced-inner clearfix">
							<div class="tm-about-box">
                                <?php
                                $about=mysqli_fetch_assoc(mysqli_query($db,"select * from about"));
                                ?>
								<div class="layer-image-wrapper tm-animation move-up z-index-1 text-center">
									<div class="layer-image img-one"> <img class="" src="<?=SITE_PATH?>/images/about/<?=$about['image']?>" alt="<?=$about['name_'.$lang_name]?>"></div>
								</div>
								<div class="layer-image-wrapper tm-animation move-right d-none d-sm-block z-index-1" data-tm-right="-2%" data-tm-top="40%">
									<div class="layer-image-three">
										<div class="icon bg-theme-colored1"><img src="<?=SITE_PATH?>/assets/images/icon/1.png" alt="Image"></div>
										<div class="layer-shape-round"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="pl-30 pl-lg--0">
						<h6 class="text-theme-colored1 text-uppercase mt-0"><?=$info_menu['name_'.$lang_name]?></h6>
						<h2 class="mt-0 mb-30 tm-item-appear-clip-path"><?=$about['name_'.$lang_name]?></h2>
						<p class="paragraph mb-30"><?=decode_text($about['full_text_'.$lang_name],true)?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require_once "includes/middle.php"; ?>
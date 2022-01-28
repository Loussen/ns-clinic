<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<!--====== About Section Start ======-->
<section class="about-section section-gap">
	<div class="container">
		<div class="row justify-content-lg-between justify-content-center align-items-center">
			<div class="col-lg-12 col-md-12">
				<div class="circle-image-gallery mb-md-50">
					<div class="row">
						<div class="col-12">
							<div class="single-img wow fadeInLeft" data-wow-delay="0.3s">
								<img src="<?=SITE_PATH?>/images/about/<?=$info_about['image']?>" alt="<?=$info_about['name_'.$lang_name]?>">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-12 col-lg-12 col-md-12 mt-20">
				<div class="about-text">
					<div class="section-heading mb-35">
						<span class="tagline"><?=$info_menu['name_'.$lang_name]?></span>
						<h2 class="title"><?=$info_about['name_'.$lang_name]?></h2>
					</div>
					<p>
                        <?=decode_text($info_about['full_text_'.$lang_name],true)?>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!--====== About Section End ======-->

<?php require_once "includes/middle.php"; ?>
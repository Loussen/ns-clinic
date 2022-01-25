<!-- about-area start -->
<section class="about-area pb-90 mt-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="about-right-side pt-55 mb-30">
<!--                    <div class="about-title mb-20">-->
<!--                        <h2>--><?//=$info_menu['name_'.$lang_name]?><!--</h2>-->
<!--                    </div>-->
                    <div class="about-text mb-50 content-text">
                        <p><?=decode_text($info_menu['text_'.$lang_name],true)?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-area end -->

<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<!--site-main start-->
<div class="site-main">


	<!--about-section-->
	<section class="ttm-row about-section clearfix">
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="position-relative">
						<div class="ttm-bgcolor-grey2 margin_top100">
							<div class="mt_100">
								<!-- ttm_single_image-wrapper -->
								<div class="ttm_single_image-wrapper text-left">
									<img class="img-fluid" src="<?=SITE_PATH?>/images/menus/<?=$info_menu['image']?>" alt="<?=$info_menu['name_'.$lang_name]?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="res-991-padding_top50">
						<!-- section title -->
						<div class="section-title">
							<div class="title-header">
<!--								<h4>--><?//=$info_menu['name_'.$lang_name]?><!--</h4>-->
								<h2 class="title"><?=$info_menu['name_'.$lang_name]?></h2>
							</div>
							<div class="heading-seperator"><span></span></div>
							<div class="title-desc"><?=decode_text($info_menu['text_'.$lang_name],true)?></div>
						</div><!-- section title end -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--about-section end-->

</div><!--site-main end-->

<?php require_once "includes/faq.php"; ?>

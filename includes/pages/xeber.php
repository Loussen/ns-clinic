<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<!--====== Service Area Start ======-->
<section class="services-area section-gap">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12 order-lg-last">
				<div class="service-details-wrapper">
					<h2 class="service-title"><?=$info_news['name_'.$lang_name]?></h2>
					<div class="service-thumbnail mb-50">
						<img src="<?=SITE_PATH?>/images/news/<?=$info_news['image']?>" alt="<?=$info_news['name_'.$lang_name]?>">
					</div>

					<p>
                        <?=decode_text($info_news['full_text_'.$lang_name],true)?>
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!--====== Service Area End ======-->

<?php require_once "includes/middle.php" ?>
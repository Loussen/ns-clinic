<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<section class="text-center">
	<div class="container pb-60 pt-10">
		<div class="section-content">
			<div class="row">
				<div class="col-lg-12">
					<img src="<?= SITE_PATH ?>/images/news/<?= $info_news['image'] ?>" alt="<?=$info_news['name_'.$lang_name]?>"/>
					<h3 class="mt-20 mb-10"><?=$info_news['name_'.$lang_name]?></h3>
					<p class="lead"><?=decode_text($info_news['full_text_'.$lang_name],true)?></p>
				</div>
			</div>
		</div>
	</div>
</section>
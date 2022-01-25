<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<section class="text-center">
	<div class="container pb-60 pt-10">
		<div class="section-content">
			<div class="row">
				<div class="col-lg-12">
					<img src="<?= SITE_PATH ?>/images/doctors/<?= $info_doctor['image'] ?>" alt="<?=$info_doctor['name_'.$lang_name]?>"/>
					<h3 class="mt-20 mb-10"><?=$info_doctor['name_'.$lang_name]?></h3>
					<p class="lead"><?=decode_text($info_doctor['full_text_'.$lang_name],true)?></p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<section class="divider">
	<div class="container pb-70">
		<div class="row">
			<div class="col-lg-5 mb-30">
				<p><?=substr_($info_contacts['footer_'.$lang_name],0,200,true,true)?></p>
				<div class="tm-sc-unordered-list list-style2">
					<ul>
						<li><strong><?=$lang6?>:</strong> <a href="tel:<?=$info_contacts['phone']?>"><?=$info_contacts['phone']?></a></li>
						<li><strong><?=$lang51?>:</strong> <a href="mailto:<?=$info_contacts['email']?>"><?=$info_contacts['email']?></a></li>
						<li><strong><?=$lang40?>:</strong> <?=$info_contacts['text_'.$lang_name]?></li>
					</ul>
				</div>
				<ul class="styled-icons icon-dark icon-sm icon-circled mt-30">
					<li><a href="<?=$info_contacts['facebook']?>" data-tm-bg-color="#3B5998"><i class="fab fa-facebook"></i></a></li>
					<li><a href="<?=$info_contacts['youtube']?>" data-tm-bg-color="#D71619"><i class="fab fa-youtube"></i></a></li>
					<li><a href="<?=$info_contacts['instagram']?>" data-tm-bg-color="#D9CCB9"><i class="fab fa-instagram"></i></a></li>
				</ul>
			</div>
			<div class="col-lg-7">
				<h3 class="mt-0 mb-0"><?=$lang1?></h3>
				<p class="font-size-20"><?=$lang10?></p>
				<!-- Contact Form -->
				<div class="alert alert-success success_contact" style="display: none;"><?=$lang2?></div>
				<div class="alert alert-warning error_contact" style="display: none;"><?=$lang3?></div>
				<form id="contact_form" name="contact_form" class="contact_form">
					<div class="form-row">
						<div class="col-sm-6">
							<div class="form-group">
								<label><?=$lang4?> <small>*</small></label>
								<input name="name" class="form-control" required="required"  type="text" placeholder="<?=$lang4?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label><?=$lang51?></label>
								<input name="email" class="form-control email" type="email" placeholder="<?=$lang51?>">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-6">
							<div class="form-group">
								<label><?=$lang52?></label>
								<input name="subject" class="form-control" type="text" placeholder="<?=$lang52?>">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label><?=$lang6?> <small>*</small></label>
								<input name="phone" class="form-control" required="required" type="text" placeholder="<?=$lang6?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label><?=$lang12?> <small>*</small></label>
						<textarea name="message" class="form-control" required="required" rows="5" minlength="5" placeholder="<?=$lang12?>"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-flat btn-theme-colored1 text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px" data-loading-text="Please wait..."><?=$lang7?></button>
						<button type="reset" class="btn btn-flat btn-theme-colored3 text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px"><?=$lang53?></button>
					</div>
				</form>
				<!-- Contact Form Validation-->
			</div>
		</div>
	</div>
</section>

<div id="google_map" class="google_map">
	<div class="map_container">
		<div id="map">
			<iframe style="width: 100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1518.940611555354!2d49.838624341866684!3d40.41148199560543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40308752799532e5%3A0xc3bb3031e114bd27!2sFetal%20M%C9%99rk%C9%99z%20NS%20Genetics!5e0!3m2!1sen!2s!4v1636824425303!5m2!1sen!2s" height="400"></iframe>
		</div>
	</div>
</div>
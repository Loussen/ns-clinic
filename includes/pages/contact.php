<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<!--====== Contact Info Section Start ======-->
<section class="section-gap contact-top-wrappper">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-6">
				<div class="contact-info-wrapper">
					<div class="single-contact-info">
						<div class="single-contact-info">
							<h3 class="info-title">
								<i class="fal fa-map-marker-alt"></i> <?=$lang29?>
							</h3>
							<p>
                                <?=$info_contacts['text_'.$lang_name]?>
							</p>
						</div>
						<div class="single-contact-info">
							<h3 class="info-title">
								<i class="fal fa-coffee"></i> <?=$lang30?>
							</h3>
							<ul>
								<li>
									<span><?=$lang39?></span><a href="tel:<?=$info_contacts['phone']?>"><?=$info_contacts['phone']?></a>
								</li>
								<li>
									<span><?=$lang40?></span><a href="mailto:<?=$info_contacts['email']?>"><?=$info_contacts['email']?></a>
								</li>
							</ul>
						</div>
						<div class="single-contact-info">
							<h3 class="info-title">
								<i class="fal fa-comments"></i> <?=$lang31?>
							</h3>
							<p class="social-icon">
								<a href="<?=$info_contacts['facebook']?>"><i class="fab fa-facebook"></i></a>
								<a href="<?=$info_contacts['instagram']?>"><i class="fab fa-instagram"></i></a>
								<a href="<?=$info_contacts['youtube']?>"><i class="fab fa-youtube-square"></i></a>
							</p>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-6 form-wrap">
				<div class="section-heading mb-60 text-center">
					<h2 class="title"><?=$lang32?></h2>
				</div>
				<div class="alert alert-success success_contact" style="display: none;"><?=$lang41?></div>
				<div class="alert alert-warning error_contact" style="display: none;"><?=$lang42?></div>
				<form action="#" class="contact-form" id="contact-form">
					<div class="row">
						<div class="col-md-6">
							<div class="input-field">
								<label for="name"><?=$lang33?></label>
								<input type="text" name="name" placeholder="<?=$lang33?>" id="name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-field">
								<label for="email"><?=$lang34?></label>
								<input type="email" name="email" placeholder="<?=$lang34?>" id="email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-field">
								<label for="number"><?=$lang36?></label>
								<input type="text" name="phone" placeholder="<?=$lang36?>" id="number">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-field">
								<label for="title"><?=$lang35?></label>
								<input type="url" name="subject" placeholder="<?=$lang35?>" id="title">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="input-field">
								<label for="message"><?=$lang37?></label>
								<textarea id="message" name="message" placeholder="<?=$lang37?>"></textarea>
							</div>
						</div>
						<div class="col-12">
							<div class="text-center">
								<button type="submit" class="template-btn"><?=$lang38?> <i class="far fa-plus"></i></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!--====== Contact Info Section End ======-->

<!--====== Contact Form Start ======-->
<section class="contact-form-area">
	<div class="contact-map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d107201.226767341!2d-74.05027451789393!3d40.71534534062428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1634195102348!5m2!1sen!2sbd" loading="lazy"></iframe>
	</div>
</section>
<!--====== Contact Form End ======-->
<!-- Section: Divider -->
<section class="bg-img overflow-hidden" data-tm-bg-img="<?=SITE_PATH?>/assets/images/photos/divider-bg.jpg">
	<div class="container">
		<div class="section-content">
			<div class="row">
				<div class="col-lg-6">
					<div class="tm-sc-section-title section-title section-title-light mb-60 mt-20 pr-50">
						<div class="title-wrapper">
							<h5 class="subtitle text-white"><?=$info_contacts['phone']?></h5>
							<h2 class="text-white" style="font-family: unset; font-size: 2em;"><?=$lang45?> <span class="text-theme-colored3"><?=$lang46?></span></h2>
							<div class="tm-sc-button">
								<a href="<?=SITE_PATH?>/elaqe" class="btn btn-theme-colored1 btn-flat"><?=$lang16?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="divider-current-theme-style1">
						<div class="layer-image-wrapper">
							<div class="layer-image">
								<img src="<?=SITE_PATH?>/assets/images/doctor_middle.png" alt="Image">
							</div>
							<div class="experience-iconbox">
								<h4 class="number text-theme-colored1">10</h4>
								<h4 class="title">Years of Experience</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Divider -->

<!-- Section: Appointment -->
<section class="">
	<div class="container p-0 pt-md-100 pl-sm-15 pr-sm-15">
		<div class="section-content">
			<div class="row justify-content-end">
				<div class="col-lg-8 col-xl-7">
					<div class="appointment-current-theme-style">
						<div class="tm-sc-section-title section-title mb-0" id="appointment_title">
							<div class="title-wrapper">
								<h6 class="appointment_title_up subtitle text-theme-colored1 text-uppercase"><?=$lang10?></h6>
								<h2 class="appointment_title_down title mb-40"><?=$lang1?></h2>
							</div>
						</div>
						<!-- Contact Form -->
						<div class="alert alert-success success_appointment" style="display: none;"><?=$lang2?></div>
						<div class="alert alert-warning error_appointment" style="display: none;"><?=$lang3?></div>
						<form id="appointment-form" class="appointment-form" name="appointment-form">
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
							<div class="form-row">
								<div class="col-sm-6">
									<div class="form-group">
										<label><?=$lang56?> <small>*</small></label>
										<select class="form-control" name="appointment_type" required="required">
											<option value=""><?=$lang56?></option>
											<option value="1"><?=$lang54?></option>
<!--											<option value="2">--><?//=$lang55?><!--</option>-->
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>&nbsp;</label>
										<select class="form-control checkup_type" disabled="disabled" name="checkup_type" required="required">
										</select>
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="layer-image-wrapper layer-image-divider2">
		<div class="layer-image-left" data-tm-bg-img="<?=SITE_PATH?>/assets/images/Fetal_merkez_ns_genetics_klinikasii.png" style="background-image: url(<?=SITE_PATH?>/assets/images/Fetal_merkez_ns_genetics_klinikasi.jpg); width: 666px;">
<!--			<div class="projects-count bg-theme-colored2">-->
<!--				<div class="wrapper">-->
<!--					<div class="details">-->
<!--						<h4 class="text-white">The majority have suffered</h4>-->
<!--						<div class="icon"><img src="--><?//=SITE_PATH?><!--/assets/images/icon/11.png" alt="ImageIcon"></div>-->
<!--					</div>-->
<!--					<div class="video-icon">-->
<!--						<div class="box-hover-effect play-video-button tm-sc tm-sc-video-popup">-->
<!--							<div class="effect-wrapper text-center ml-30 ml-md-20 mt-10">-->
<!--								<div class="video-button text-white font-size-60"><span class="far fa-play-circle"></span></div>-->
<!--								<a class="hover-link" data-lightbox-gallery="youtube-video" href="https://www.youtube.com/watch?time_continue=2&amp;v=XJgNuWtCEAI" title=""></a>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
		</div>
	</div>
</section>
<!-- End Appointment -->
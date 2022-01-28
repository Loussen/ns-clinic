<!--====== Big Tagline Start ======-->
<section class="big-tagline">
	<div class="container-fluid">
		<h2 class="tagline"><?=$info_about['slogan_'.$lang_name]?></h2>
	</div>
</section>
<!--====== Big Tagline End ======-->

<!--====== Appointment Section Start ======-->
<section class="appointment-section section-gap" id="appointment_title">
	<div class="container">
		<div class="appointment-form-two">
			<div class="form-wrap">
				<div class="section-heading mb-40">
					<span class="tagline"><?=$lang9?></span>
					<h2 class="title"><?=$lang10?></h2>
				</div>
				<div class="alert alert-success success_appointment" style="display: none;"><?=$lang17?></div>
				<div class="alert alert-warning error_appointment" style="display: none;"><?=$lang18?></div>
				<form action="#" id="appointment-form">
					<div class="row">
						<div class="col-12">
							<div class="input-field wow fadeInLeft" data-wow-delay="0.3s">
								<input type="text" name="fullname" placeholder="<?=$lang11?>">
							</div>
						</div>
						<div class="col-12">
							<div class="input-field wow fadeInLeft" data-wow-delay="0.4s">
								<input type="email" name="email" placeholder="<?=$lang12?>">
							</div>
						</div>
						<div class="col-12">
							<div class="input-field wow fadeInLeft" data-wow-delay="0.5s">
								<input type="text" name="title" placeholder="<?=$lang13?>">
							</div>
						</div>
						<div class="col-12">
							<div class="input-field wow fadeInLeft" data-wow-delay="0.6s">
								<input type="text" name="phone" placeholder="<?=$lang14?>">
							</div>
						</div>
						<div class="col-12">
							<div class="input-field wow fadeInLeft" data-wow-delay="0.6s">
								<textarea name="message" placeholder="<?=$lang15?>"></textarea>
							</div>
						</div>
						<!--						<div class="col-12">-->
						<!--							<div class="input-field wow fadeInLeft" data-wow-delay="0.4s">-->
						<!--								<select>-->
						<!--									<option value="1" selected disabled>Services Category</option>-->
						<!--									<option value="2">Service One</option>-->
						<!--									<option value="3">Service Two</option>-->
						<!--									<option value="4">Service Three</option>-->
						<!--									<option value="5">Service Four</option>-->
						<!--								</select>-->
						<!--							</div>-->
						<!--						</div>-->
						<!--						<div class="col-12">-->
						<!--							<div class="input-field wow fadeInLeft" data-wow-delay="0.5s">-->
						<!--								<select>-->
						<!--									<option value="1" selected disabled>Choose Doctors</option>-->
						<!--									<option value="2">Doctor One</option>-->
						<!--									<option value="3">Doctor Two</option>-->
						<!--									<option value="4">Doctor Three</option>-->
						<!--									<option value="5">Doctor Four</option>-->
						<!--								</select>-->
						<!--							</div>-->
						<!--						</div>-->
						<!--						<div class="col-12">-->
						<!--							<div class="input-field wow fadeInLeft" data-wow-delay="0.6s">-->
						<!--								<input type="date">-->
						<!--							</div>-->
						<!--						</div>-->
						<div class="col-12">
							<div class="input-field wow fadeInLeft" data-wow-delay="0.8s">
								<button type="submit" class="template-btn">
                                    <?=$lang16?> <i class="far fa-plus"></i>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
            <?php
            $info_appointment=mysqli_fetch_assoc(mysqli_query($db,"select * from appointment"));
            ?>
			<div class="appointment-image" style="background-image: url(<?=SITE_PATH?>/images/appointment/<?=$info_appointment['image']?>);">
			</div>
		</div>
	</div>
</section>
<!--====== Appointment Section End ======-->
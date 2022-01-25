<!--====== Hero Area Start ======-->
<section class="hero-area-one">
	<div class="container">
		<div class="row align-items-center justify-content-center">
			<div class="col-lg-5 col-md-8">
				<div class="hero-content">
					<?php
                        $info_slider=mysqli_fetch_assoc(mysqli_query($db,"select * from sliders where active=1"));
					?>
					<h1 class="title wow fadeInDown" data-wow-delay="0.3s"><?=$info_slider['name_'.$lang_name]?></h1>
					<p class="wow fadeInLeft" data-wow-delay="0.4s"><?=$info_slider['text_'.$lang_name]?></p>
					<a href="<?=$info_slider['link']?>" class="template-btn wow fadeInUp" data-wow-delay="0.5s"><?=$info_slider['title_'.$lang_name]?></a>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="hero-img wow fadeInUp" data-wow-delay="0.3s">
					<img src="<?=SITE_PATH?>/images/sliders/<?=$info_slider['image']?>" alt="<?=$info_slider['name_'.$lang_name]?>">
				</div>
			</div>
		</div>
	</div>
</section>
<!--====== Hero Area End ======-->

<!--====== Why Choose Section Start ======-->
<section class="wcu-section section-gap-top">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="section-heading heading-white text-center mb-40">
					<span class="tagline"><?=$lang2?></span>
					<h2 class="title">><?=$lang3?></h2>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">


					<?php
                        $home_videogallery = mysqli_query($db, "select * from videogallery where active=1 ORDER BY `position` ASC LIMIT 3");

	                    while($row_videogallery = mysqli_fetch_assoc($home_videogallery))
	                    {
	                    	?>
							<div class="col-lg-4 col-md-6 col-sm-9 wow fadeInUp" data-wow-delay="0.3s">
								<div class="image-title-box mt-30">
						                    <h4 class="title"><a href="javascript:void(0);"><?=$row_videogallery['name_' . $lang_name]?></a></h4>

						                    <div class="image featured-thumbnail youtube-video-place" data-yt-url="https://www.youtube.com/embed/<?=youtube_embed($row_videogallery['video_url'])?>?rel=0&showinfo=0&autoplay=1" style="position: relative;" >
							                    <img src="<?=SITE_PATH?>/assets/img/youtube-play.png" class="play-youtube" style="position: absolute;
					    top: 50%;
					    left: 50%;
					    transform: translate(-50%, -50%); cursor: pointer; width:15%; z-index: 99; min-width: auto;" />

							                    <img class="img-fullwidth" src="http://img.youtube.com/vi/<?=youtube_embed($row_videogallery['video_url'])?>/maxresdefault.jpg" alt="<?=$row_videogallery['name_' . $lang_name]?>">
						                    </div>
								</div>
							</div>
							<?php
                        }
					?>

		</div>
	</div>
</section>
<!--====== Why Choose Section End ======-->

<!--====== About Section Start ======-->
<section class="about-section section-gap">
	<div class="container">
		<div class="row justify-content-lg-between justify-content-center align-items-center">
			<div class="col-lg-6 col-md-10">
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
			<div class="col-xl-5 col-lg-6 col-md-8">
				<div class="about-text">
					<div class="section-heading mb-35">
						<h2 class="title"><?=$info_about['name_'.$lang_name]?></h2>
					</div>
					<p>
                        <?=substr_($info_about['short_text_'.$lang_name],0,400,true,true)?>
					</p>
					<a href="<?=SITE_PATH?>/haqqimizda" class="template-btn mt-40"><?=$lang4?> <i class="far fa-plus"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!--====== About Section End ======-->

<!--====== Service Section Start ======-->
<section class="service-section bg-color-grey section-gap">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-7 col-lg-8">
				<div class="section-heading text-center mb-40">
					<span class="tagline">Popular Medical Services</span>
					<h2 class="title">Benefit For Physical Mental and Virtual Care</h2>
				</div>
			</div>
		</div>
		<div class="row justify-content-center service-loop">
			<div class="col-lg-4 col-md-6 col-sm-8">
				<div class="iconic-box mt-30 wow fadeInUp" data-wow-delay="0.3s">
					<div class="icon">
						<img src="<?=SITE_PATH?>/assets/img/icon/heart.png" alt="Icon">
					</div>
					<h4 class="title"><a href="service-details.html">Cardiology</a></h4>
					<p>
						Dolor sit amet consectetur ascing elitsed eiusmod tempor
					</p>

					<div class="box-link-wrap">
						<span class="link-icon"><i class="far fa-plus"></i></span>
						<a class="box-link" href="service-details.html">Read More <i class="far fa-plus"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-8">
				<div class="iconic-box mt-30 wow fadeInUp" data-wow-delay="0.4s">
					<div class="icon">
						<img src="<?=SITE_PATH?>/assets/img/icon/lungs.png" alt="Icon">
					</div>
					<h4 class="title"><a href="service-details.html">Pulmonary</a></h4>
					<p>
						Dolor sit amet consectetur ascing elitsed eiusmod tempor
					</p>

					<div class="box-link-wrap">
						<span class="link-icon"><i class="far fa-plus"></i></span>
						<a class="box-link" href="service-details.html">Read More <i class="far fa-plus"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-8">
				<div class="iconic-box mt-30 wow fadeInUp" data-wow-delay="0.5s">
					<div class="icon">
						<img src="<?=SITE_PATH?>/assets/img/icon/brain.png" alt="Icon">
					</div>
					<h4 class="title"><a href="service-details.html">Neurology</a></h4>
					<p>
						Dolor sit amet consectetur ascing elitsed eiusmod tempor
					</p>

					<div class="box-link-wrap">
						<span class="link-icon"><i class="far fa-plus"></i></span>
						<a class="box-link" href="service-details.html">Read More <i class="far fa-plus"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-8">
				<div class="iconic-box mt-30 wow fadeInUp" data-wow-delay="0.6s">
					<div class="icon">
						<img src="<?=SITE_PATH?>/assets/img/icon/stomach.png" alt="Icon">
					</div>
					<h4 class="title"><a href="service-details.html">Gastroenterology</a></h4>
					<p>
						Dolor sit amet consectetur ascing elitsed eiusmod tempor
					</p>

					<div class="box-link-wrap">
						<span class="link-icon"><i class="far fa-plus"></i></span>
						<a class="box-link" href="service-details.html">Read More <i class="far fa-plus"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-8">
				<div class="iconic-box mt-30 wow fadeInUp" data-wow-delay="0.7s">
					<div class="icon">
						<img src="<?=SITE_PATH?>/assets/img/icon/virus.png" alt="Icon">
					</div>
					<h4 class="title"><a href="service-details.html">Covid - 19</a></h4>
					<p>
						Dolor sit amet consectetur ascing elitsed eiusmod tempor
					</p>

					<div class="box-link-wrap">
						<span class="link-icon"><i class="far fa-plus"></i></span>
						<a class="box-link" href="service-details.html">Read More <i class="far fa-plus"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-8">
				<div class="iconic-box mt-30 wow fadeInUp" data-wow-delay="0.8s">
					<div class="icon">
						<img src="<?=SITE_PATH?>/assets/img/icon/bronchus.png" alt="Icon">
					</div>
					<h4 class="title"><a href="service-details.html">Orthopedics</a></h4>
					<p>
						Dolor sit amet consectetur ascing elitsed eiusmod tempor
					</p>

					<div class="box-link-wrap">
						<span class="link-icon"><i class="far fa-plus"></i></span>
						<a class="box-link" href="service-details.html">Read More <i class="far fa-plus"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--====== Service Section End ======-->

<!--====== Big Tagline Start ======-->
<section class="big-tagline">
	<div class="container-fluid">
		<h2 class="tagline">Learn better health outcomes, improve costs and increase productivity for your business</h2>
	</div>
</section>
<!--====== Big Tagline End ======-->

<!--====== Doctor Section Start ======-->
<section class="doctors-section section-gap">
	<div class="container">
		<div class="row justify-content-between align-items-center mb-40">
			<div class="col-lg-5 col-md-6">
				<div class="section-heading">
					<span class="tagline">Professional Doctors</span>
					<h2 class="title">Meet Our Experience  Doctors</h2>
				</div>
			</div>
			<div class="col-auto">
				<a href="doctors.html" class="template-btn template-btn-primary mt-sm-30 wow fadeInRight" data-wow-delay="0.3s">
					Make An Appointment <i class="far fa-plus"></i>
				</a>
			</div>
		</div>
		<div class="row doctors-loop justify-content-center">
			<div class="col-lg-3 col-md-6">
				<div class="doctor-box-one bordered-style mt-30 wow fadeInUp" data-wow-delay="0.3s">
					<div class="doctor-photo">
						<img src="<?=SITE_PATH?>/assets/img/doctors/10.jpg" alt="Image">
					</div>
					<div class="doctor-information">
						<h5 class="name">
							<a href="doctor-details.html">Lee S. Williamson</a>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="doctor-box-one bordered-style mt-30 wow fadeInUp" data-wow-delay="0.3s">
					<div class="doctor-photo">
						<img src="<?=SITE_PATH?>/assets/img/doctors/10.jpg" alt="Image">
					</div>
					<div class="doctor-information">
						<h5 class="name">
							<a href="doctor-details.html">Lee S. Williamson</a>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="doctor-box-one bordered-style mt-30 wow fadeInUp" data-wow-delay="0.3s">
					<div class="doctor-photo">
						<img src="<?=SITE_PATH?>/assets/img/doctors/10.jpg" alt="Image">
					</div>
					<div class="doctor-information">
						<h5 class="name">
							<a href="doctor-details.html">Lee S. Williamson</a>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="doctor-box-one bordered-style mt-30 wow fadeInUp" data-wow-delay="0.3s">
					<div class="doctor-photo">
						<img src="<?=SITE_PATH?>/assets/img/doctors/10.jpg" alt="Image">
					</div>
					<div class="doctor-information">
						<h5 class="name">
							<a href="doctor-details.html">Lee S. Williamson</a>
						</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--====== Doctor Section End ======-->

<!--====== Appointment Section Start ======-->
<section class="appointment-section section-gap-bottom">
	<div class="container">
		<div class="appointment-form-two">
			<div class="form-wrap">
				<div class="section-heading mb-40">
					<span class="tagline">Make an Appointment</span>
					<h2 class="title">Make an Appointment to Doctor Visit</h2>
				</div>
				<form action="#">
					<div class="row">
						<div class="col-12">
							<div class="input-field wow fadeInLeft" data-wow-delay="0.3s">
								<input type="text" placeholder="Your Full Name">
							</div>
						</div>
						<div class="col-12">
							<div class="input-field wow fadeInLeft" data-wow-delay="0.4s">
								<select>
									<option value="1" selected disabled>Services Category</option>
									<option value="2">Service One</option>
									<option value="3">Service Two</option>
									<option value="4">Service Three</option>
									<option value="5">Service Four</option>
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="input-field wow fadeInLeft" data-wow-delay="0.5s">
								<select>
									<option value="1" selected disabled>Choose Doctors</option>
									<option value="2">Doctor One</option>
									<option value="3">Doctor Two</option>
									<option value="4">Doctor Three</option>
									<option value="5">Doctor Four</option>
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="input-field wow fadeInLeft" data-wow-delay="0.6s">
								<input type="date">
							</div>
						</div>
						<div class="col-12">
							<div class="input-field wow fadeInLeft" data-wow-delay="0.7s">
								<button type="submit" class="template-btn">
									Make an Appointment <i class="far fa-plus"></i>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="appointment-image" style="background-image: url(<?=SITE_PATH?>/assets/img/appointment/07.jpg);">
			</div>
		</div>
	</div>
</section>
<!--====== Appointment Section End ======-->

<!--====== Testimonials Section Start ======-->
<section class="testimonial-section bg-color-grey section-have-half-bg">
	<div class="container-fluid">
		<div class="row justify-content-end">
			<div class="col-lg-6">
				<div class="testimonial-one-wrap">
					<div class="section-heading mb-50">
						<span class="tagline">Our Testimonials</span>
						<h2 class="title">What Our Patients Say About Our Medical</h2>
					</div>
					<div class="testimonial-slider-one">
						<div class="single-testimonial-slider">
							<div class="testimonial-inner">
								<div class="avatar">
									<img src="<?=SITE_PATH?>/assets/img/testimonial/01.png" alt="Avatar">
								</div>
								<div class="content-wrap">
									<p class="testimonial-desc">
										Sed ut perspiciatis unde omnis natusy error voluptatem accusantium doloreue laudan totam rem aperiam eaquip quae abillo inventore veritatis quasi architecto beatae vitae dicta sunt explicabo
									</p>
									<div class="author-info">
										<h5 class="name">Mark E. Kaminsky</h5>
										<span class="title">Web Designer</span>
									</div>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="testimonial-inner">
								<div class="avatar">
									<img src="<?=SITE_PATH?>/assets/img/testimonial/01.png" alt="Avatar">
								</div>
								<div class="content-wrap">
									<p class="testimonial-desc">
										Sed ut perspiciatis unde omnis natusy error voluptatem accusantium doloreue laudan totam rem aperiam eaquip quae abillo inventore veritatis quasi architecto beatae vitae dicta sunt explicabo
									</p>
									<div class="author-info">
										<h5 class="name">Mark E. Kaminsky</h5>
										<span class="title">Web Designer</span>
									</div>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="testimonial-inner">
								<div class="avatar">
									<img src="<?=SITE_PATH?>/assets/img/testimonial/01.png" alt="Avatar">
								</div>
								<div class="content-wrap">
									<p class="testimonial-desc">
										Sed ut perspiciatis unde omnis natusy error voluptatem accusantium doloreue laudan totam rem aperiam eaquip quae abillo inventore veritatis quasi architecto beatae vitae dicta sunt explicabo
									</p>
									<div class="author-info">
										<h5 class="name">Mark E. Kaminsky</h5>
										<span class="title">Web Designer</span>
									</div>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="testimonial-inner">
								<div class="avatar">
									<img src="<?=SITE_PATH?>/assets/img/testimonial/01.png" alt="Avatar">
								</div>
								<div class="content-wrap">
									<p class="testimonial-desc">
										Sed ut perspiciatis unde omnis natusy error voluptatem accusantium doloreue laudan totam rem aperiam eaquip quae abillo inventore veritatis quasi architecto beatae vitae dicta sunt explicabo
									</p>
									<div class="author-info">
										<h5 class="name">Mark E. Kaminsky</h5>
										<span class="title">Web Designer</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section-half-bg" style="background-image: url(<?=SITE_PATH?>/assets/img/section-bg/half-bg-img-01.jpg);"></div>
</section>
<!--====== Testimonials Section End ======-->

<!--====== Help Section Start ======-->
<section class="help-section section-gap-bottom">
	<div class="container">
		<div class="row justify-content-center justify-content-lg-end align-items-center">
			<div class="col-xl-5 col-lg-6 col-md-8">
				<div class="help-text-wrapper">
					<div class="section-heading mb-20">
						<span class="tagline">How Can We Help</span>
						<h2 class="title">Flexible & Responsive to Changing Need</h2>
					</div>
					<p>
						Sed ut perspiciatis unde omnis iste natus error voluptatem accusantium doloremque laudantium totam rem aperieaqueys epsa quae abillo inventore veritatis et quase
					</p>
					<ul class="check-list mt-35 pr-xl-4">
						<li class="wow fadeInUp" data-wow-delay="0.3s">
							25-30% estimated savings in implementation when using Mobile Health Clinics
						</li>
						<li class="wow fadeInUp" data-wow-delay="0.4s">
							Activate Mobile Health Clinics in just weeks
						</li>
						<li class="wow fadeInUp" data-wow-delay="0.5s">
							Flexible, on-demand access to care services
						</li>
						<li class="wow fadeInUp" data-wow-delay="0.6s">
							Supports referrals to provider networks and care management programs
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="help-img text-center text-lg-right mt-md-50">
					<img src="<?=SITE_PATH?>/assets/img/section-img/help-section-img.jpg" alt="Image">
				</div>
			</div>
		</div>
	</div>
</section>
<!--====== Help Section End ======-->

<!--====== Latest Blog Start ======-->
<section class="latest-blog-section section-gap">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-8">
				<div class="section-heading mb-40">
					<span class="tagline">Latest News & Blog</span>
					<h2 class="title">Get Every Single Updates For Medical & Health</h2>
				</div>
			</div>
		</div>
		<div class="row justify-content-center latest-blog-loop">
			<div class="col-lg-4 col-md-6 col-sm-10">
				<div class="latest-blog-one mt-30">
					<div class="blog-thumb">
						<img src="<?=SITE_PATH?>/assets/img/latest-blog/01.jpg" alt="Thumb">
					</div>
					<div class="blog-content">
						<div class="blog-meta">
							<a href="#" class="blog-category">Health</a>
							<a href="#" class="blog-date"><i class="far fa-calendar-alt"></i> 25 Aug 2021</a>
						</div>
						<h4 class="blog-title">
							<a href="blog-details.html">Comprehensive Worksite Health Program Built</a>
						</h4>
						<div class="btn-area">
							<a href="blog-details.html" class="read-more-btn">
								Read More <i class="far fa-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-10">
				<div class="latest-blog-one mt-30">
					<div class="blog-thumb">
						<img src="<?=SITE_PATH?>/assets/img/latest-blog/02.jpg" alt="Thumb">
					</div>
					<div class="blog-content">
						<div class="blog-meta">
							<a href="#" class="blog-category">Medical</a>
							<a href="#" class="blog-date"><i class="far fa-calendar-alt"></i> 26 Aug 2021</a>
						</div>
						<h4 class="blog-title">
							<a href="blog-details.html">Speeding Up The Return on Your Healthcare</a>
						</h4>
						<div class="btn-area">
							<a href="blog-details.html" class="read-more-btn">
								Read More <i class="far fa-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-10">
				<div class="latest-blog-one mt-30">
					<div class="blog-thumb">
						<img src="<?=SITE_PATH?>/assets/img/latest-blog/03.jpg" alt="Thumb">
					</div>
					<div class="blog-content">
						<div class="blog-meta">
							<a href="#" class="blog-category">Health</a>
							<a href="#" class="blog-date"><i class="far fa-calendar-alt"></i> 25 Aug 2021</a>
						</div>
						<h4 class="blog-title">
							<a href="blog-details.html">Comprehensive Worksite Health Program Built</a>
						</h4>
						<div class="btn-area">
							<a href="blog-details.html" class="read-more-btn">
								Read More <i class="far fa-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--====== Latest Blog End ======-->
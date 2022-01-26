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
					<h2 class="title"><?=$lang5?></h2>
				</div>
			</div>
		</div>
		<div class="row justify-content-center service-loop">
			<?php
                $sql=mysqli_query($db,"select * from methods where active=1 order by id desc limit 6");

                while($row=mysqli_fetch_assoc($sql))
                {
                	?>
	                <div class="col-lg-4 col-md-6 col-sm-8">
		                <div class="iconic-box mt-30 wow fadeInUp" data-wow-delay="0.3s">
			                <div class="icon">
				                <img src="<?=SITE_PATH?>/images/methods/thumb_<?=$row['image']?>" alt="<?=$row['name_'.$lang_name]?>">
			                </div>
			                <h4 class="title"><a href="<?=$site?>/metod/<?=slugGenerator($row['name_'.$lang_name]).'-'.$row["id"]?>"><?=$row['name_'.$lang_name]?></a></h4>
			                <p>
                                <?=substr_(decode_text($row['short_text_'.$lang_name]),0,50,true)?>
			                </p>

			                <div class="box-link-wrap">
				                <span class="link-icon"><i class="far fa-plus"></i></span>
				                <a class="box-link" href="<?=$site?>/metod/<?=slugGenerator($row['name_'.$lang_name]).'-'.$row["id"]?>"><?=$lang6?> <i class="far fa-plus"></i></a>
			                </div>
		                </div>
	                </div>
					<?php
                }
			?>
		</div>
	</div>
</section>
<!--====== Service Section End ======-->

<!--====== Big Tagline Start ======-->
<section class="big-tagline">
	<div class="container-fluid">
		<h2 class="tagline"><?=$info_about['slogan_'.$lang_name]?></h2>
	</div>
</section>
<!--====== Big Tagline End ======-->

<!--====== Doctor Section Start ======-->
<section class="doctors-section section-gap">
	<div class="container">
		<div class="row justify-content-between align-items-center mb-40">
			<div class="col-lg-5 col-md-6">
				<div class="section-heading">
					<h2 class="title"><?=$lang7?></h2>
				</div>
			</div>
			<div class="col-auto">
				<a href="<?=$do == 'home' ? '#appointment_title' : SITE_PATH."#appointment_title"?>" class="template-btn template-btn-primary mt-sm-30 wow fadeInRight" data-wow-delay="0.3s">
					<?=$lang8?> <i class="far fa-plus"></i>
				</a>
			</div>
		</div>
		<div class="row doctors-loop justify-content-center">
			<?php
	            $sql=mysqli_query($db,"select * from services where active=1 order by position asc limit 4");

	            while($row=mysqli_fetch_assoc($sql))
	            {
	            	?>
		            <div class="col-lg-3 col-md-6">
			            <div class="doctor-box-one bordered-style mt-30 wow fadeInUp" data-wow-delay="0.3s">
				            <div class="doctor-photo">
					            <img src="<?=SITE_PATH?>/images/services/<?=$row['image']?>" alt="<?=$row['name_'.$lang_name]?>">
				            </div>
				            <div class="doctor-information">
					            <h5 class="name">
						            <a href="<?=$site?>/xidmet/<?=slugGenerator($row['name_'.$lang_name]).'-'.$row["id"]?>"><?=$row['name_'.$lang_name]?></a>
					            </h5>
				            </div>
			            </div>
		            </div>
					<?php
                }
			?>
		</div>
	</div>
</section>
<!--====== Doctor Section End ======-->

<!--====== Appointment Section Start ======-->
<section class="appointment-section section-gap-bottom" id="appointment_title">
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

<!--====== Testimonials Section Start ======-->
<section class="testimonial-section bg-color-grey section-have-half-bg">
	<div class="container-fluid">
		<div class="row justify-content-end">
			<div class="col-lg-6">
				<div class="testimonial-one-wrap">
					<div class="section-heading mb-50">
						<span class="tagline"><?=$lang19?></span>
						<h2 class="title"><?=$lang20?></h2>
					</div>
					<div class="testimonial-slider-one">
						<?php
                            $sql=mysqli_query($db,"select * from patients where active=1 order by position asc");

                            while($row=mysqli_fetch_assoc($sql))
                            {
                            	?>
	                            <div class="single-testimonial-slider">
		                            <div class="testimonial-inner">
			                            <div class="content-wrap">
				                            <p class="testimonial-desc">
					                            <?=$row['text_'.$lang_name]?>
				                            </p>
				                            <div class="author-info">
					                            <h5 class="name"><?=$row['name_'.$lang_name]?></h5>
				                            </div>
			                            </div>
		                            </div>
	                            </div>
								<?php
                            }
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section-half-bg" style="background-image: url(<?=SITE_PATH?>/images/appointment/<?=$info_appointment['image2']?>);"></div>
</section>
<!--====== Testimonials Section End ======-->

<!--====== Help Section Start ======-->
<section class="help-section section-gap">
	<div class="container">
		<div class="row justify-content-center justify-content-lg-end align-items-center">
			<div class="col-xl-5 col-lg-6 col-md-8">
				<div class="help-text-wrapper">
                    <?php
                        $info_why_choose=mysqli_fetch_assoc(mysqli_query($db,"select * from why_choose"));
                    ?>
					<div class="section-heading mb-20">
						<span class="tagline"><?=$lang21?></span>
						<h2 class="title"><?=$info_why_choose['name_'.$lang_name]?></h2>
					</div>
					<p>
						<?=decode_text($info_why_choose['full_text_'.$lang_name],true)?>
					</p>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="help-img text-center text-lg-right mt-md-50">
					<img src="<?=SITE_PATH?>/images/why_choose/<?=$info_why_choose['image']?>" alt="<?=$info_why_choose['name_'.$lang_name]?>">
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
					<span class="tagline"><?=$lang22?></span>
					<h2 class="title"><?=$lang23?></h2>
				</div>
			</div>
		</div>
		<div class="row justify-content-center latest-blog-loop">
			<?php
                $home_news=mysqli_query($db,"select * from news where active=1 order by id desc LIMIT 3");

	            while($row=mysqli_fetch_assoc($home_news))
	            {
	            	?>
		            <div class="col-lg-4 col-md-6 col-sm-10">
			            <div class="latest-blog-one mt-30">
				            <div class="blog-thumb">
					            <img src="<?=SITE_PATH?>/images/news/thumb_<?=$row['image']?>" alt="<?=$row['name_'.$lang_name]?>">
				            </div>
				            <div class="blog-content">
					            <div class="blog-meta">
						            <a href="javascript:void(0)" class="blog-date"><i class="far fa-calendar-alt"></i> <?= strftime('%d.%m.%Y', $row['datetime']);?></a>
					            </div>
					            <h4 class="blog-title">
						            <a href="<?=$site?>/xeber/<?=slugGenerator($row['name_'.$lang_name]).'-'.$row["id"]?>"><?=$row['name_'.$lang_name]?></a>
					            </h4>
					            <div class="btn-area">
						            <a href="<?=$site?>/xeber/<?=slugGenerator($row['name_'.$lang_name]).'-'.$row["id"]?>" class="read-more-btn">
							            <?=$lang24?> <i class="far fa-plus"></i>
						            </a>
					            </div>
				            </div>
			            </div>
		            </div>
					<?php
                }
			?>
		</div>
	</div>
</section>
<!--====== Latest Blog End ======-->
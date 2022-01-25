<!-- Start main-content -->
<div class="main-content-area">
	<!-- Section: home Start -->
	<section id="home">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="d-block w-100" src="<?=SITE_PATH?>/images/sliders/SAGLAM_AILE_UCUN_GENETIK_TESTLER.png" alt="SAĞLAM AİLƏ ÜCÜN GENETİK TESTLƏR">
<!--								<div class="carousel-caption d-none d-md-block">-->
<!--									<h2><span style="background-color: #042A4A; padding: 5px 50px; color: #fff;">Sağlam gələcək, sağlam həyat</span></h2>-->
<!--									<p><span style="background-color: #EB5A22; font-size: 40px; padding: 5px 50px; color: #fff;">Sağlam ailə üçün</span></p>-->
<!--								</div>-->
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="<?=SITE_PATH?>/images/sliders/NESILDEN_NESLE_SAGLAMLIQ.png" alt="NƏSİLDƏN NƏSİLƏ SAĞLAMLIQ">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="<?=SITE_PATH?>/images/sliders/genetik_analizler_fetal_merkez_ns_genetics.png" alt="GENETİK ANALİZLƏR">
							</div>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Section: home End -->

	<!-- Section: About -->
	<section class="bg-no-repeat bg-img-right" data-tm-bg-img="<?=SITE_PATH?>/assets/images/photos/map.png">
		<div class="container pt-lg-90 pb-90 pb-lg-30">
			<div class="section-content mb-100 mb-md-0">
				<div class="row">
					<div class="col-lg-6">
						<div class="tm-sc tm-sc-animated-layer-advanced pt-0 mb-md-100 mb-sm-80">
							<div class="animated-layer-advanced-inner clearfix">
								<div class="tm-about-box">
									<div class="layer-image-wrapper tm-animation move-up z-index-1 text-center">
										<div class="layer-image img-one"> <img class="" src="<?=SITE_PATH?>/images/about/<?=$info_about['image']?>" alt="<?=$info_about['name_'.$lang_name]?>"></div>
									</div>
									<div class="layer-image-wrapper tm-animation move-right d-none d-sm-block z-index-1" data-tm-right="-2%" data-tm-top="40%">
										<div class="layer-image-three">
											<div class="icon bg-theme-colored1"><img src="<?=SITE_PATH?>/assets/images/icon/1.png" alt="Image"></div>
											<div class="layer-shape-round"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="pl-30 pl-lg--0">
							<h2 class="mt-0 mb-30 tm-item-appear-clip-path"><?=$info_about['name_'.$lang_name]?></h2>
							<p class="paragraph mb-30"><?=substr_($info_about['short_text_'.$lang_name],0,400,true,true)?></p>
							<div class="tm-sc-button mt-50">
								<a href="<?=SITE_PATH?>/haqqimizda" class="btn btn-round btn-theme-colored1 btn-lg"><?=$lang23?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Section: Services -->
	<section class="bg-theme-colored2 pb-200 pb-sm--0">
		<div class="container pb-sm-50">
			<div class="section-title">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<div class="tm-sc-section-title section-title text-center mb-60">
							<div class="title-wrapper">
								<h2 class="title text-white"><?=$lang44?></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tm-floating-objects d-none d-xl-block">
			<span class="floating-object-1 tm-animation-floating" data-tm-bg-img="<?=SITE_PATH?>/assets/images/photos/shape1.png" data-tm-width="224" data-tm-height="244" data-tm-top="30%"></span>
			<span class="floating-object-2 tm-animation-scaling" data-tm-bg-img="<?=SITE_PATH?>/assets/images/photos/shape2.png" data-tm-width="460" data-tm-height="427" data-tm-top="-12%" data-tm-left="12%"></span>
			<span class="floating-object-3 tm-animation-flicker" data-tm-bg-img="<?=SITE_PATH?>/assets/images/photos/shape3.png" data-tm-width="460" data-tm-height="427" data-tm-top="-12%" data-tm-right="1%"></span>
			<span class="floating-object-4 tm-animation-slide-horizontal" data-tm-bg-img="<?=SITE_PATH?>/assets/images/photos/shape4.png" data-tm-width="460" data-tm-height="427" data-tm-top="30%" data-tm-right="-10%"></span>
		</div>
	</section>

	<section class="">
		<div class="container pt-0 pb-lg-90">
			<div class="section-content">
				<div class="row">
					<?php
                        $sql_departments=mysqli_query($db,"select * from departments where active=1 order by id desc limit 3");

	                    while($row_departments=mysqli_fetch_assoc($sql_departments))
	                    {
	                    	?>
		                    <div class="col-xl-4 col-lg-6 col-md-6 tm-animation move-up">
			                    <div class="tm-sc-services services-style-current-theme mediku-service-img-iconbox mt-sm-30" data-tm-margin-top="-308px">
				                    <div class="tm-service">
					                    <div class="thumb">
						                    <img src="<?=SITE_PATH?>/images/departments/thumb_<?=$row_departments['image']?>" alt="<?=$row_departments['name_'.$lang_name]?>">
						                    <div class="icon-box">
							                    <img class="icon-img" src="<?=SITE_PATH?>/images/departments/<?=$row_departments['image_icon']?>" alt="<?=$row_departments['name_'.$lang_name]?>">
						                    </div>
					                    </div>
					                    <div class="details">
						                    <h4 class="title"><a href="<?=$site?>/departament/<?=slugGenerator($row_departments['name_'.$lang_name]).'-'.$row_departments["id"]?>"><?=$row_departments['name_'.$lang_name]?></a></h4>
						                    <p><?=substr_(decode_text($row_departments['short_text_'.$lang_name]),0,100,true,true)?></p>
						                    <a class="btn-plain-text-with-arrow" href="<?=$site?>/departament/<?=slugGenerator($row_departments['name_'.$lang_name]).'-'.$row_departments["id"]?>"><?=$lang23?></a>
					                    </div>
				                    </div>
			                    </div>
		                    </div>
							<?php
                        }
					?>
				</div>
			</div>
			<div class="col-sm-12 col-md-12">
				<div class="tm-sc-button text-center mt-10 d-none d-md-block d-sm-none mt-md-15">
					<a href="<?=SITE_PATH?>/departamentler" target="_self" class="btn tm-mediku-btn text-white btn-theme-colored1"><?=$lang57?></a>
				</div>
			</div>
		</div>
	</section>
	<!-- End Services -->

    <?php require_once "includes/middle.php"; ?>

	<!-- Section: Service -->
	<section class="z-index-1" data-tm-bg-color="#f0f3f5">
		<div class="container pb-90 pb-lg-60">
			<div class="section-title">
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="tm-sc-section-title section-title text-center mb-60">
							<div class="title-wrapper">
<!--								<h5 class="subtitle text-theme-colored1 text-uppercase">What we’re offering</h5>-->
								<h2 class="title"><?=$lang19?></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="section-content">
				<div class="row">
					<?php
                    $sql=mysqli_query($db,"select * from services where active=1 order by id desc limit 6");

                    while($row=mysqli_fetch_assoc($sql))
                    {
                    	?>
	                    <div class="col-md-6 col-lg-4 tm-animation move-up">
		                    <div class="tm-sc-iconbox iconbox-style-current-theme mediku-department icon-box animate-icon-on-hover animate-icon-rotate-y mb-30">
			                    <div class="icon-wrapper">
				                    <div class="icon">
					                    <img class="icon-img" src="<?=SITE_PATH?>/images/services/<?=$row['image']?>" alt="<?=$row['name_'.$lang_name]?>">
				                    </div>
			                    </div>
			                    <div class="content text-center">
				                    <h4 class="title"><?=$row['name_'.$lang_name]?></h4>
				                    <p><?=substr_(decode_text($row['short_text_'.$lang_name]),0,100,true,true)?></p>
				                    <a class="btn-plain-text-with-arrow" href="<?=$site?>/service/<?=slugGenerator($row['name_'.$lang_name]).'-'.$row["id"]?>"><?=$lang23?></a>
			                    </div>
		                    </div>
	                    </div>
						<?php
                    }
					?>
				</div>
			</div>

			<div class="col-sm-12 col-md-12">
				<div class="tm-sc-button text-center mt-10 d-none d-md-block d-sm-none mt-md-15">
					<a href="<?=SITE_PATH?>/services" target="_self" class="btn tm-mediku-btn text-white btn-theme-colored1"><?=$lang47?></a>
				</div>
			</div>
		</div>
		<div class="cp-shape layer-shape-style4">
			<div class="layer-shape-one" data-tm-bg-img="<?=SITE_PATH?>/assets/images/photos/bg-shape2.png"></div>
		</div>
	</section>
	<!-- End Divider -->

	<!-- Section: Gallery -->
	<section class="">
		<div class="container-fluid pt-10 p-0">
			<div class="section-content">
				<div class="row">
					<div class="col-sm-12">
						<div class="tm-sc-gallery tm-sc-gallery-grid gallery-style1-current-theme">
							<!-- Isotope Gallery Grid -->
							<div id="gallery-holder-743344" class="isotope-layout grid-5 gutter-5 clearfix lightgallery-lightbox">
								<div class="isotope-layout-inner">
									<!-- the loop -->
									<?php
                                    $sql_albums=mysqli_query($db,"select * from photo_albums where active=1 order by position desc LIMIT 5");

                                    while($row_albums = mysqli_fetch_assoc($sql_albums))
                                    {
                                    	?>
	                                    <!-- Isotope Item Start -->
	                                    <div class="isotope-item">
		                                    <div class="isotope-item-inner mediku-gallery">
			                                    <div class="tm-gallery">
				                                    <div class="tm-gallery-inner">
					                                    <div class="thumb">
						                                    <a href="#"><img src="<?=SITE_PATH?>/images/photo_albums/thumb_<?=$row_albums['image']?>" class="" alt="<?=$row_albums['name_'.$lang_name]?>"/></a>
					                                    </div>
					                                    <div class="tm-gallery-content-wrapper">
						                                    <div class="tm-gallery-content">
							                                    <div class="tm-gallery-content-inner">
								                                    <div class="icons-holder-inner">
									                                    <div class="styled-icons">
										                                    <a class="lightgallery-trigger styled-icons-item bg-theme-colored1" data-exthumbimage="<?=SITE_PATH?>/images/photo_albums/<?=$row_albums['image']?>" title="<?=$row_albums['name_'.$lang_name]?>" href="<?=SITE_PATH?>/images/photo_albums/<?=$row_albums['image']?>"><i class="fa fa-plus"></i></a>
									                                    </div>
								                                    </div>
								                                    <div class="title-holder">
									                                    <h4 class="title"><a href="<?=$site?>/fotoqalereya/<?=slugGenerator($row_albums['name_'.$lang_name]).'-'.$row_albums["id"]?>"><?=$row_albums['name_'.$lang_name]?></a></h4>
								                                    </div>
							                                    </div>
						                                    </div>
					                                    </div>
				                                    </div>
			                                    </div>
		                                    </div>
	                                    </div>
	                                    <!-- Isotope Item End -->
										<?php
                                    }
									?>

									<!-- end of the loop -->
								</div>
							</div>
							<!-- End Isotope Gallery Grid -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Projects -->

	<!-- Section: Team -->
	<section class="bg-white-f5">
		<div class="container pb-90">
			<div class="section-title">
				<div class="row justify-content-md-center">
					<div class="col-md-5 col-sm-12">
						<div class="text-center mb-60">
							<div class="tm-sc tm-sc-section-title section-title">
								<div class="title-wrapper">
									<h2 class="title"><?=$lang48?></h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="section-content">
				<div class="slick_slider row" data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "arrows":true, "autoplay":false, "dots":false, "infinite":true, "responsive": [{"breakpoint":1200,"settings":{"slidesToShow": 4}}, {"breakpoint":1024,"settings":{"slidesToShow": 4}}, {"breakpoint":777,"settings":{"slidesToShow": 3}}, {"breakpoint":575,"settings":{"slidesToShow": 2}}]}'>
					<?php
                    $sql_doctors=mysqli_query($db,"select * from doctors where active=1 order by position desc");

                    while($row_doctors = mysqli_fetch_assoc($sql_doctors))
                    {
                    	?>
	                    <div class="col-md-6 col-lg-6 col-xl-3">
		                    <div class="team-item mb-30">
			                    <div class="team-thumb">
				                    <img class="w-100" src="<?=SITE_PATH."/images/doctors/".$row_doctors['image']?>" alt="<?=$row_doctors['name_'.$lang_name]?>">
			                    </div>
			                    <div class="team-content">
				                    <div class="team-information">
					                    <h4 class="team-name"><a href="<?=$site?>/hekim/<?=slugGenerator($row_doctors['name_'.$lang_name]).'-'.$row_doctors["id"]?>"><?=$row_doctors['name_'.$lang_name]?></a></h4>
					                    <h6 class="designation mb-0"><?=$row_doctors['position_'.$lang_name]?></h6>
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
		<div class="tm-floating-objects">
			<span class="floating-object-1 tm-animation-floating" data-tm-bg-img="<?=SITE_PATH?>/assets/images/photos/shape4.png" data-tm-opacity="0.2" data-tm-width="161" data-tm-height="189" data-tm-top="15%"></span>
			<span class="floating-object-2 tm-animation-spin" data-tm-bg-img="<?=SITE_PATH?>/assets/images/photos/shape2.png" data-tm-opacity="0.2" data-tm-width="204" data-tm-height="199" data-tm-top="65%"></span>
		</div>
	</section>

	<!-- Section: Videogallery-->
	<section data-tm-bg-color="#f7f7f7">
		<div class="container pt-lg-90 pb-lg-60">
			<div class="section-title">
				<div class="row">
					<div class="col-md-8">
						<div class="tm-sc tm-sc-section-title section-title">
							<div class="title-wrapper mb-0">
								<h2 class="mt-0 mb-0"><?=$lang28?></h2>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="tm-sc-button text-right mt-10 d-none d-md-block d-sm-none mt-md-15">
							<a href="<?=SITE_PATH?>/videoqalereya" target="_self" class="btn tm-mediku-btn text-white btn-theme-colored1"><?=$lang30?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="section-content">
				<div class="row">
					<?php
                        $home_videogallery = mysqli_query($db, "select * from videogallery where active=1 LIMIT 3");

                        $i = 1;
	                    while($row_videogallery = mysqli_fetch_assoc($home_videogallery))
	                    {
	                    	?>
		                    <div class="col-md-4 col-lg-4 tm-animation move-up<?=$i == 1 ? '' : $i?>">
			                    <div class="tm-sc-blog tm-mediku tm-sc-blog-masonry blog-style1-current-theme mb-lg-30">
				                    <article class="post type-post status-publish format-standard has-post-thumbnail">
					                    <div class="entry-header">
						                    <div class="post-thumb lightgallery-lightbox featured-thumbnail youtube-video-place" data-yt-url="https://www.youtube.com/embed/<?=youtube_embed($row_videogallery['video_url'])?>?rel=0&showinfo=0&autoplay=1">
							                    <div class="post-thumb-inner">
								                    <div class="thumb border-radius-0">
									                    <div class="videos" style="position: relative;">
									                    <img src="<?=SITE_PATH?>/assets/images/youtube-play.png" class="play-youtube" style="position: absolute;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%, -50%); cursor: pointer; width:15%; z-index: 99; min-width: auto;" />

									                    <img class="img-fullwidth" src="http://img.youtube.com/vi/<?=youtube_embed($row_videogallery['video_url'])?>/maxresdefault.jpg" alt="<?=$row_videogallery['name_' . $lang_name]?>">
									                    </div>
								                    </div>
							                    </div>
						                    </div>
					                    </div>
					                    <div class="entry-content">
						                    <h4 class="entry-title"><a href="javascript:void(0);" rel="bookmark"><?=$row_videogallery['name_' . $lang_name]?></a></h4>
						                    <div class="clearfix"></div>
					                    </div>
				                    </article>
			                    </div>
		                    </div>
							<?php
		                    $i++;
                        }
					?>
				</div>
			</div>
		</div>
	</section>
	<!-- End Videogallery -->

	<!-- Section: News & Updates-->
	<section data-tm-bg-color="#f7f7f7">
		<div class="container pt-lg-90 pb-lg-60">
			<div class="section-title">
				<div class="row">
					<div class="col-md-8">
						<div class="tm-sc tm-sc-section-title section-title">
							<div class="title-wrapper mb-0">
								<h2 class="mt-0 mb-0"><?=$lang35?></h2>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="tm-sc-button text-right mt-10 d-none d-md-block d-sm-none mt-md-15">
							<a href="<?=SITE_PATH?>/bloq" target="_self" class="btn tm-mediku-btn text-white btn-theme-colored1"><?=$lang49?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="section-content">
				<div class="row">
					<?php
	                    $home_news=mysqli_query($db,"select * from news where active=1 order by id desc LIMIT 2");

	                    $j=1;
	                    while($row_news = mysqli_fetch_assoc($home_news))
	                    {
	                        ?>
		                    <div class="col-md-6 col-lg-6 tm-animation move-up<?=$j == 1 ? '' : $j?>">
			                    <div class="tm-sc-blog tm-mediku tm-sc-blog-masonry blog-style1-current-theme mb-lg-30">
				                    <article class="post type-post status-publish format-standard has-post-thumbnail">
					                    <div class="entry-header">
						                    <div class="post-thumb lightgallery-lightbox">
							                    <div class="post-thumb-inner">
								                    <div class="thumb border-radius-0">
									                    <img class="img-fullwidth" src="<?=SITE_PATH?>/images/news/thumb_<?=$row_news['image']?>" alt="<?=$row_news['name_'.$lang_name]?>" alt="<?=$row_news['name_'.$lang_name]?>">
									                    <div class="date bg-theme-colored1 text-white text-center text-uppercase font-size-12 letter-space-1"><?= strftime('%d.%m.%Y', $row_news['datetime']);?></div>
								                    </div>
							                    </div>
						                    </div>
					                    </div>
					                    <div class="entry-content">
						                    <h4 class="entry-title"><a href="<?=$site?>/xeber/<?=slugGenerator($row_news['name_'.$lang_name]).'-'.$row_news["id"]?>" rel="bookmark"><?=$row_news['name_'.$lang_name]?></a></h4>
						                    <p class="mb-0"><?=substr_(decode_text($row_news['short_text_'.$lang_name]),0,100,true,true)?></p>
						                    <div class="clearfix"></div>
					                    </div>
				                    </article>
			                    </div>
		                    </div>
							<?php
		                    $j++;
	                    }
					?>
				</div>
			</div>
		</div>
	</section>
	<!-- End News -->
</div>
<!-- end main-content -->
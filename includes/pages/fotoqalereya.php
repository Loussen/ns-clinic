<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<section>
	<div class="container pb-90">
		<div class="section-content">
			<div class="row">
				<div class="col-md-12">
					<div class="tm-sc-gallery tm-sc-gallery-grid gallery-style1-basic">
						<!-- End Isotope Filter -->
						<!-- Isotope Gallery Grid -->
						<div id="gallery-holder-618422" class="isotope-layout grid-3 gutter-15 clearfix lightgallery-lightbox">
							<div class="isotope-layout-inner">
                                <?php
                                $gallery = mysqli_query($db,"select * from photo_albums_gallery where active=1 and parent_id='$id'");
                                while($row_gallery=mysqli_fetch_assoc($gallery))
                                {
                                    ?>
									<!-- Isotope Item Start -->
									<div class="isotope-item">
										<div class="isotope-item-inner">
											<div class="tm-gallery">
												<div class="tm-gallery-inner">
													<div class="thumb">
														<a href="#">
															<img width="672" height="448" src="<?=SITE_PATH?>/images/photo_albums_gallery/<?=$info_data['id']."/thumb_".$row_gallery['image']?>" alt="<?=$row_gallery['name_'.$lang_name]?>" class="" />
														</a>
													</div>
													<div class="tm-gallery-content-wrapper">
														<div class="tm-gallery-content">
															<div class="tm-gallery-content-inner">
																<div class="icons-holder-inner">
																	<div class="styled-icons icon-dark icon-circled icon-theme-colored1">
																		<a class="lightgallery-trigger styled-icons-item" data-exthumbimage="<?=SITE_PATH?>/images/photo_albums_gallery/<?=$info_data['id']."/".$row_gallery['image']?>" data-src="<?=SITE_PATH?>/images/photo_albums_gallery/<?=$info_data['id']."/".$row_gallery['image']?>" title="<?=$row_gallery['name_'.$lang_name]?>" href="<?=SITE_PATH?>/images/photo_albums_gallery/<?=$info_data['id']."/".$row_gallery['image']?>"><i class="fa fa-plus"></i></a>
																	</div>
																</div>
																<div class="title-holder">
																	<h5 class="title"><a href="javascript:void(0);"><?=$row_gallery['name_'.$lang_name]?></a></h5>
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
							</div>
						</div>
						<!-- End Isotope Gallery Grid -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
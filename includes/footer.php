<!--====== Back to Top Start ======-->
<a class="back-to-top" href="#">
	<i class="far fa-angle-up"></i>
</a>
<!--====== Back to Top End ======-->

<!--====== Start Template Footer ======-->
<footer class="template-footer have-cta-boxed-one">
	<div class="footer-inner bg-color-grey">
		<div class="container">
			<div class="footer-widgets">
				<div class="row">
					<div class="col-lg-5 col-md-7">
						<div class="widget text-widget">
							<div class="footer-logo">
								<img src="<?=SITE_PATH?>/assets/img/logo.png" alt="<?=$info_about['name_'.$lang_name]?>">
							</div>
							<p>
                                <?=substr_($info_contacts['footer_'.$lang_name],0,400,true,true)?>
							</p>

						</div>
					</div>
					<div class="col-lg-7 col-md-5">
						<div class="row">
							<div class="col-xl-6 col-md-6">
								<div class="widget nav-widget">
									<h4 class="widget-title"><?=$lang25?></h4>
									<ul class="nav-links">
									<?php
                                        $footer_menu_1 = mysqli_query($db, "select * from menus where active=1 order by position");

	                                    while($row = mysqli_fetch_assoc($footer_menu_1))
	                                    {
		                                    if (trim($row["link"]) != '' && trim($row["link"]) != '#')
		                                    {
		                                        $href = $site . '/' . $row["link"];
		                                        ?>
			                                    <li><a href="<?=$href?>"><?=$row['name_'.$lang_name]?></a></li>
		                                        <?php
		                                    }
	                                    }
									?>
									</ul>
								</div>
							</div>
							<div class="col-xl-6 col-md-6">
								<div class="widget text-widget">
									<h4 class="widget-title"><?=$lang26?></h4>
									<ul class="contact-list">
										<li>
											<a href="https://goo.gl/maps/inpkL6wUZqMR3opX7"><i class="far fa-map-marker-alt"></i><?=$info_contacts['text_'.$lang_name]?></a>
										</li>
										<li>
											<a href="mailto:<?=$info_contacts['email']?>"><i class="far fa-envelope"></i><?=$info_contacts['email']?></a>
										</li>
										<li>
											<a href="tel:<?=$info_contacts['phone']?>"><i class="far fa-phone"></i><?=$info_contacts['phone']?></a>
										</li>
									</ul>
								</div>
							</div>
<!--							<div class="col-xl-6 col-md-6">-->
<!--								<div class="widget instagram-widget">-->
<!--									<h4 class="widget-title">Photo Gallery</h4>-->
<!--									<div class="instagram-images">-->
<!--										<div class="single-image">-->
<!--											<img src="--><?//=SITE_PATH?><!--/assets/img/instagram/01.jpg" alt="Instagram">-->
<!--											<a href="#"><i class="fab fa-instagram"></i></a>-->
<!--										</div>-->
<!--										<div class="single-image">-->
<!--											<img src="--><?//=SITE_PATH?><!--/assets/img/instagram/02.jpg" alt="Instagram">-->
<!--											<a href="#"><i class="fab fa-instagram"></i></a>-->
<!--										</div>-->
<!--										<div class="single-image">-->
<!--											<img src="--><?//=SITE_PATH?><!--/assets/img/instagram/03.jpg" alt="Instagram">-->
<!--											<a href="#"><i class="fab fa-instagram"></i></a>-->
<!--										</div>-->
<!--										<div class="single-image">-->
<!--											<img src="--><?//=SITE_PATH?><!--/assets/img/instagram/04.jpg" alt="Instagram">-->
<!--											<a href="#"><i class="fab fa-instagram"></i></a>-->
<!--										</div>-->
<!--										<div class="single-image">-->
<!--											<img src="--><?//=SITE_PATH?><!--/assets/img/instagram/05.jpg" alt="Instagram">-->
<!--											<a href="#"><i class="fab fa-instagram"></i></a>-->
<!--										</div>-->
<!--										<div class="single-image">-->
<!--											<img src="--><?//=SITE_PATH?><!--/assets/img/instagram/06.jpg" alt="Instagram">-->
<!--											<a href="#"><i class="fab fa-instagram"></i></a>-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
						</div>
					</div>
				</div>
			</div>
			<div class="copyright-area">
				<p>© <?=date('Y')." ".$lang27?></p>
			</div>
		</div>
	</div>
</footer>
<!--====== End Template Footer ======-->
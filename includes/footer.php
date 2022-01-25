<!-- Footer -->
<footer id="footer" class="footer mediku-footer bg-theme-colored2" data-tm-bg-img="<?=SITE_PATH?>/assets/images//footer-bg.png">
	<div class="footer-widget-area">
		<div class="container pt-90 pb-20">
			<div class="row">
				<div class="col-md-6 col-lg-6 col-xl-4 pl-0 pl-lg-15">
					<div class="widget tm-widget-contact-info contact-info-style1 contact-icon-theme-colored1">
						<h4 class="widget-title"><?=$lang17?></h4>
						<div class="description"><?=substr_($info_contacts['footer_'.$lang_name],0,200,true,true)?></div>
						<ul class="styled-icons icon-dark icon-md icon-theme-colored1 icon-circled clearfix">
							<li><a class="social-link" href="<?=$info_contacts['facebook']?>" ><i class="fab fa-facebook"></i></a></li>
							<li><a class="social-link" href="<?=$info_contacts['youtube']?>" ><i class="fab fa-youtube"></i></a></li>
							<li><a class="social-link" href="<?=$info_contacts['instagram']?>" ><i class="fab fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-6 col-xl-4">
					<div class="widget widget_nav_menu split-nav-menu clearfix">
						<h4 class="widget-title"><?=$lang50?></h4>
						<ul class="menu">
                            <?php
                            $footer_menu_1 = mysqli_query($db, "select * from menus where active=1 order by position");

                            while($row = mysqli_fetch_assoc($footer_menu_1))
                            {
                                if (trim($row["link"]) != '' && trim($row["link"]) != '#')
                                {
                                    $href = $site . '/' . $row["link"];
                                    ?>
									<li><a href="<?=$href?>"> <?=$row['name_'.$lang_name]?></a></li>
                                    <?php
                                }
                            }
                            ?>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-6 col-xl-4">
					<div class="widget widget-contact clearfix mb-0 mt-lg-40">
						<h4 class="widget-title"><?=$lang16?></h4>
						<div class="tm-widget tm-widget-contact">
							<ul class="contact-info">
								<li class="contact-address"><i class="fas fa-map-marked-alt font-icon sm-display-block text-theme-colored1 mr-10"></i> <?=$info_contacts['text_'.$lang_name]?></li>
								<li class="contact-email"><i class="fas fa-envelope font-icon sm-display-block text-theme-colored1 mr-10"></i> <?=$info_contacts['email']?></li>
								<li class="contact-phone"><i class="fas fa-phone font-icon sm-display-block text-theme-colored1 mr-10"></i> Tel: <?=$info_contacts['phone']?></li>
							</ul>
							<div class="tm-sc-button">
								<a href="<?=SITE_PATH?>/elaqe" style="color: #fff;" class="btn btn-theme-colored1 tm-mediku-btn btn-flat"><?=$lang9?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container footer-bottom-border-top">
				<div class="row justify-content-center pt-20 pb-20">
					<div class="col-lg-8">
						<div class="footer-paragraph text-center">
							© Copyright <?=date('Y')?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- Header -->
<header id="header" class="header header-layout-type-header-2rows">
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-xl-auto header-top-left align-self-center text-center text-xl-left">
					<ul class="element contact-info">
						<li class="contact-phone"><i
									class="fa fa-phone font-icon sm-display-block"></i> <?= $info_contacts['phone'] ?>
						</li>
						<li class="contact-email"><i
									class="fa fa-envelope font-icon sm-display-block"></i> <?= $info_contacts['email'] ?>
						</li>
						<li class="contact-address"><i
									class="fa fa-map font-icon sm-display-block"></i> <?= $info_contacts['text_' . $lang_name] ?>
						</li>
					</ul>
				</div>
				<div class="col-xl-auto ml-xl-auto header-top-right align-self-center text-center text-xl-right">
					<div class="element pt-0 pb-0">
						<ul class="styled-icons icon-dark icon-theme-colored1 icon-circled clearfix">
							<li><a class="social-link" href="<?= $info_contacts['facebook'] ?>"><i
											class="fab fa-facebook"></i></a></li>
							<li><a class="social-link" href="<?= $info_contacts['instagram'] ?>"><i
											class="fab fa-instagram"></i></a></li>
							<li><a class="social-link" href="<?= $info_contacts['youtube'] ?>"><i
											class="fab fa-youtube"></i></a></li>
						</ul>
					</div>
					<div class="element pt-0 pt-lg-10 pb-0">
						<a href="<?=$do == 'home' ? '#appointment_title' : SITE_PATH."#appointment_title"?>"
						   class="btn btn-theme-colored2 btn-flat btn-sm"><?= $lang10 ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-nav tm-enable-navbar-hide-on-scroll">
		<div class="header-nav-wrapper navbar-scrolltofixed">
			<div class="menuzord-container header-nav-container">
				<div class="container position-relative">
					<div class="row header-nav-col-row">
						<div class="col-sm-auto align-self-center">
							<a class="menuzord-brand site-brand" href="<?= SITE_PATH ?>"> <img
										class="logo-default logo-1x" src="<?= SITE_PATH ?>/assets/images/Fetal_Merkez_NS_Genetics_klinikasi_logo.png"
										alt="<?= $info_description['title_' . $lang_name] ?>"> <img
										class="logo-default logo-2x retina"
										src="<?= SITE_PATH ?>/assets/images/Fetal_Merkez_NS_Genetics_klinikasi_logo.png"
										alt="<?= $info_description['title_' . $lang_name] ?>"> </a>
						</div>
						<div class="col-sm-auto ml-auto pr-0 align-self-center">
							<nav id="top-primary-nav" class="menuzord orange" data-effect="fade" data-animation="none"
							     data-align="right">

								<ul id="main-nav" class="menuzord-menu">
                                    <?php
	                                    $sql_menus = mysqli_query($db, "select * from menus where parent_id=0 and active=1 order by position");
                                        while ($row_menus = mysqli_fetch_assoc($sql_menus)) {
                                            $sub_sql = mysqli_query($db, "select * from menus where parent_id='$row_menus[id]' and active=1 order by position");
                                            $sub_count = mysqli_num_rows($sub_sql);

                                            if ($sub_count > 0) {
                                                $sub_menu = true;
                                            } else {
                                                $sub_menu = false;
                                            }

                                            if ($row_menus["link"] != '' && $row_menus["link"] != '#') $href = $site . '/' . $row_menus["link"];
	                                        elseif ($row_menus["link"] == '#') $href = 'javascript::void(0);';
                                            else $href = $site . '/pages/' . slugGenerator($row_menus["name_" . $lang_name], '-', false, $lang_name) . '-' . $row_menus["id"];

                                            if($sub_menu == false) {
												?>
	                                            <li><a href="<?= $href ?>"><?= $row_menus["name_" . $lang_name] ?></a></li>
												<?php
                                            }

                                            if ($sub_menu == true) {
                                            	?>
												<li>
													<a href="<?= $href ?>"><?= $row_menus["name_" . $lang_name] ?></a>
													<ul class="dropdown">
                                                        <?php
                                                        while ($row2 = mysqli_fetch_assoc($sub_sql)) {
                                                            if ($row2["link"] != '') $href = $site . '/' . $row2["link"];
                                                            else $href = $site . '/pages/' . slugGenerator($row2["name_" . $lang_name], '-', true, $lang_name) . '-' . $row2["id"];

                                                            echo '<li><a href="' . $href . '">' . $row2["name_" . $lang_name] . '</a></li>';
                                                        }
                                                        ?>
													</ul>
												</li>
												<?php
                                            }
                                        }

                                    ?>

									<li>
                                        <?php
	                                        if($lang_name=='az') $lname='AZ';
											elseif($lang_name=='ru') $lname='RU';
                                        ?>

										<a style="background-color: #fc6a20; color: #fff;" href="<?= $href ?>"><?= $lname ?></a>
										<ul class="dropdown">
											<li><a href="<?=SITE_PATH?>/index.php?change_lang_name=az">AZ</a></li>
											<li><a href="<?=SITE_PATH?>/index.php?change_lang_name=ru">RU</a></li>
										</ul>
									</li>
								</ul>
							</nav>
						</div>
						<div class="col-sm-auto align-self-center nav-side-icon-parent">
							<ul class="list-inline nav-side-icon-list">

								<li class="hidden-mobile-mode">
									<div id="side-panel-trigger" class="side-panel-trigger"><a href="#">
											<div class="hamburger-box">
												<div class="hamburger-inner"></div>
											</div>
										</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="row d-block d-xl-none">
						<div class="col-12">
							<nav id="top-primary-nav-clone"
							     class="menuzord d-block d-xl-none default menuzord-color-default menuzord-border-boxed menuzord-responsive"
							     data-effect="slide" data-animation="none" data-align="right">
								<ul id="main-nav-clone"
								    class="menuzord-menu menuzord-right menuzord-indented scrollable"></ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
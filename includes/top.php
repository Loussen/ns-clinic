<!--====== Start Template Header ======-->
<header class="template-header sticky-header header-one absolute-header">
	<div class="container-fluid container-1400">
		<div class="header-navigation">
			<div class="header-left">
				<div class="site-logo">
					<a href="index.html">
						<img src="<?=SITE_PATH?>/assets/img/logo.png" alt="Seeva">
					</a>
				</div>
				<nav class="site-menu menu-gap-left d-none d-xl-block">
					<ul class="primary-menu">
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
			                            <ul class="sub-menu">
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
					</ul>
				</nav>
			</div>
			<div class="header-right">
				<ul class="extra-icons">
					<li class="d-none d-xl-block">
						<div class="off-canvas-btn style-two">
							<span></span>
						</div>
					</li>
					<li class="d-xl-none">
						<a href="#" class="navbar-toggler">
							<span></span>
							<span></span>
							<span></span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- Start Off Canvas -->
    <?php require_once "includes/sidebar.php" ?>
	<!-- End Off Canvas -->

	<!-- Start Mobile Panel -->
	<div class="slide-panel mobile-slide-panel">
		<div class="panel-overlay"></div>
		<div class="panel-inner">
			<div class="panel-logo">
				<img src="<?=SITE_PATH?>/assets/img/logo.png" alt="">
			</div>
			<nav class="mobile-menu">
				<ul class="primary-menu">
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
								<ul class="sub-menu">
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
				</ul>
			</nav>
			<a href="#" class="panel-close">
				<i class="fal fa-times"></i>
			</a>
		</div>
	</div>
	<!-- Start Mobile Panel -->
</header>
<!--====== End Template Header ======-->
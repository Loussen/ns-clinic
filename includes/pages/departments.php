<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<section class="">
	<div class="container pt-0 pb-lg-90 mt-50">
		<div class="section-content">
			<div class="row">
                <?php
                $limit = 6;
                if (isset($_GET["page"])) $page = intval($_GET["page"]); else $page = 1;
                $max_data = mysqli_num_rows(mysqli_query($db, "select id from departments where active='1'"));
                $max_page = ceil($max_data / $limit);
                if ($page > $max_page) $page = $max_page;
                if ($page < 1) $page = 1;
                $start = $page * $limit - $limit;

                $sql_departments = mysqli_query($db, "select * from departments where active=1 order by id desc limit $start, $limit");

                while($row_departments=mysqli_fetch_assoc($sql_departments))
                {
                    ?>
					<div class="col-xl-4 col-lg-6 col-md-6 tm-animation move-up mb-20">
						<div class="tm-sc-services services-style-current-theme mediku-service-img-iconbox">
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

			<div class="pagination-block">
                <?php
                if ($max_data > 6) {
                    $show = 3;
                    if ($page > $show + 1) echo '<a class="next page-numbers" href="?page=' . ($page - 1) . '"><i class="ti ti-arrow-left"></i></a>';
                    for ($i = $page - $show; $i <= $page + $show; $i++) {
                        if ($i > 0 && $i <= $max_page) {
                            if ($i == $page) {
                                echo '<span class="page-numbers current">'.$i.'</span>';
                            } else {
                                $href = '?page=' . $i;
                                echo '<a class="page-numbers" href="'.$href.'">'.$i.'</a>';
                            }
                        }
                    }
                    if ($page < $max_page - $show && $max_page > 1) echo '<a class="next page-numbers" href="?page=' . ($page + 1) . '"><i class="ti ti-arrow-right"></i></a>';
                }
                ?>
			</div>
		</div>
	</div>
</section>
<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

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
			<div class="row">
                <?php
                $limit = 8;
                if (isset($_GET["page"])) $page = intval($_GET["page"]); else $page = 1;
                $max_data = mysqli_num_rows(mysqli_query($db, "select id from doctors where active='1'"));
                $max_page = ceil($max_data / $limit);
                if ($page > $max_page) $page = $max_page;
                if ($page < 1) $page = 1;
                $start = $page * $limit - $limit;

                $sql_doctors = mysqli_query($db, "select * from doctors where active=1 order by id desc limit $start, $limit");

                while($row_doctors=mysqli_fetch_assoc($sql_doctors))
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
</section>
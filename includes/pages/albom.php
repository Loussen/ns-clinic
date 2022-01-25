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
	                                $limit = 6;
	                                if (isset($_GET["page"])) $page = intval($_GET["page"]); else $page = 1;
	                                $max_data = mysqli_num_rows(mysqli_query($db, "select id from photo_albums where active='1'"));
	                                $max_page = ceil($max_data / $limit);
	                                if ($page > $max_page) $page = $max_page;
	                                if ($page < 1) $page = 1;
	                                $start = $page * $limit - $limit;

	                                $sql = mysqli_query($db, "select * from photo_albums where active=1 order by id desc limit $start, $limit");
                                    while ($row = mysqli_fetch_assoc($sql))
                                    {
                                    	?>
	                                    <!-- Isotope Item Start -->
	                                    <div class="isotope-item">
		                                    <div class="isotope-item-inner">
			                                    <div class="tm-gallery">
				                                    <div class="tm-gallery-inner">
					                                    <div class="thumb">
						                                    <a href="#">
							                                    <img width="672" height="448" src="<?=SITE_PATH?>/images/photo_albums/<?="thumb_".$row['image']?>" alt="<?=$row['name_'.$lang_name]?>" class="" />
						                                    </a>
					                                    </div>
					                                    <div class="tm-gallery-content-wrapper">
						                                    <div class="tm-gallery-content">
							                                    <div class="tm-gallery-content-inner">
								                                    <div class="icons-holder-inner">
									                                    <div class="styled-icons icon-dark icon-circled icon-theme-colored1">
										                                    <a class="lightgallery-trigger styled-icons-item" data-exthumbimage="<?=SITE_PATH?>/images/photo_albums/<?=$row['image']?>" data-src="<?=SITE_PATH?>/images/photo_albums/<?=$row['image']?>" title="<?=$row['name_'.$lang_name]?>" href="<?=SITE_PATH?>/images/photo_albums/<?=$row['image']?>"><i class="fa fa-plus"></i></a>
										                                    <a class="styled-icons-item" title="<?=$row['name_'.$lang_name]?>" href="<?=$site?>/fotoqalereya/<?=slugGenerator($row['name_'.$lang_name]).'-'.$row["id"]?>"><i class="fa fa-link"></i></a>
									                                    </div>
								                                    </div>
								                                    <div class="title-holder">
									                                    <h5 class="title"><a href="<?=$site?>/fotoqalereya/<?=slugGenerator($row['name_'.$lang_name]).'-'.$row["id"]?>"><?=$row['name_'.$lang_name]?></a></h5>
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
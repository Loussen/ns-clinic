<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<section>
	<div class="container">
		<div class="section-content">
			<div class="row">
				<?php
	                $limit=6;
	                if(isset($_GET["page"])) $page=intval($_GET["page"]); else $page=1;
	                $max_data=mysqli_num_rows(mysqli_query($db,"select id from news where active='1'"));
	                $max_page=ceil($max_data/$limit);
	                if($page>$max_page) $page=$max_page;
	                if($page<1) $page=1;
	                $start=$page*$limit-$limit;

	                $sql=mysqli_query($db,"select * from news where active=1 order by id desc limit $start, $limit");

	                while($row=mysqli_fetch_assoc($sql))
					{
						?>
						<div class="col-md-6 col-lg-4 tm-animation move-up">
							<div class="tm-sc-blog tm-mediku tm-sc-blog-masonry blog-style1-current-theme mb-30">
								<article class="post type-post status-publish format-standard has-post-thumbnail">
									<div class="entry-header">
										<div class="post-thumb lightgallery-lightbox">
											<div class="post-thumb-inner">
												<div class="thumb border-radius-0">
													<img class="img-fullwidth" src="<?=SITE_PATH?>/images/news/thumb_<?=$row['image']?>" alt="<?=$row['name_'.$lang_name]?>">
													<div class="date bg-theme-colored1 text-white text-center text-uppercase font-size-12 letter-space-1"><?= strftime('%d.%m.%Y', $row['datetime']);?></div>
												</div>
											</div>
										</div>
									</div>
									<div class="entry-content">
										<h4 class="entry-title"><a href="<?=$site?>/xeber/<?=slugGenerator($row['name_'.$lang_name]).'-'.$row["id"]?>" rel="bookmark"><?=$row['name_'.$lang_name]?></a></h4>
										<p class="mb-0"><?=substr_(decode_text($row['short_text_'.$lang_name]),0,100,true,true)?></p>
										<div class="clearfix"></div>
									</div>
								</article>
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
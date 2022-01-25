<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<!-- Section: Videogallery-->
<section data-tm-bg-color="#f7f7f7">
	<div class="container pt-lg-90 pb-lg-60">
		<div class="section-content">
			<div class="row">
                <?php
                $limit=6;
                if(isset($_GET["page"])) $page=intval($_GET["page"]); else $page=1;
                $max_data=mysqli_num_rows(mysqli_query($db,"select id from videogallery where active='1'"));
                $max_page=ceil($max_data/$limit);
                if($page>$max_page) $page=$max_page;
                if($page<1) $page=1;
                $start=$page*$limit-$limit;

                $sql=mysqli_query($db,"select * from videogallery where active=1 order by `position` asc limit $start, $limit");

                $i = 1;
                while($row = mysqli_fetch_assoc($sql))
                {
                    ?>
					<div class="col-md-4 col-lg-4 tm-animation mb-20 move-up">
						<div class="tm-sc-blog tm-mediku tm-sc-blog-masonry blog-style1-current-theme mb-lg-30">
							<article class="post type-post status-publish format-standard has-post-thumbnail">
								<div class="entry-header">
									<div class="post-thumb lightgallery-lightbox featured-thumbnail youtube-video-place" data-yt-url="https://www.youtube.com/embed/<?=youtube_embed($row['video_url'])?>?rel=0&showinfo=0&autoplay=1">
										<div class="post-thumb-inner">
											<div class="thumb border-radius-0">
												<div class="videos" style="position: relative;">
													<img src="<?=SITE_PATH?>/assets/images/youtube-play.png" class="play-youtube" style="position: absolute;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%, -50%); cursor: pointer; width:15%; z-index: 99; min-width: auto;" />

													<img class="img-fullwidth" src="http://img.youtube.com/vi/<?=youtube_embed($row['video_url'])?>/maxresdefault.jpg" alt="<?=$row['name_' . $lang_name]?>">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="entry-content">
									<h4 class="entry-title"><a href="javascript:void(0);" rel="bookmark"><?=$row['name_' . $lang_name]?></a></h4>
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
<!-- End Videogallery -->
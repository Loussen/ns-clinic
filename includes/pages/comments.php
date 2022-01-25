<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<section class="ttm-row services-section clearfix">
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-lg-12">
				<!-- section title -->
				<div class="section-title title-style-center_text">
					<div class="title-header">
						<h3><?=$info_menu['name_'.$lang_name]?></h3>
						<h2 class="title"><?=$lang2?></h2>
					</div>
					<div class="heading-seperator"><span></span></div>
					<div class="title-desc">
						<p><?=$lang3?></p>
					</div>
				</div><!-- section title end -->
			</div>
		</div>
		<div class="row">
            <?php
            $limit=6;
            if(isset($_GET["page"])) $page=intval($_GET["page"]); else $page=1;
            $max_data=mysqli_num_rows(mysqli_query($db,"select id from patients where active='1'"));
            $max_page=ceil($max_data/$limit);
            if($page>$max_page) $page=$max_page;
            if($page<1) $page=1;
            $start=$page*$limit-$limit;

            $sql=mysqli_query($db,"select * from patients where active=1 order by `position` asc limit $start, $limit");

            while($row=mysqli_fetch_assoc($sql)) {
                ?>
				<div class="col-md-4 col-sm-6">
					<!--featured-imagebox-->
					<div class="featured-imagebox featured-imagebox-services style1">
						<!-- featured-thumbnail -->
						<div class="featured-thumbnail youtube-video-place" data-yt-url="https://www.youtube.com/embed/<?=youtube_embed($row['video_url'])?>?rel=0&showinfo=0&autoplay=1">
							<div class="videos" style="position: relative;">
								<img src="<?=SITE_PATH?>/assets/images/youtube-play.png" class="play-youtube" style="position: absolute;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%, -50%); cursor: pointer; width:15%; z-index: 99; min-width: auto;" />
								<img width="768" height="512" class="img-fluid" src="http://img.youtube.com/vi/<?=youtube_embed($row['video_url'])?>/maxresdefault.jpg" alt="image">
							</div>
						</div><!-- featured-thumbnail end-->
						<div class="featured-content">
							<div class="featured-title">
								<h3><a class="play-youtube" href="javascript:void(0);"><?=$row['name_' . $lang_name]?></a></h3>
							</div>
							<div class="featured-desc">
								<p><?=$row['title_' . $lang_name]?></p>
							</div>
						</div>
					</div><!-- featured-imagebox end-->
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
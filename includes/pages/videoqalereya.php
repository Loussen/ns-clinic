<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<!-- Section: Videogallery-->
<section class="doctors-section section-gap">
	<div class="container">
		<div class="row justify-content-center">


            <?php
            $limit = 6;
            if (isset($_GET["page"])) $page = intval($_GET["page"]); else $page = 1;
            $max_data = mysqli_num_rows(mysqli_query($db, "select id from videogallery where active='1'"));
            $max_page = ceil($max_data / $limit);
            if ($page > $max_page) $page = $max_page;
            if ($page < 1) $page = 1;
            $start = $page * $limit - $limit;

            $sql = mysqli_query($db, "select * from videogallery where active=1 order by position asc limit $start, $limit");

            while ($row = mysqli_fetch_assoc($sql)) {
                ?>
				<div class="col-lg-4 col-md-6 col-sm-9 wow fadeInUp" data-wow-delay="0.3s">
					<div class="image-title-box mt-30">
						<h4 class="title"><a href="javascript:void(0);"><?= $row['name_' . $lang_name] ?></a></h4>

						<div class="image featured-thumbnail youtube-video-place"
						     data-yt-url="https://www.youtube.com/embed/<?= youtube_embed($row['video_url']) ?>?rel=0&showinfo=0&autoplay=1"
						     style="position: relative;">
							<img src="<?= SITE_PATH ?>/assets/img/youtube-play.png" class="play-youtube" style="position: absolute;
					    top: 50%;
					    left: 50%;
					    transform: translate(-50%, -50%); cursor: pointer; width:15%; z-index: 99; min-width: auto;"/>

							<img class="img-fullwidth"
							     src="http://img.youtube.com/vi/<?= youtube_embed($row['video_url']) ?>/maxresdefault.jpg"
							     alt="<?= $row['name_' . $lang_name] ?>">
						</div>
					</div>
				</div>
                <?php
            }
            ?>
		</div>

        <?php
        if($max_data>6)
        {
            ?>
			<ul class="pagination product-pagination">
                <?php
                $show=3;
                if($page>$show+1) echo '<li><a href="?page='.($page-1).'"><i class="far fa-angle-left"></i></a></li>';
                for($i=$page-$show;$i<=$page+$show;$i++)
                {
                    if($i>0 && $i<=$max_page)
                    {
                        if($i==$page)
                        {
                            $class='active';
                            $href = 'javascript:void(0);';
                        }
                        else
                        {
                            $class='';
                            $href = '?page='.$i;
                        }

                        echo '<li><a class="'.$class.'" href="'.$href.'">'.$i.'</a></li>';
                    }
                }
                if($page<$max_page-$show && $max_page>1) echo '<li><a href="?page='.($page+1).'"><i class="far fa-angle-right"></i></a></li>';

                ?>
			</ul>
            <?php
        }
        ?>
	</div>
</section><!-- End Videogallery -->
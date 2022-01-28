<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<!--====== Latest Blog Start ======-->
<section class="latest-blog-section section-gap">
	<div class="container">
		<div class="row justify-content-center latest-blog-loop">
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
				<div class="col-lg-4 col-md-6 col-sm-10">
					<div class="latest-blog-one mt-30">
						<div class="blog-thumb">
							<img src="<?=SITE_PATH?>/images/news/thumb_<?=$row['image']?>" alt="<?=$row['name_'.$lang_name]?>">
						</div>
						<div class="blog-content">
							<div class="blog-meta">
								<a href="javascript:void(0)" class="blog-date"><i class="far fa-calendar-alt"></i> <?= strftime('%d.%m.%Y', $row['datetime']);?></a>
							</div>
							<h4 class="blog-title">
								<a href="<?=$site?>/xeber/<?=slugGenerator($row['name_'.$lang_name]).'-'.$row["id"]?>"><?=$row['name_'.$lang_name]?></a>
							</h4>
							<div class="btn-area">
								<a href="<?=$site?>/xeber/<?=slugGenerator($row['name_'.$lang_name]).'-'.$row["id"]?>" class="read-more-btn">
                                    <?=$lang24?> <i class="far fa-plus"></i>
								</a>
							</div>
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
</section>
<!--====== Latest Blog End ======-->
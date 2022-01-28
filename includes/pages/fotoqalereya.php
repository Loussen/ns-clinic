<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<!--====== Gallery Area Start ======-->
<section class="gallery-section section-gap">
	<div class="container">
		<div class="gallery-filter mb-30">
			<ul>
				<li class="active" data-filter="*"><?=$lang28?></li>
                <?php
                $sql_albums=mysqli_query($db,"select * from photo_albums where active=1 order by position asc");

                while($row_albums = mysqli_fetch_assoc($sql_albums)) {
                    ?>
					<li data-filter=".class_<?=$row_albums['id']?>"><?=$row_albums['name_'.$lang_name]?></li>
                    <?php
                }
                ?>
			</ul>
		</div>
		<div class="row gallery-loop gallery-filter-item">
			<?php
			$i = 1;

			$sql_photos=mysqli_query($db,"select * from photo_albums_gallery where active=1 order by position asc");

			while($row_photos = mysqli_fetch_assoc($sql_photos)) {
                $info_album=mysqli_fetch_assoc(mysqli_query($db,"select * from photo_albums where id = '$row_photos[parent_id]' and active=1"));
				?>
				<div class="col-lg-4 col-sm-6 .class_<?=$row_photos['parent_id']?>">
					<div class="gallery-item-two mt-30">
						<div class="gallery-thumbnail">
							<img src="<?=SITE_PATH?>/images/photo_albums_gallery/<?=$row_photos['id']."/thumb_".$row_photos['image']?>" alt="<?=$info_album['name_'.$lang_name]?>">
						</div>
						<div class="gallery-caption">
							<div>
								<a href="<?=SITE_PATH?>/images/photo_albums_gallery/<?=$row_photos['id']."/".$row_photos['image']?>" class="plus-icon"><i class="far fa-plus"></i></a>
								<h3 class="title"><a href="#"><?=$info_album['name_'.$lang_name]?></a></h3>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>
<!--====== Gallery Area End ======-->
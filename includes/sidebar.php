<div id="side-panel-container" class="dark" data-tm-bg-img="<?=SITE_PATH?>/assets/images/side-push-bg.jpg">
    <div class="side-panel-wrap">
        <div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="fa fa-times side-panel-trigger-icon"></i></a></div>
        <img class="logo mb-50" src="<?=SITE_PATH?>/assets/images/logo-wide.png" alt="Logo">
        <p><?=substr_($info_contacts['footer_'.$lang_name],0,200,true,true)?></p>
        <div class="widget">
            <h4 class="widget-title widget-title-line-bottom line-bottom-theme-colored1"><?=$lang35?></h4>
            <div class="latest-posts">
	            <?php
                $home_news=mysqli_query($db,"select * from news where active=1 order by id desc LIMIT 3");

                while($row_news = mysqli_fetch_assoc($home_news))
                {
                	?>
	                <article class="post media-post clearfix pb-0 mb-10">
		                <a class="post-thumb" href="<?=$site?>/xeber/<?=slugGenerator($row_news['name_'.$lang_name]).'-'.$row_news["id"]?>"><img style="width: 69px; height: 70px;" src="<?=SITE_PATH?>/images/news/thumb_<?=$row_news['image']?>" alt="<?=$row_news['name_'.$lang_name]?>"></a>
		                <div class="post-right">
			                <h5 class="post-title mt-0"><a href="<?=$site?>/xeber/<?=slugGenerator($row_news['name_'.$lang_name]).'-'.$row_news["id"]?>"><?=$row_news['name_'.$lang_name]?></a></h5>
			                <p><?=substr_(decode_text($row_news['short_text_'.$lang_name]),0,50,true,true)?></p>
		                </div>
	                </article>
	                <?php
                }
	            ?>
            </div>
        </div>

        <div class="widget">
            <h5 class="widget-title widget-title-line-bottom line-bottom-theme-colored1"><?=$lang16?></h5>
            <div class="tm-widget-contact-info contact-info-style1 contact-icon-theme-colored1">
                <ul>
                    <li class="contact-phone">
                        <div class="icon"><i class="flaticon-contact-042-phone-1"></i></div>
                        <div class="text"><a href="tel:<?=$info_contacts['phone']?>"><?=$info_contacts['phone']?></a></div>
                    </li>
                    <li class="contact-email">
                        <div class="icon"><i class="flaticon-contact-043-email-1"></i></div>
                        <div class="text"><a href="mailto:<?=$info_contacts['email']?>"><?=$info_contacts['email']?></a></div>
                    </li>
                    <li class="contact-address">
                        <div class="icon"><i class="flaticon-contact-047-location"></i></div>
                        <div class="text"><?=$info_contacts['text_'.$lang_name]?></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
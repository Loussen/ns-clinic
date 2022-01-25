<!-- Start Off Canvas -->
<div class="slide-panel off-canvas-panel">
	<div class="panel-overlay"></div>
	<div class="panel-inner">
		<div class="canvas-logo">
			<img src="<?=SITE_PATH?>/assets/img/logo.png" alt="">
		</div>
		<div class="about-us">
			<h5 class="canvas-widget-title"><?=$lang1?></h5>
			<p>
                <?=substr_($info_about['short_text_'.$lang_name],0,200,true,true)?>
			</p>
		</div>
		<div class="contact-us">
			<h5 class="canvas-widget-title">Contact Us</h5>
			<ul>
				<li>
					<i class="far fa-map-marker-alt"></i>
                    <?=$info_contacts['text_'.$lang_name]?>
				</li>
				<li>
					<i class="far fa-envelope-open"></i>
					<a href="mailto:<?=$info_contacts['email']?>"><?=$info_contacts['email']?></a><br /><br />
				</li>
				<li>
					<i class="far fa-phone"></i>
					<a href="<?=$info_contacts['phone']?>"><?=$info_contacts['phone']?></a>
				</li>
			</ul>
		</div>
		<a href="#" class="panel-close">
			<i class="fal fa-times"></i>
		</a>
	</div>
</div>
<!-- End Off Canvas -->
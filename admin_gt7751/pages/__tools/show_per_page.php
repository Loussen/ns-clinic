<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php if($settings_inner["show_per_page_available"]>0){ ?>
	<div style="margin-right:10px;margin-bottom:7px;" class="print_hide pull-right <?php echo unCurrentClass()?>">
		<u>Hər səhifədə:</u>
		<select name="limit" id="limit" onchange="MM_jumpMenu('parent',this,0)">
			<option value="<?php echo addFullUrl(array('limit'=>15,'page'=>0,'add'=>0,'edit'=>0))?>" <?php if($limit==15) echo 'selected="selected"'; ?>>15</option>
			<option value="<?php echo addFullUrl(array('limit'=>25,'page'=>0,'add'=>0,'edit'=>0))?>" <?php if($limit==25) echo 'selected="selected"'; ?>>25</option>
			<option value="<?php echo addFullUrl(array('limit'=>50,'page'=>0,'add'=>0,'edit'=>0))?>" <?php if($limit==50) echo 'selected="selected"'; ?>>50</option>
			<option value="<?php echo addFullUrl(array('limit'=>100,'page'=>0,'add'=>0,'edit'=>0))?>" <?php if($limit==100) echo 'selected="selected"'; ?>>100</option>
			<option value="<?php echo addFullUrl(array('limit'=>999999,'page'=>0,'add'=>0,'edit'=>0))?>" <?php if($limit==999999) echo 'selected="selected"'; ?>>Bütün</option>
		</select>
	</div>
<?php } ?>
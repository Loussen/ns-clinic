<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php $t_title_add="Əlavə et"; include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
	<div class="tab-content">
		<?php
		$sql=mysqli_query($db,"select id,name from langs order by position");
		$inc=1;
		while($row=mysqli_fetch_assoc($sql))
		{
			echo '<div role="tabpanel" class="tab-pane" id="tab_lang'.$row["id"].'">';
			
				echo '
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Ad:</label>
					<div class="col-md-10">
						<input name="name_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["name_".$row["name"]]).'" />
					</div>
				</div>
				';
			
			echo '</div>';
		}
		?>
		
		<?php
		$current_file=''; $column_nm='image';
		if($information[$column_nm]!="" && $edit>0) $current_file=createFileView($imageFolder,$information[$column_nm],$edit,$column_nm);
		?>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Şəkil:</label>
			<div class="col-md-10">
				<input name="<?php echo decode_text($column_nm)?>[]" type="file" /> <?php echo $current_file?>
			</div>
		</div>
		
		<div class="clear"></div><b><i>və ya</i></b><br />
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Video URL:</label>
			<div class="col-md-10">
				<input name="video_url" class="form-control" type="text" value="<?php echo decode_text($information["video_url"])?>" />
			</div>
		</div>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
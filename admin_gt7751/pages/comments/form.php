<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
	<div class="tab-content">
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Ad:</label>
			<div class="col-md-10">
				<input name="name" class="form-control" type="text" value="<?php echo decode_text($information["name"])?>" />
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Şərh:</label>
			<div class="col-md-10">
				<textarea name="comment" class="form-control" style="height:150px;"><?php echo decode_text($information["comment"])?></textarea>
			</div>
		</div>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
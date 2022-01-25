<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php $t_title_add="Məktub göndər"; include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
	<div class="tab-content">
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Kimden:</label>
			<div class="col-md-10">
				<input name="from_name" class="form-control" type="text" value="" />
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Başlıq:</label>
			<div class="col-md-10">
				<input name="title" class="form-control" type="text" value="" />
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Məktub:</label>
			<div class="col-md-10">
				<textarea name="message" class="form-control"></textarea>
			</div>
		</div>

		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
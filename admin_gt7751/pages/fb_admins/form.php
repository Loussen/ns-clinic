<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php $t_title_add="Əlavə et"; include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
	<div class="tab-content">
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">FB ID:</label>
			<div class="col-md-10">
				<input name="fb_id" class="form-control" type="text" value="<?php echo decode_text($information["fb_id"])?>" />
			</div>
		</div>

		<?php
		$sql=mysqli_query($db,"select id,name from langs order by position");
		while($row=mysqli_fetch_assoc($sql))
		{
			echo '<div role="tabpanel" class="tab-pane" id="tab_lang'.$row["id"].'">';
			
				// you can write here for any inputs which depends on langs :)
				echo '';
				
			echo '</div>';
		}
		?>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
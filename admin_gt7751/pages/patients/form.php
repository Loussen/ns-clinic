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
					<label for="example-text-input" class="col-md-2 col-form-label">Pasiyentin adı, soyadı:</label>
					<div class="col-md-10">
						<input name="name_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["name_".$row["name"]]).'" />
					</div>
				</div>
				
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Pasiyentin fikri:</label>
					<div class="col-md-10">
						<textarea name="text_'.decode_text($row["name"]).'" class="form-control">'.decode_text($information["text_".$row["name"]]).'</textarea>
					</div>
				</div>
				';
			
			echo '</div>';
		}
		?>
        <div class="form-group row hide">
            <label for="example-text-input" class="col-md-2 col-form-label">Video Url:</label>
            <div class="col-md-10">
                <input name="video_url" class="form-control" type="text" value="<?php echo decode_text($information["video_url"])?>" />
            </div>
        </div>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
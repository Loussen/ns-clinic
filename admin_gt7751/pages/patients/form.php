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
					<label for="example-text-input" class="col-md-2 col-form-label">Başlıq:</label>
					<div class="col-md-10">
						<input name="title_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["title_".$row["name"]]).'" />
					</div>
				</div>
				
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Pasiyent:</label>
					<div class="col-md-10">
						<input name="name_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["name_".$row["name"]]).'" />
					</div>
				</div>
				';
			
			echo '</div>';
		}
		?>
        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Video Url:</label>
            <div class="col-md-10">
                <input name="video_url" class="form-control" type="text" value="<?php echo decode_text($information["video_url"])?>" />
            </div>
        </div>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
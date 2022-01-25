<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="tab-content">
		<?php
		$sql=mysqli_query($db,"select id,name from langs order by position");
		while($row=mysqli_fetch_assoc($sql)){
			echo '<div role="tabpanel" class="tab-pane" id="tab_lang'.$row["id"].'">';
			
				echo '
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Description:</label>
					<div class="col-md-10">
						<textarea name="description_'.decode_text($row["name"]).'" class="form-control">'.decode_text($information["description_".$row["name"]]).'</textarea>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Keywords:</label>
					<div class="col-md-10">
						<input name="keywords_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["keywords_".$row["name"]]).'" />
					</div>
				</div>
				
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Title:</label>
					<div class="col-md-10">
						<input name="title_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["title_".$row["name"]]).'" />
					</div>
				</div>
				';
			
			echo '</div>';
		}
		?>

		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
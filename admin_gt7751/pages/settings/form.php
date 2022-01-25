<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="tab-content">
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Ad:</label>
			<div class="col-md-8">
				<textarea name="admin_name" class="form-control" style="height:80px;"><?php echo decode_text($information["admin_name"])?></textarea>
			</div>
		</div>
				
		<?php
		$current_file=''; $column_nm='image_logo';
		if($information[$column_nm]!="") $current_file=createFileView($imageFolder,$information[$column_nm],$edit,$column_nm);
		?>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Logo:</label>
			<div class="col-md-8">
				<input name="<?php echo decode_text($column_nm)?>" type="file" /> <?php echo $current_file?>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Title:</label>
			<div class="col-md-8">
				<input type="text" name="title_" class="form-control" value="<?php echo decode_text($information["title_"])?>" />
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Keywords:</label>
			<div class="col-md-8">
				<input type="text" name="keywords_" class="form-control" value="<?php echo decode_text($information["keywords_"])?>" />
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Description:</label>
			<div class="col-md-8">
				<input type="text" name="description_" class="form-control" value="<?php echo decode_text($information["description_"])?>" />
			</div>
		</div>
		
		<?php
		$current_file=''; $column_nm='image_fav';
		if($information[$column_nm]!="") $current_file=createFileView($imageFolder,$information[$column_nm],$edit,$column_nm);
		?>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Fav icon:</label>
			<div class="col-md-8">
				<input name="<?php echo decode_text($column_nm)?>" type="file" /> <?php echo $current_file?>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Valyuta:</label>
			<div class="col-md-8">
				<select name="currency" class="form-control">
					<option value="0">Xeyr</option>
					<option value="1" <?php if($information["currency"]>0) echo 'selected="selected"'; ?>>Bəli</option>
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Hava:</label>
			<div class="col-md-8">
				<select name="wheather" class="form-control">
					<option value="0">Xeyr</option>
					<option value="1" <?php if($information["wheather"]>0) echo 'selected="selected"'; ?>>Bəli</option>
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Namaz:</label>
			<div class="col-md-8">
				<select name="namaz" class="form-control">
					<option value="0">Xeyr</option>
					<option value="1" <?php if($information["namaz"]>0) echo 'selected="selected"'; ?>>Bəli</option>
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Admin vəzifələr ilə:</label>
			<div class="col-md-8">
				<select name="admin_with_role" class="form-control">
					<option value="0">Xeyr</option>
					<option value="1" <?php if($information["admin_with_role"]>0) echo 'selected="selected"'; ?>>Bəli</option>
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Adminə, saytda olan dil dəyişənlərini əlavə et</label>
			<div class="col-md-8">
				<select name="include_site_langs" class="form-control">
					<option value="0">Xeyr</option>
					<option value="1" <?php if($information["include_site_langs"]>0) echo 'selected="selected"'; ?>>Bəli</option>
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Şəkil kəsmək imkanı</label>
			<div class="col-md-8">
				<select name="image_crop" class="form-control">
					<option value="0">Xeyr</option>
					<option value="1" <?php if($information["image_crop"]>0) echo 'selected="selected"'; ?>>Bəli</option>
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Adminin əsas səhifəsi:</label>
			<div class="col-md-8">
				<select name="default_page" class="form-control">
					<?php
					foreach($menu_names as $key=>$val){
						echo '<option value="'.decode_text($does[$key]).'" '.getSelected(decode_text($does[$key]),$information["default_page"]).'>'.$val.'</option>';
					}
					?>
					
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-4 col-form-label">Şifrə dəyişiləndə lisenziya istəsin</label>
			<div class="col-md-8">
				<select name="want_license_pass_change" class="form-control">
					<option value="0">Xeyr</option>
					<option value="1" <?php if($information["want_license_pass_change"]>0) echo 'selected="selected"'; ?>>Bəli</option>
				</select>
			</div>
		</div>
		
		<?php
		$sql=mysqli_query($db,"select id,name from langs order by position");
		while($row=mysqli_fetch_assoc($sql))
		{
			echo '<div role="tabpanel" class="tab-pane" id="tab_lang'.$row["id"].'">';
				/*
				echo '
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Sual:</label>
					<div class="col-md-10">
						<input name="question_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["question_".$row["name"]]).'" />
					</div>
				</div>
				';
				*/
			echo '</div>';
		}
		?>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
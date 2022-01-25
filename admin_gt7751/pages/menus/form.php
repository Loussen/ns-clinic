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
				
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Mətn:</label>
					<div class="col-md-10">
						<textarea name="text_'.decode_text($row["name"]).'" class="form-control" id="editor'.$inc++.'">'.decode_text($information["text_".$row["name"]]).'</textarea>
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
			<label for="example-text-input" class="col-md-2 col-form-label">Şəkil (1920x500):</label>
			<div class="col-md-10">
				<input name="<?php echo decode_text($column_nm)?>" type="file" /> <?php echo $current_file?>
			</div>
		</div>
		
		<div class="form-group row hide">
			<label for="example-text-input" class="col-md-2 col-form-label">İcon üçün kod:</label>
			<div class="col-md-10">
				<input name="icon_code" class="form-control" type="text" value="<?php echo decode_text($information["icon_code"])?>" />
			</div>
		</div>
		
		<div class="form-group row hide">
			<label for="example-text-input" class="col-md-2 col-form-label">Yönləndiriləcək səhifə:</label>
			<div class="col-md-10">
				<input name="link" class="form-control" type="text" value="<?php echo decode_text($information["link"])?>" />
			</div>
		</div>
		
		<div class="form-group row <?php if($settings_inner["parent_id_available"]==0) echo 'hide'; ?>">
			<label for="example-text-input" class="col-md-2 col-form-label">Ana menyu:</label>
			<div class="col-md-10">
				<select name="parent_id" class="form-control">
					<option value="0"></option>
					<?php
					$sql=mysqli_query($db,"select id,$Name from $do where id!='$edit' order by position");
					while($row=mysqli_fetch_assoc($sql)){
						if($row["id"]==$information["parent_id"]) $selected='selected="selected"'; else $selected='';
						echo '<option value="'.$row["id"].'" '.$selected.'>'.decode_text($row[$Name]).'</option>';
					}
					?>
				</select>
			</div>
		</div>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
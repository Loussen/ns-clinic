<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php $t_title_add="Əlavə et"; include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
	<div class="tab-content">
		
		<div class="form-group row hide">
			<label for="example-text-input" class="col-md-2 col-form-label">Kateqoriya:</label>
			<div class="col-md-10">
				<select name="category_id" class="form-control">
					<option value="0"></option>
					<?php
					$sql=mysqli_query($db,"select id,$Name from categories order by position");
					while($row=mysqli_fetch_assoc($sql)){
						if($row["id"]==$information["category_id"]) $selected='selected="selected"'; else $selected='';
						echo '<option value="'.$row["id"].'" '.$selected.'>'.decode_text($row[$Name]).'</option>';
					}
					?>
				</select>
			</div>
		</div>
		
		<div class="form-group row hide">
			<label for="example-text-input" class="col-md-2 col-form-label">Müəllif:</label>
			<div class="col-md-10">
				<select name="author_id" class="form-control">
					<option value="0"></option>
					<?php
					$sql=mysqli_query($db,"select id,$Name from authors order by $Name");
					while($row=mysqli_fetch_assoc($sql)){
						if($row["id"]==$information["author_id"]) $selected='selected="selected"'; else $selected='';
						echo '<option value="'.$row["id"].'" '.$selected.'>'.decode_text($row[$Name]).'</option>';
					}
					?>
				</select>
                
			</div>
		</div>
		
		<?php
		if($add==1){
			$datetime=date("d").'/'.date("m").'/'.date("Y");
			$hour=date("H:i");
		}
		else{
			$datetime=date("d/m/Y",$information["datetime"]);
			$hour=date("H:i",$information["datetime"]);
		}
		?>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Tarix:</label>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="datetime" class="form-control datepicker-autoclose" placeholder="dd/mm/yyyy" value="<?php echo $datetime?>" />
					<span class="input-group-addon"><i class="icon-calender"></i></span>
				</div>
			</div>
		</div>
		
		<div class="form-group row hide">
			<label for="example-text-input" class="col-md-2 col-form-label">Saat:</label>
			<div class="col-md-10">
				<div class="input-group clockpicker" data-autoclose="true">
					<input type="text" name="hour" class="form-control" value="<?php echo $hour?>">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
				</div>
			</div>
		</div>
		
		<?php
		$current_file=''; $column_nm='image';
		if($information[$column_nm]!="" && $edit>0) $current_file=createFileView($imageFolder,$information[$column_nm],$edit,$column_nm);
		?>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Şəkil:</label>
			<div class="col-md-10">
				<input name="<?php echo decode_text($column_nm)?>" type="file" /> <?php echo $current_file?>
			</div>
		</div>
		
		<div class="form-group row hide">
			<label for="example-text-input" class="col-md-2 col-form-label">Flash:</label>
			<div class="col-md-10">
				<div class="checkbox checkbox-inverse pull-left margin_0">
					<input type="checkbox" id="flash_check" value="1" onclick="chbx_(this.id)" name="flash" <?php if($information["flash"]>0) echo 'checked="checked"'; ?> /> <label for="flash_check"></label>
				</div>
			</div>
		</div>
		
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
						<input name="name_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["name_".$row["name"]]).'" />
					</div>
				</div>
				
				<div class="form-group row hide">
					<label for="example-text-input" class="col-md-2 col-form-label">Açar sözlər:</label>
					<div class="col-md-10">
						<input name="keywords_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["keywords_".$row["name"]]).'" />
					</div>
				</div>
				
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Mətn <b>(Qısa izahı)</b>:</label>
					<div class="col-md-10">
						<textarea name="short_text_'.decode_text($row["name"]).'" class="form-control" id="-editor'.$inc++.'">'.decode_text($information["short_text_".$row["name"]]).'</textarea>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Mətn <b>(Tam izahı)</b>:</label>
					<div class="col-md-10">
						<textarea name="full_text_'.decode_text($row["name"]).'" class="form-control" id="editor'.$inc++.'">'.decode_text($information["full_text_".$row["name"]]).'</textarea>
					</div>
				</div>
				';
			
			echo '</div>';
		}
		?>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
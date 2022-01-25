<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php $t_title_add="Əlavə et"; include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
	<div class="tab-content">
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Ad, Soyad:</label>
			<div class="col-md-10">
				<input name="name" class="form-control" type="text" value="<?php echo decode_text($information["name"])?>" />
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Login:</label>
			<div class="col-md-10">
				<input name="login" class="form-control" type="text" value="<?php echo decode_text($information["login"])?>" />
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Email:</label>
			<div class="col-md-10">
				<input name="email" class="form-control" type="text" value="<?php echo decode_text($information["email"])?>" />
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Şifrə:</label>
			<div class="col-md-10">
				<input name="pass" class="form-control" type="text" placeholder="******" />
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Doğum tarixi:</label>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="birthday" class="form-control datepicker-autoclose" placeholder="dd/mm/yyyy" value="<?php echo date("d/m/Y",$information["birthday"])?>" />
					<span class="input-group-addon"><i class="icon-calender"></i></span>
				</div>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Cins:</label>
			<div class="col-md-10">
				<select name="gender" class="form-control">
					<option value="0">Qadın</option>
					<option value="1" <?php if($information["gender"]==1) echo 'selected="selected"'; ?> >Kişi</option>
				</select>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Mobil:</label>
			<div class="col-md-10">
				<input name="mobile" class="form-control" type="text" value="<?php echo decode_text($information["mobile"])?>" />
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Haqqında:</label>
			<div class="col-md-10">
				<textarea name="about" class="form-control"><?php echo decode_text($information["about"])?></textarea>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Email təsdiqi:</label>
			<div class="col-md-10">
				<select name="activation" class="form-control">
					<option value="0">Deaktiv</option>
					<option value="1" <?php if($information["activation"]==1) echo 'selected="selected"'; ?> >Aktiv</option>
				</select>
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
	
		<?php
		$sql=mysqli_query($db,"select id,name from langs order by position");
		$inc=1;
		while($row=mysqli_fetch_assoc($sql))
		{
			echo '<div role="tabpanel" class="tab-pane" id="tab_lang'.$row["id"].'">';
				
				echo '';
			
			echo '</div>';
		}
		?>
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
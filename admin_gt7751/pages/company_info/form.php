<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="<?=addFullUrl(array('er'=>0))?>" method="post" enctype="multipart/form-data">
	<div class="tab-content">
	
		<div class="form-group row">
			<?php if($CUS["expire_time"]<=$time){ ?>
				<label for="example-text-input" class="col-md-12 col-form-label" style="color:Red;">Proqramın müddəti başa çatıb. Artırmaq üçün administrator ilə əlaqə saxlayın.</label>
			<?php } ?>
			<label for="example-text-input" class="col-md-2 col-form-label hide">Müddətin artırılması:</label>
			<div class="col-md-10">
				<select name="expire_time" class="form-control hide">
					<option value="0">Cari müddət <?=date("d.m.Y H:i",$CUS["expire_time"])?></option>
					<option value="30">+1 ay uzadılsın (<?=$CUS["price"]*1*1?> AZN)</option>
					<option value="90">+3 ay uzadılsın [-10%] (<?=intval($CUS["price"]*3*0.9)?> AZN)</option>
					<option value="182">+6 ay uzadılsın [-20%] (<?=intval($CUS["price"]*6*0.8)?> AZN)</option>
					<option value="365">+1 il uzadılsın [-30%] (<?=intval($CUS["price"]*12*0.7)?> AZN)</option>
				</select>
			</div>
		</div>
	
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Ad:</label>
			<div class="col-md-10">
				<textarea name="name" class="form-control" style="height:80px;"><?=decode_text($information["name"])?></textarea>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Sizin əsas valyutanız:</label>
			<div class="col-md-10">
				<select name="currency_id" class="form-control" required>
					<option value="">Seçin</option>
					<?php
					$sql=mysqli_query($db,"select id,name from currencies where active=1 order by position");
					while($row=mysqli_fetch_assoc($sql)){
						echo '<option value="'.$row["id"].'" '.getSelected($row["id"],$information["currency_id"]).'>'.decode_text($row["name"]).'</option>';
					}
					?>
				</select>
			</div>
		</div>
			
		<div class="form-group row">
			<?php
			$current_file=''; $column_nm='image_logo';
			if($information[$column_nm]!="") $current_file=createFileView($imageFolder,$information[$column_nm],1,$column_nm);
			?>
			<label for="example-text-input" class="col-md-2 col-form-label">Logo:</label>
			<div class="col-md-10"><input name="<?=$column_nm?>" type="file" /><?php echo $current_file?></div>
		</div>
		
		<hr />
		<div class="form-group row hide"><label for="example-text-input" class="col-md-12 col-form-label">Tənzimləmələr:</label></div>
		<div class="form-group row hide">
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left margin_0">
					<input type="checkbox" id="short_text" <?php if($current_user_settings && isset($current_user_settings->short_text) && $current_user_settings->short_text==1) echo 'checked="checked"'; ?> value="1" name="short_text" /> <label for="short_text" data-toggle="tooltip" data-animation="false" data-original-title="Məhsul əlavə edərkən göstərilsin">Mətn (Qısa izahı)</label>
				</div>
			</div>
			
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left margin_0">
					<input type="checkbox" id="full_text" <?php if($current_user_settings && isset($current_user_settings->full_text) && $current_user_settings->full_text==1) echo 'checked="checked"'; ?> value="1" name="full_text" /> <label for="full_text" data-toggle="tooltip" data-animation="false" data-original-title="Məhsul əlavə edərkən göstərilsin">Mətn (Tam izahı)</label>
				</div>
			</div>
			
		</div>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group row">
		<label for="example-text-input" class="col-md-4 col-form-label">Tənzimləmək istədiyiniz cədvəli seçin:</label>
		<div class="col-md-8">
			<select class="form-control" onchange="MM_jumpMenu('parent',this,0)">
				<option value="<?php echo addFullUrl(array('get_table_name'=>''))?>">Seçin</option>
				<?php
				$get_table_name_isset=false;
				$sql=mysqli_query($db,"select table_name from $do order by table_name");
				while($row=mysqli_fetch_assoc($sql)){
					if($row["table_name"]==$get_table_name) { $selected='selected="selected"'; $get_table_name_isset=true;} else $selected='';
					echo '<option value="'.addFullUrl(array('get_table_name'=>$row["table_name"])).'" '.$selected.'>'.decode_text($row["table_name"]).'</option>';
				}
				?>
			</select>
		</div>
	</div>
	
	<hr />
<?php if($get_table_name_isset==true){ ?>
	
	<?php if(in_array('parent_id',$get_table_name_columns)) { ?>
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="parent_id_available" id="item14" <?php if($information["parent_id_available"]==1) echo 'checked="checked"'; ?> />
				<label for="item14"></label>
			</div>
			<label for="item14" class="col-form-label">Parent ID-nin istifadə edilməsi</label>
		</div>
	</div>
	<?php } ?>
		
	<?php if(in_array('position',$get_table_name_columns)) { ?>
		<div class="form-group row">
			<div class="col-md-12">
				<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
					<input type="checkbox" value="1" name="position_available" id="item1" <?php if($information["position_available"]==1) echo 'checked="checked"'; ?> />
					<label for="item1"></label>
				</div>
				<label for="item1" class="col-form-label">Sıralamanın idarə edilməsi</label>
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-md-12">
				<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
					<input type="checkbox" value="1" name="position_desc" id="item2" <?php if($information["position_desc"]==1) echo 'checked="checked"'; ?> />
					<label for="item2"></label>
				</div>
				<label for="item2" class="col-form-label">Sıralama əksinə olsun. (desc)</label>
			</div>
		</div>
		
		<?php if(in_array('parent_id',$get_table_name_columns)) { ?>
		<div class="form-group row">
			<div class="col-md-12">
				<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
					<input type="checkbox" value="1" name="position_depends_parent_id" id="item15" <?php if($information["position_depends_parent_id"]==1) echo 'checked="checked"'; ?> />
					<label for="item15"></label>
				</div>
				<label for="item15" class="col-form-label">Sıralama işləyərkən Parent ID-ni nəzərə alsın</label>
			</div>
		</div>
		<?php } ?>
	<?php } ?>
	
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="multiselect_available" id="item3" <?php if($information["multiselect_available"]==1) echo 'checked="checked"'; ?> />
				<label for="item3"></label>
			</div>
			<label for="item3" class="col-form-label">Çox seçim etmək imkanı</label>
		</div>
	</div>
	
	<?php if(in_array('active',$get_table_name_columns)) { ?>
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="active_available" id="item4" <?php if($information["active_available"]==1) echo 'checked="checked"'; ?> />
				<label for="item4"></label>
			</div>
			<label for="item4" class="col-form-label">Aktivliyin idarə edilməsi</label>
		</div>
	</div>
	<?php } ?>
	
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="edit_available" id="item5" <?php if($information["edit_available"]==1) echo 'checked="checked"'; ?> />
				<label for="item5"></label>
			</div>
			<label for="item5" class="col-form-label">Düzəliş etmək imkanı</label>
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="delete_available" id="item6" <?php if($information["delete_available"]==1) echo 'checked="checked"'; ?> />
				<label for="item6"></label>
			</div>
			<label for="item6" class="col-form-label">Silmək imkanı</label>
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="show_per_page_available" id="item7" <?php if($information["show_per_page_available"]==1) echo 'checked="checked"'; ?> />
				<label for="item7"></label>
			</div>
			<label for="item7" class="col-form-label">Hər səhifədə göstəriləcək məlumat sayı</label>
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="print_available" id="item8" <?php if($information["print_available"]==1) echo 'checked="checked"'; ?> />
				<label for="item8"></label>
			</div>
			<label for="item8" class="col-form-label">Çap etmək imkanı</label>
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="add_new_available" id="item9" <?php if($information["add_new_available"]==1) echo 'checked="checked"'; ?> />
				<label for="item9"></label>
			</div>
			<label for="item9" class="col-form-label">Yeni məlumat əlavə etmək imkanı</label>
		</div>
	</div>
	
	<?php if(in_array('category_id',$get_table_name_columns)) { ?>
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="category_available" id="item11" <?php if($information["category_available"]==1) echo 'checked="checked"'; ?> />
				<label for="item11"></label>
			</div>
			<label for="item11" class="col-form-label">Kateqoriyanın göstərilməsi</label>
		</div>
	</div>
	<?php } ?>
	
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="paginator_available" id="item10" <?php if($information["paginator_available"]==1) echo 'checked="checked"'; ?> />
				<label for="item10"></label>
			</div>
			<label for="item10" class="col-form-label">Səhifələmənin göstərilməsi</label>
		</div>
	</div>
	
	<?php if(in_array('image',$get_table_name_columns)) { ?>
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="upload_important" id="item12" <?php if($information["upload_important"]==1) echo 'checked="checked"'; ?> />
				<label for="item12"></label>
			</div>
			<label for="item12" class="col-form-label">Şəkil əlavə etmək mütləqdir</label>
		</div>
	</div>
	<?php } ?>
	
	<div class="form-group row">
		<div class="col-md-12">
			<div class="checkbox checkbox-inverse margin_0 margin_t4 pull-left">
				<input type="checkbox" value="1" name="show_datacount" id="item13" <?php if($information["show_datacount"]==1) echo 'checked="checked"'; ?> />
				<label for="item13"></label>
			</div>
			<label for="item13" class="col-form-label">Məlumat sayının göstərilməsi</label>
		</div>
	</div>
	
	<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
<?php } ?>
</form>
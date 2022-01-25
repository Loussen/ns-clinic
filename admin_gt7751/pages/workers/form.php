<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php $t_title_add="Əlavə et"; include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
	<div class="tab-content">
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Ad*:</label>
			<div class="col-md-10">
				<input name="name" class="form-control" type="text" value="<?php echo decode_text($information["name"])?>" required />
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Login*:</label>
			<div class="col-md-10">
				<input name="login" class="form-control" type="text" value="<?php echo decode_text($information["login"])?>" required />
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Email:</label>
			<div class="col-md-10">
				<input name="email" class="form-control" type="text" value="<?php echo decode_text($information["email"])?>" />
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Ünvan:</label>
			<div class="col-md-10">
				<input name="address" class="form-control" type="text" value="<?php echo decode_text($information["address"])?>" />
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Telefon:</label>
			<div class="col-md-10">
				<input name="mobile" class="form-control" type="text" value="<?php echo decode_text($information["mobile"])?>" />
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Şifrəniz*:</label>
			<div class="col-md-10">
				<input name="pass" class="form-control" type="text" value="" placeholder="" <?php if($add>0) echo 'required'; ?> />
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Tam siyahını görmək imkanı:</label>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="tickets_view" id="tickets_view" value="1" <?php if(isset($full_list_access->tickets->view) && $full_list_access->tickets->view==1) echo 'checked="checked"'; ?> /><label for="tickets_view">Bilet</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="hotels_view" id="hotels_view" value="1" <?php if(isset($full_list_access->hotels->view) && $full_list_access->hotels->view==1) echo 'checked="checked"'; ?> /><label for="hotels_view">Otel</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="packages_view" id="packages_view" value="1" <?php if(isset($full_list_access->packages->view) && $full_list_access->packages->view==1) echo 'checked="checked"'; ?> /><label for="packages_view">Tur paketləri</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="transfers_view" id="transfers_view" value="1" <?php if(isset($full_list_access->transfers->view) && $full_list_access->transfers->view==1) echo 'checked="checked"'; ?> /><label for="transfers_view">Transfer</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="services_view" id="services_view" value="1" <?php if(isset($full_list_access->services->view) && $full_list_access->services->view==1) echo 'checked="checked"'; ?> /><label for="services_view">Xidmətlər</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="insurances_view" id="insurances_view" value="1" <?php if(isset($full_list_access->insurances->view) && $full_list_access->insurances->view==1) echo 'checked="checked"'; ?> /><label for="insurances_view">Sığorta</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="inner_tours_view" id="inner_tours_view" value="1" <?php if(isset($full_list_access->inner_tours->view) && $full_list_access->inner_tours->view==1) echo 'checked="checked"'; ?> /><label for="inner_tours_view">Daxili tur</label>
				</div>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Tam siyahıda düzəliş etmək imkanı:</label>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="tickets_edit" id="tickets_edit" value="1" <?php if(isset($full_list_access->tickets->edit) && $full_list_access->tickets->edit==1) echo 'checked="checked"'; ?> /><label for="tickets_edit">Bilet</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="hotels_edit" id="hotels_edit" value="1" <?php if(isset($full_list_access->hotels->edit) && $full_list_access->hotels->edit==1) echo 'checked="checked"'; ?> /><label for="hotels_edit">Otel</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="packages_edit" id="packages_edit" value="1" <?php if(isset($full_list_access->packages->edit) && $full_list_access->packages->edit==1) echo 'checked="checked"'; ?> /><label for="packages_edit">Tur paketləri</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="transfers_edit" id="transfers_edit" value="1" <?php if(isset($full_list_access->transfers->edit) && $full_list_access->transfers->edit==1) echo 'checked="checked"'; ?> /><label for="transfers_edit">Transfer</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="services_edit" id="services_edit" value="1" <?php if(isset($full_list_access->services->edit) && $full_list_access->services->edit==1) echo 'checked="checked"'; ?> /><label for="services_edit">Xidmətlər</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="insurances_edit" id="insurances_edit" value="1" <?php if(isset($full_list_access->insurances->edit) && $full_list_access->insurances->edit==1) echo 'checked="checked"'; ?> /><label for="insurances_edit">Sığorta</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="inner_tours_edit" id="inner_tours_edit" value="1" <?php if(isset($full_list_access->inner_tours->edit) && $full_list_access->inner_tours->edit==1) echo 'checked="checked"'; ?> /><label for="inner_tours_edit">Daxili tur</label>
				</div>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Tam siyahıdan silmək etmək imkanı:</label>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="tickets_delete" id="tickets_delete" value="1" <?php if(isset($full_list_access->tickets->delete) && $full_list_access->tickets->delete==1) echo 'checked="checked"'; ?> /><label for="tickets_delete">Bilet</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="hotels_delete" id="hotels_delete" value="1" <?php if(isset($full_list_access->hotels->delete) && $full_list_access->hotels->delete==1) echo 'checked="checked"'; ?> /><label for="hotels_delete">Otel</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="packages_delete" id="packages_delete" value="1" <?php if(isset($full_list_access->packages->delete) && $full_list_access->packages->delete==1) echo 'checked="checked"'; ?> /><label for="packages_delete">Tur paketləri</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="transfers_delete" id="transfers_delete" value="1" <?php if(isset($full_list_access->transfers->delete) && $full_list_access->transfers->delete==1) echo 'checked="checked"'; ?> /><label for="transfers_delete">Transfer</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="services_delete" id="services_delete" value="1" <?php if(isset($full_list_access->services->delete) && $full_list_access->services->delete==1) echo 'checked="checked"'; ?> /><label for="services_delete">Xidmətlər</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="insurances_delete" id="insurances_delete" value="1" <?php if(isset($full_list_access->insurances->delete) && $full_list_access->insurances->delete==1) echo 'checked="checked"'; ?> /><label for="insurances_delete">Sığorta</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="inner_tours_delete" id="inner_tours_delete" value="1" <?php if(isset($full_list_access->inner_tours->delete) && $full_list_access->inner_tours->delete==1) echo 'checked="checked"'; ?> /><label for="inner_tours_delete">Daxili tur</label>
				</div>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Müqavilələri ləğv etmək imkanı:</label>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="tickets_cancel" id="tickets_cancel" value="1" <?php if(isset($full_list_access->tickets->cancel) && $full_list_access->tickets->cancel==1) echo 'checked="checked"'; ?> /><label for="tickets_cancel">Bilet</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="hotels_cancel" id="hotels_cancel" value="1" <?php if(isset($full_list_access->hotels->cancel) && $full_list_access->hotels->cancel==1) echo 'checked="checked"'; ?> /><label for="hotels_cancel">Otel</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="packages_cancel" id="packages_cancel" value="1" <?php if(isset($full_list_access->packages->cancel) && $full_list_access->packages->cancel==1) echo 'checked="checked"'; ?> /><label for="packages_cancel">Tur paketləri</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="transfers_cancel" id="transfers_cancel" value="1" <?php if(isset($full_list_access->transfers->cancel) && $full_list_access->transfers->cancel==1) echo 'checked="checked"'; ?> /><label for="transfers_cancel">Transfer</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="services_cancel" id="services_cancel" value="1" <?php if(isset($full_list_access->services->cancel) && $full_list_access->services->cancel==1) echo 'checked="checked"'; ?> /><label for="services_cancel">Xidmətlər</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="insurances_cancel" id="insurances_cancel" value="1" <?php if(isset($full_list_access->insurances->cancel) && $full_list_access->insurances->cancel==1) echo 'checked="checked"'; ?> /><label for="insurances_cancel">Sığorta</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="inner_tours_cancel" id="inner_tours_cancel" value="1" <?php if(isset($full_list_access->inner_tours->cancel) && $full_list_access->inner_tours->cancel==1) echo 'checked="checked"'; ?> /><label for="inner_tours_cancel">Daxili tur</label>
				</div>
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Keçmiş tarixə müqavilə əlavə etmə imkanı:</label>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="tickets_older" id="tickets_older" value="1" <?php if(isset($full_list_access->tickets->older) && $full_list_access->tickets->older==1) echo 'checked="checked"'; ?> /><label for="tickets_older">Bilet</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="hotels_older" id="hotels_older" value="1" <?php if(isset($full_list_access->hotels->older) && $full_list_access->hotels->older==1) echo 'checked="checked"'; ?> /><label for="hotels_older">Otel</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="packages_older" id="packages_older" value="1" <?php if(isset($full_list_access->packages->older) && $full_list_access->packages->older==1) echo 'checked="checked"'; ?> /><label for="packages_older">Tur paketləri</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="transfers_older" id="transfers_older" value="1" <?php if(isset($full_list_access->transfers->older) && $full_list_access->transfers->older==1) echo 'checked="checked"'; ?> /><label for="transfers_older">Transfer</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="services_older" id="services_older" value="1" <?php if(isset($full_list_access->services->older) && $full_list_access->services->older==1) echo 'checked="checked"'; ?> /><label for="services_older">Xidmətlər</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="insurances_older" id="insurances_older" value="1" <?php if(isset($full_list_access->insurances->older) && $full_list_access->insurances->older==1) echo 'checked="checked"'; ?> /><label for="insurances_older">Sığorta</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="inner_tours_older" id="inner_tours_older" value="1" <?php if(isset($full_list_access->inner_tours->older) && $full_list_access->inner_tours->older==1) echo 'checked="checked"'; ?> /><label for="inner_tours_older">Daxili tur</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="checkbox checkbox-inverse pull-left">
					<input type="checkbox" name="payments_older" id="payments_older" value="1" <?php if(isset($full_list_access->payments->older) && $full_list_access->payments->older==1) echo 'checked="checked"'; ?> /><label for="payments_older">Ödənişlərə</label>
				</div>
			</div>
		</div>
		
		<?php
		if($get_settings["admin_with_role"]==1){ ?>
		
		<hr class="only_special" />
		<div class="checkbox checkbox-inverse pull-left m-5 only_special">
			<input type="checkbox" data-val="0" name="all_check" id="all_check" value="all_check" /><label for="all_check">Hamısını seç</label>
		</div>
		<table class="table table-striped only_special">
			<thead>
			  <tr>
				<th>Bölmə</th>
				<th>Görmək</th>
				<th>Əlavə etmək</th>
				<th>Düzəliş etmək</th>
				<th>Silmək</th>
				<th>Sıralamaq</th>
				<th>Aktivlik</th>
			  </tr>
			</thead>
			<tbody>
		<?php
			$edit_permissions=json_decode($information["permissions"]);
			
			foreach($menu_names as $key=>$val){
				if($does[$key]!='') $settingsInner=mysqli_fetch_assoc(mysqli_query($db,"select * from settings_inner where table_name='$does[$key]' "));
				else $settingsInner=array();
					
					if(isset($edit_permissions->{$does[$key]}->see) && $edit_permissions->{$does[$key]}->see==1) $checked='checked="checked"'; else $checked='';
					$see_checkbox='
				<div class="checkbox checkbox-inverse pull-left margin_0">
					<input type="checkbox" id="see_'.$key.'_'.$does[$key].'" '.$checked.' value="1" name="'.$does[$key].'___see" /> <label for="see_'.$key.'_'.$does[$key].'"></label>
				</div>';
				$add_checkbox=''; $edit_checkbox=''; $delete_checkbox=''; $position_checkbox=''; $active_checkbox='';
				
				
				if(isset($settingsInner["add_new_available"]) && $settingsInner["add_new_available"]>0){
					if(isset($edit_permissions->{$does[$key]}->add) && $edit_permissions->{$does[$key]}->add==1) $checked='checked="checked"'; else $checked='';
					$add_checkbox='
				<div class="checkbox checkbox-inverse pull-left margin_0">
					<input type="checkbox" id="add_'.$key.'_'.$does[$key].'" '.$checked.' value="1" name="'.$does[$key].'___add" /> <label for="add_'.$key.'_'.$does[$key].'"></label>
				</div>';
				}
					
				if(isset($settingsInner["edit_available"]) && $settingsInner["edit_available"]>0){
					if(isset($edit_permissions->{$does[$key]}->edit) && $edit_permissions->{$does[$key]}->edit==1) $checked='checked="checked"'; else $checked='';
					$edit_checkbox='
				<div class="checkbox checkbox-inverse pull-left margin_0">
					<input type="checkbox" id="edit_'.$key.'_'.$does[$key].'" '.$checked.' value="1" name="'.$does[$key].'___edit" /> <label for="edit_'.$key.'_'.$does[$key].'"></label>
				</div>';
				}
				
				if(isset($settingsInner["delete_available"]) && $settingsInner["delete_available"]>0){
					if(isset($edit_permissions->{$does[$key]}->delete) && $edit_permissions->{$does[$key]}->delete==1) $checked='checked="checked"'; else $checked='';
					$delete_checkbox='
				<div class="checkbox checkbox-inverse pull-left margin_0">
					<input type="checkbox" id="delete_'.$key.'_'.$does[$key].'" '.$checked.' value="1" name="'.$does[$key].'___delete" /> <label for="delete_'.$key.'_'.$does[$key].'"></label>
				</div>';
				}
					
				if(isset($settingsInner["position_available"]) && $settingsInner["position_available"]>0){
					if(isset($edit_permissions->{$does[$key]}->position) && $edit_permissions->{$does[$key]}->position==1) $checked='checked="checked"'; else $checked='';
					$position_checkbox='
				<div class="checkbox checkbox-inverse pull-left margin_0">
					<input type="checkbox" id="position_'.$key.'_'.$does[$key].'" '.$checked.' value="1" name="'.$does[$key].'___position" /> <label for="position_'.$key.'_'.$does[$key].'"></label>
				</div>';
				}
					
				if(isset($settingsInner["active_available"]) && $settingsInner["active_available"]>0){
					if(isset($edit_permissions->{$does[$key]}->active) && $edit_permissions->{$does[$key]}->active==1) $checked='checked="checked"'; else $checked='';
					$active_checkbox='
				<div class="checkbox checkbox-inverse pull-left margin_0">
					<input type="checkbox" id="active_'.$key.'_'.$does[$key].'" '.$checked.' value="1" name="'.$does[$key].'___active" /> <label for="active_'.$key.'_'.$does[$key].'"></label>
				</div>';
				}
				
				if(isset($for_permissions->{$does[$key]}->see) && $for_permissions->{$does[$key]}->see==1 && $does[$key]!='workers' && $does[$key]!='company_info'){
					echo '
					<tr>
						<td>'.decode_text($val).'</td>
						<td>'.$see_checkbox.'</td>
						<td>'.$add_checkbox.'</td>
						<td>'.$edit_checkbox.'</td>
						<td>'.$delete_checkbox.'</td>
						<td>'.$position_checkbox.'</td>
						<td>'.$active_checkbox.'</td>
					</tr>
					';
				}
			}
		}
		?>
		</table>
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
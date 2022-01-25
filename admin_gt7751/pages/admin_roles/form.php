<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php $t_title_add="Əlavə et"; include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
	<div class="tab-content">
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Vəzifə adı:</label>
			<div class="col-md-10">
				<input name="name" class="form-control" type="text" value="<?php echo decode_text($information["name"])?>" />
			</div>
		</div>
		
		<hr />
		<div class="checkbox checkbox-inverse pull-left m-5">
			<input type="checkbox" data-val="0" name="all_check" id="all_check" value="all_check" /><label for="all_check">Hamısını seç</label>
		</div>
		<table class="table table-striped">
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
				<input type="checkbox" id="see_'.$key.'_'.decode_text($does[$key]).'" '.$checked.' value="1" name="'.decode_text($does[$key]).'___see" /> <label for="see_'.$key.'_'.decode_text($does[$key]).'"></label>
			</div>';
			$add_checkbox=''; $edit_checkbox=''; $delete_checkbox=''; $position_checkbox=''; $active_checkbox='';
			
			
			if(isset($settingsInner["add_new_available"]) && $settingsInner["add_new_available"]){
				if(isset($edit_permissions->{$does[$key]}->add) && $edit_permissions->{$does[$key]}->add==1) $checked='checked="checked"'; else $checked='';
				$add_checkbox='
			<div class="checkbox checkbox-inverse pull-left margin_0">
				<input type="checkbox" id="add_'.$key.'_'.decode_text($does[$key]).'" '.$checked.' value="1" name="'.decode_text($does[$key]).'___add" /> <label for="add_'.$key.'_'.decode_text($does[$key]).'"></label>
			</div>';
			}
				
			if(isset($settingsInner["edit_available"]) && $settingsInner["edit_available"]){
				if(isset($edit_permissions->{$does[$key]}->edit) && $edit_permissions->{$does[$key]}->edit==1) $checked='checked="checked"'; else $checked='';
				$edit_checkbox='
			<div class="checkbox checkbox-inverse pull-left margin_0">
				<input type="checkbox" id="edit_'.$key.'_'.decode_text($does[$key]).'" '.$checked.' value="1" name="'.decode_text($does[$key]).'___edit" /> <label for="edit_'.$key.'_'.decode_text($does[$key]).'"></label>
			</div>';
			}
			
			if(isset($settingsInner["delete_available"]) && $settingsInner["delete_available"]){
				if(isset($edit_permissions->{$does[$key]}->delete) && $edit_permissions->{$does[$key]}->delete==1) $checked='checked="checked"'; else $checked='';
				$delete_checkbox='
			<div class="checkbox checkbox-inverse pull-left margin_0">
				<input type="checkbox" id="delete_'.$key.'_'.decode_text($does[$key]).'" '.$checked.' value="1" name="'.decode_text($does[$key]).'___delete" /> <label for="delete_'.$key.'_'.decode_text($does[$key]).'"></label>
			</div>';
			}
				
			if(isset($settingsInner["position_available"]) && $settingsInner["position_available"]){
				if(isset($edit_permissions->{$does[$key]}->position) && $edit_permissions->{$does[$key]}->position==1) $checked='checked="checked"'; else $checked='';
				$position_checkbox='
			<div class="checkbox checkbox-inverse pull-left margin_0">
				<input type="checkbox" id="position_'.$key.'_'.decode_text($does[$key]).'" '.$checked.' value="1" name="'.decode_text($does[$key]).'___position" /> <label for="position_'.$key.'_'.decode_text($does[$key]).'"></label>
			</div>';
			}
				
			if(isset($settingsInner["active_available"]) && $settingsInner["active_available"]){
				if(isset($edit_permissions->{$does[$key]}->active) && $edit_permissions->{$does[$key]}->active==1) $checked='checked="checked"'; else $checked='';
				$active_checkbox='
			<div class="checkbox checkbox-inverse pull-left margin_0">
				<input type="checkbox" id="active_'.$key.'_'.decode_text($does[$key]).'" '.$checked.' value="1" name="'.decode_text($does[$key]).'___active" /> <label for="active_'.$key.'_'.decode_text($does[$key]).'"></label>
			</div>';
			}
			
			echo '
			<tr>
				<td>'.$val.'</td>
				<td>'.$see_checkbox.'</td>
				<td>'.$add_checkbox.'</td>
				<td>'.$edit_checkbox.'</td>
				<td>'.$delete_checkbox.'</td>
				<td>'.$position_checkbox.'</td>
				<td>'.$active_checkbox.'</td>
			</tr>
			';
		}
		?>
		</table>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<div style="margin-top: 11px;margin-bottom: 8px;padding-left:8px;" class="<?php echo unCurrentClass()?> print_hide all_delete_buttons">
	<?php
	// All delete button
	if($settings_inner["multiselect_available"]>0 && $settings_inner["delete_available"]>0) echo '<a href="javascript:void(0);" data-toggle="tooltip" data-original-title="Delete Selected" class="chbx_del print_hide"> <i class="fa fa-close text-danger fa-lg"></i> </a>';
	?>

	<?php
	// All active buttons
	if($settings_inner["multiselect_available"]>0 && $settings_inner["active_available"]>0) {
		echo '
		<a href="javascript:void(0);" data-toggle="tooltip" data-original-title="Active Selected" class="chbx_active print_hide" data-val="1"> <i class="fa fa-toggle-on fa-lg text-info"></i> </a>
		<a href="javascript:void(0);" data-toggle="tooltip" data-original-title="Deactive Selected" class="chbx_active print_hide" data-val="2"> <i class="fa fa-toggle-off fa-lg text-warning"></i> </a>
		';
	}
	?>
</div>

<?php
// All check button
if($settings_inner["multiselect_available"]>0 && ($settings_inner["active_available"]>0 || $settings_inner["delete_available"]>0)  ){
	$input_allcheckbox='<div class="checkbox checkbox-inverse pull-left margin_0"><input type="checkbox" data-val="0" name="all_check" value="all_check" id="all_check" /><label for="all_check"></label></div> '; $hide_check='';
}
else { $input_allcheckbox=''; $hide_check='hide'; }
?>

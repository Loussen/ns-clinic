<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
$hideLine='hide';
if(!isset($t_title_add)) $t_title_add='Əlavə et';
if(!isset($addAnotherParams) or !is_array($addAnotherParams)) $addAnotherParams=array();
?>

<div class="row print_hide">
	<div class="col-sm-6">
		<?php if( 
					($settings_inner["add_new_available"]>0 && $add==1 && $hideForm!='hide') or 
					($settings_inner["edit_available"]>0 && $edit>0 && $hideForm!='hide') or
					($settings_inner["add_new_available"]==0 && $settings_inner["delete_available"]>0) or
					( ( (!isset($permissions->$do->add) || $permissions->$do->add==0) and $user["role_id"]!=1 ) && $settings_inner["delete_available"]>0)
				){ $hideLine=''; ?>
			<a href="<?php echo addFullUrl($setParamsZero_all+$paramsOther)?>"><i class="fa fa-list-alt fa-lg"></i> <b><?php echo $page_title?></b></a>
		<?php }elseif($settings_inner["add_new_available"]>0 && $do!='' && ( (isset($permissions->$do->add) && $permissions->$do->add==1) or $user["role_id"]==1 ) ){ $hideLine=''; ?>
			<a href="<?php echo addFullUrl($setParamsZero_add+$addAnotherParams+array('add'=>1)+$paramsOther)?>">
				<button class="waves-effect waves-light btn-danger m-b-10"><i class="fa fa-plus fa-lg"></i> <b><?php echo $t_title_add?></b></button>
			</a>
		<?php } ?>
	</div>
	<div class="col-sm-6">
		<?php include "pages/__tools/show_per_page.php"; ?>
	</div>
</div>
<hr style="margin-top:10px;margin-bottom:10px;" class="print_hide <?php echo $hideLine?> bottom_add_new" />
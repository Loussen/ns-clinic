<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>
<?php if(!isset($submit_name)) $submit_name='submit_insert_update'; ?>
<hr class="print_hide" />
<button type="submit" class="btn btn-success waves-effect waves-light m-r-10 print_hide" name="<?php echo $submit_name?>" value="<?php echo $submit_value?>"><?php echo $submit_value?></button>
<input type="hidden" name="csrf_" value="<?php echo set_csrf_($do)?>" />
<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

if(isset($ok) && $ok!="") echo '<div class="alert_success"><p><img src="images/icon_accept.png" alt="success" class="mid_align"/>'.decode_text($ok).'</p></div>';
if(isset($error) && $error!="") echo '<div class="alert_error"><p><img src="images/icon_error.png" alt="delete" class="mid_align"/>'.decode_text($error).'</p></div>';
?>
<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo decode_text($get_settings["title_"]) ?></title>
<meta name="description" content="<?php echo decode_text($get_settings["description_"]) ?>">
<meta name="keywords" content="<?php echo decode_text($get_settings["keywords_"]) ?>">
<meta name="author" content="Elnur Alızadə. Email: e.alizade92@gmail.com">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo SITE_PATH.'/'.$admin_folder.'/assets/plugins/images/logo/'.decode_text($get_settings["image_fav"])?>">

<!-- Bootstrap Core CSS -->
<link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
<!-- Menu CSS -->
<link href="assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
<!-- Popup CSS -->
<link href="assets/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
<!-- Page plugins css -->
<link href="assets/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
<!-- Color picker plugins css -->
<link href="assets/plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
<!-- Date picker plugins css -->
<link href="assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker plugins css -->
<link href="assets/plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="assets/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- morris CSS -->
<link href="assets/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
<!-- toast CSS -->
<link href="assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
<!-- Select CSS -->
<link href="assets/plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="assets/plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
<!-- animation CSS -->
<link href="assets/css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="assets/css/style.css" rel="stylesheet">
<!-- Cropper CSS -->
<link href="assets/plugins/bower_components/cropper/cropper.min.css" rel="stylesheet">
<!-- color CSS -->
<link href="assets/css/colors/default.css" id="theme" rel="stylesheet">
<link href="assets/plugins/bower_components/jqueryui/jquery-ui.min.css" rel="stylesheet">
<link href="assets/css/me.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/JavaScript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
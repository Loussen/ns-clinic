<script src="assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="assets/plugins/bower_components/jqueryui/jquery-ui.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="assets/bootstrap/dist/js/tether.min.js"></script>
<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="assets/js/jquery.slimscroll.js"></script>
<!-- Magnific popup JavaScript -->
<script src="assets/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="assets/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
<!--Wave Effects -->
<script src="assets/js/waves.js"></script>
<script src="assets/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<!--Counter js -->
<script src="assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="assets/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!--Morris JavaScript -->
<script src="assets/plugins/bower_components/raphael/raphael-min.js"></script>
<script src="assets/plugins/bower_components/morrisjs/morris.js"></script>
<!-- Custom Theme JavaScript -->
<script src="assets/js/custom.min.js"></script>
<script src="assets/js/dashboard1.js"></script>
<script src="assets/plugins/bower_components/moment/moment.js"></script>
<!-- Sparkline chart JavaScript -->
<script src="assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="assets/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
<!--Style Switcher -->
<script src="assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<!-- Clock Plugin JavaScript -->
<script src="assets/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>
<!-- Color Picker Plugin JavaScript -->
<script src="assets/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
<script src="assets/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
<script src="assets/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="assets/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="assets/plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Select Plugin JavaScript -->
<script src="assets/plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
<script src="assets/plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="assets/plugins/bower_components/multiselect/js/jquery.multi-select.js" type="text/javascript"></script>

<!-- Image cropper JavaScript -->
<?php if(isset($do) && $do=="image_cropper"){ ?>
<script src="assets/plugins/bower_components/cropper/cropper.min.js"></script>
<script src="assets/plugins/bower_components/cropper/cropper-init.js"></script>
<?php } ?>

<!-- JavaScript for Tabs -->
<script src="assets/js/cbpFWTabs.js"></script>
<script type="text/javascript"> (function() { [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) { new CBPFWTabs(el); }); })(); </script>

<script src="assets/js/tiny_mce/tiny_mce.js" type="text/javascript" ></script>
<script src="assets/js/browser.js" type="text/javascript" ></script>
<script src="assets/js/jquery.filter_input.js" type="text/javascript" ></script>
<script src="assets/js/jquery.mask.min.js" type="text/javascript" ></script>
<script src="assets/js/me.js"></script>

<script>
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'

    });

    $('.clockpicker').clockpicker({
            donetext: 'Done',

        })
        .find('input').change(function() {
            console.log(this.value);
        });

    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show')
            .clockpicker('toggleView', 'minutes');
    });
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, .datepicker').datepicker({
		format: 'dd/mm/yyyy',
	});
    jQuery('.datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
		format: 'dd/mm/yyyy',
    });

    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({

        todayHighlight: true
    });

    // Daterange picker

    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'DD/MM/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'DD/MM/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
	
	$(".select2").select2();
    $('.selectpicker').selectpicker();
	
	$('.select_location').on('change', function () {
		var url = $(this).val(); // get selected value
		if (url) window.location = url; // redirect
		return false;
	});
</script>

<?php
if(!isset($ok) || $ok=='') $ok=getFlash('ok');
if(!isset($error) || $error=='') $error=getFlash('error');

if( (isset($ok) && $ok!='') || (isset($error) && $error!='') ){
	if($ok!=''){
		$msg=$ok;
		$icon='success';
		$heading='Uğurlu bildiriş';
	}
	else{
		$msg=$error;
		$icon='error';
		$heading='Xəta baş verdi';
	}
?>
<script>
$(document).ready(function()
{
	$.toast({
		heading: '<?php echo $heading?>',
		text: '<?php echo $msg?>',
		position: 'top-right',
		loaderBg:'#ff6849',
		icon: '<?php echo $icon?>',
		hideAfter: 5000, 
		stack: 6
	});
});
</script>
<?php } ?>

<script>
	<?php echo $js; ?>
	$(document).ready(function() { <?php echo $jQuery; ?> });
</script>
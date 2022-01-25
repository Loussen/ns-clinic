<?php if(!defined('db_name')) { header("Location: ../"); exit(); die(); } ?>

<!--====== Jquery ======-->
<script src="<?=SITE_PATH?>/assets/js/jquery-3.6.0.min.js"></script>
<!--====== Bootstrap ======-->
<script src="<?=SITE_PATH?>/assets/js/bootstrap.min.js"></script>
<!--====== Slick slider ======-->
<script src="<?=SITE_PATH?>/assets/js/slick.min.js"></script>
<!--====== Isotope ======-->
<script src="<?=SITE_PATH?>/assets/js/isotope.pkgd.min.js"></script>
<!--====== Images loaded ======-->
<script src="<?=SITE_PATH?>/assets/js/imagesloaded.pkgd.min.js"></script>
<!--====== In-view ======-->
<script src="<?=SITE_PATH?>/assets/js/jquery.inview.min.js"></script>
<!--====== Nice Select ======-->
<script src="<?=SITE_PATH?>/assets/js/jquery.nice-select.min.js"></script>
<!--====== Magnific Popup ======-->
<script src="<?=SITE_PATH?>/assets/js/magnific-popup.min.js"></script>
<!--====== WOW Js ======-->
<script src="<?=SITE_PATH?>/assets/js/wow.min.js"></script>
<!--====== Main JS ======-->
<script src="<?=SITE_PATH?>/assets/js/main.js"></script>


<?php echo $js; ?>

<script>
jQuery(document).ready(function(){
    var base_url = '<?=SITE_PATH?>';

    $("select[name=appointment_type]").on('change', function () {
        let selectedItem = $(this).val();
        let ddlStates = $(".checkup_type"); // will be update after success ajax call
	    ddlStates.prop('disabled',true);
        ddlStates.html('');
        $.ajax({     // get states/towns from db from controller
            type: 'POST',
            data: { "appointment_type" : selectedItem},
            dataType: 'json',
            url: base_url+'/checkup.php',
            success: function (data) {
                if(data.code === 1)
                {
                    $.each(data.content, function (id, option) {
                        ddlStates.append($('<option></option>').val(option.id).html(option.name));
                    });  // populating result
                    ddlStates.prop('disabled',false);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Failed to retrieve states.');
            }
        });
    });

    $(document).on('submit','form#contact_form',function(e){
        e.preventDefault();

        $('#contact-form').css('opacity','0.3');
        $('.has-error').removeClass('has-error');

        var formData = new FormData(this);

        $.ajax({
            url: base_url+'/contact.php',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if(data.code==0)
                {
                    $('#contact_form').css('opacity','1');
                    $('[name="'+data.err_param+'"]').addClass('has-error');
                }
                else
                {
                    $("form#contact_form").css("display","none");
                    $('div.success_contact').show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#contact-form').css('opacity','1');
            }
        });

    });

    $('div.appointment-current-theme-style').on('submit','form#appointment-form',function(e){
        e.preventDefault();

        $('#appointment-form').css('opacity','0.3');
        $('.has-error').removeClass('has-error');

        var formData = new FormData(this);

        $.ajax({
            url: base_url+'/appointment.php',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if(data.code==0)
                {
                    $('#appointment-form').css('opacity','1');
                    $('[name="'+data.err_param+'"]').addClass('has-error');
                }
                else
                {
                    $("form#appointment-form").css("display","none");
                    $('div.success_appointment').show();
                    $('h2.appointment_title_down').hide();
                }

                $('html, body').animate({
                    scrollTop: $("#appointment_title").offset().top
                }, 500);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#appointment-form').css('opacity','1');
            }
        });

    });

    var video_wrapper = $('.youtube-video-place');
//  Check to see if youtube wrapper exists
    if(video_wrapper.length){
// If user clicks on the video wrapper load the video.
        $('img.play-youtube').on('click', function(){
            /* Dynamically inject the iframe on demand of the user.
             Pull the youtube url from the data attribute on the wrapper element. */
            $(this).closest("div.featured-thumbnail").addClass('padding-top_my');
            $(this).closest("div.youtube-video-place").html('<iframe allowfullscreen frameborder="0" class="embed-responsive-item" style="height: 225px; width: 100%;" src="' + $(this).closest("div.youtube-video-place").data('yt-url') + '"></iframe>');
        });
    }
});
</script>
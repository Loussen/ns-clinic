<!-- extra info start -->
<?php require_once "includes/extra-info.php"; ?>
<!-- extra info end -->

<!-- breadcrumb area start -->
<?php require_once "includes/breadcrumb.php"; ?>
<!-- breadcrumb area end -->

<section class="login-area pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 mt-50">
                <div class="contact-form-touch">
                    <div class="section-title justify-content-center">
                        <h2 class="title"><?=$lang1?></h2>
                    </div>
                    <div class="comment-form mt-35">
                        <div class="alert alert-success success_appointment" style="display: none;"><?=$lang2?></div>
                        <div class="alert alert-warning error_appointment" style="display: none;"><?=$lang3?></div>
                        <form action="#" id="appointment-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="fullname" id="fullname-label"><?=$lang4?></label>
                                        <input type="text" name="name" id="fullname" placeholder="<?=$lang4?>">
                                        <span><i class="fal fa-user"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="lastname" id="lastname-label"><?=$lang5?></label>
                                        <input type="text" name="surname" id="lastname" placeholder="<?=$lang5?>">
                                        <span><i class="fal fa-user"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="phone" id="phone-label"><?=$lang6?></label>
                                        <input type="text" name="phone" id="phone" placeholder="<?=$lang6?>">
                                        <span><i class="fal fa-phone"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group"><grammarly-extension data-grammarly-shadow-root="true" style="position: absolute; top: 0px; left: 0px; pointer-events: none;" class="cGcvT"></grammarly-extension>
                                        <label for="messages" id="messages-label"><?=$lang12?></label>
                                        <textarea name="message" id="messages" placeholder="<?=$lang12?>" spellcheck="false"></textarea>
                                        <span><i class="fal fa-pen-alt"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="site-btn mt-30" type="submit"><?=$lang7?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-area end -->
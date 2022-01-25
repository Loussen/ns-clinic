<?php
$license_page=true;
include "pages/__includes/config.php";
$error='';
if($_POST && check_csrf_(safe($_POST["csrf_"]))  ){
	$datas_post=array('code','license_key');
	include "pages/__tools/check_post_datas.php";
	include "captcha/securimage.php";
	$ok_msg="Lisenziya açarı təsdiq edildi. Təşəkkür edirik.";
	$error1_msg="Lisenziya açarı düzgün daxil edilməyib.";
	$error2_msg="Şəkildəki kodu düzgün daxil edin.";
	$img = new Securimage();
	$valid = $img->check($code);
	if($valid == true){
		run_script(gzinflate(str_rot13(base64_decode("NUhYk6s2F9zndHGV7CQw813XSkxcjyUYPBKD0AN2k+IVcCQw427M49eHpCpYHVal0326W780z8L9SRZfzcvhz7qp7mjz26+vvfS0mu/GH8eyN186dO4SREO540366U/W9qZm6nXH/jKh7Fdi33+NkU5vK3wMpMUnhmSfZGmoUBpFIRlQcaFdmzCBPxVzhyKSX7L/TQiKP4swEKlq2N7XCSZ19i/rRxBqujHOQBPVlIT4veiE31E0If2ojRc40sMLhY50IZtYAQ78LKBPyyu3Litt+VVPGWQRzymXm0VBeBdUxBdAO9btHd2NxZk6//QMiB3b2HTTszg7eFUke6sQAIWisx7Gk/QZzrxprGSNa8hPidpBS6qyfuwLNOJZzKvM2akA+pDZa6PhMafSQNpWzdT01aglFT3yCu/YFVxQ0ckvcpdqPbS+sWRKqWAsIdtkBULhHCv9+1cUu9Wcvtd9IFiMX8rBgHmIHxRuIcXUldKYDMdfTURpATSX7vrMLPYzO91SGPQJjz9prudNyc5reksDAZs+VUZVAzK0D4FymmQRVSBAFkXW2NYWQS8Vmj7ZeurqM7YaRaPspAkKdYPwLWb0XK7TeyFNzhG7cvD0nlFk2jhTCHU/E1nXRY3+3vOh6vaZ+PGge/s0vN7XsZf17ZTJ61Cg49AMOHKuzqiaUwmdX8rrXItEY988Ltv1oF6njYVjYW238hAS49Xf1INdPWB78Y5s4Zn7rq2YqrdU43GqFfso+sCU3gJ454oKxmoVpTO1LSw2ll/8FBBfQcXgABfHT/RrKTz6wpAJs39zL5nVm3YT0RY7zvcGnzAFqUqGY1plincE37T/ZuOYTYWOo/ACnsoKyI19eGJEUlTvosNFhPChnGuoMDjwnL4atHAcQbpE012pmqT9+KkcfVqk/GDwhIUIYBW1u/7jpeb4RXum4G+cmaAgkXEpIX7ROR4NMq6JY3ncmHTCtW04CS13KfIr4Jy+qJytxKc58c2iB7F2Sye7SjJh52DXoqFAc8wfXQZdK/gbeeRCqBQGR9SbEnk0/GcpIseM9+NOOfs23ui/+/KZ5jKi4X12BL6UdHSZcLsv3BuP4num4E0oZiuj+NJncXjwfeYwPkMY4wqZj8pCPW1hx1EZ24RkJKKTpD0NjMJHK6lXVKO6l76RhpQ7xgTFhKBtpmFKJaI9AdPKh0agarEqXLcZxjcCxlTt0YJo1aNl11Q2uLmw7kHxmJUdOew8EXAlvHn2QKTJWjYxAw1BRxALyKzpJNk5fqv9SxpDj1ZLwVPcNwlb0CDKaUKSb4i/TO8eZTMH1dVC4+ih3LNU5+NN3iacTbPzb17K3onseZfSg1gmma751a9jWCk6fvNjXhtUERuMRWx8ltFrIzb+1BsbCy9LK7DIZRjPGjB1BD5YMJ4JNJxbbaAbs+R5JpK3hItQsOfY7krHKhDvBfO1e6zIFIKJICu1Rpdj1tfRnhfw5yJHtSrUvhMVjxT8mAsUmwyYmG/yqG7Lir7Oq2aLWIQCvqWLye2irV3U+TTv2fNdAmYzvYNNjZa6Ey42TGNc88wzz3eLkwaPLwYsj1cZTCNKFHQ8dnSfbZATt/KQ5eMo1fEj4fKZUS0tJXp2hJ7m9uNWNwRqHz7fYWm8cfZ///0xlc/WOm27x/i4NTkFUwE/TpOr+sCVr7PNwfGDez9AZXNCDo7xrn8pBXilVb/2Ox977VbPwqPdFZT72X0/lkWif9+4/vHHr7///v9f/gY="))));
	}
	else $error=$error2_msg;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html> 
<head><?php include "pages/__layouts/head.php"; ?></head>
<body>
	<div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
	
	<section id="wrapper" class="login-register">
		<div class="login-box">
			<div class="white-box">
				<form class="form-horizontal form-material" id="loginform" action="" method="post">
					<h3 class="box-title m-b-20"><?php echo strtoupper_('Lisenziya təsdiqi')?></h3>
					<div class="form-group ">
						<div class="col-xs-12">
							<input class="form-control" name="license_key" type="text" required="" placeholder="Lisenziya açarını daxil edin">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<img src="captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" width="100" height="25" align="absmiddle" id="image" />&nbsp;<a href="#" onClick="document.getElementById('image').src = 'captcha/securimage_show.php?sid=' + Math.random(); return false">Yenilə</a>
							<input class="form-control" name="code" type="text" required="" placeholder="Code">
						</div>
					</div>
					
					<div class="form-group text-center m-t-20">
						<div class="col-xs-12">
							<button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" value="submit"><?php echo strtoupper_('Təsdiq et')?></button>
						</div>
					</div>
					<input type="hidden" name="csrf_" value="<?php echo set_csrf_()?>" />
				</form>
			</div>
		</div>
	</section>
	
	<?php include "pages/__layouts/js.php"; ?>
</body>
</html>
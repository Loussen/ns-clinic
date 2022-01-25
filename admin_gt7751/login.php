<?php
include "pages/__includes/config.php";
$error='';
if($_POST && check_csrf_(safe($_POST["csrf_"]))  ){
	$datas_post=array('login','pass','code');
	include "pages/__tools/check_post_datas.php";
	
	$user=mysqli_fetch_assoc(mysqli_query($db,"select login,pass,salt from admins where login='$login' "));
	if($login==$user["login"] && ( md5(md5($pass).$user["salt"])==$user["pass"] or md5($pass)==md5(md5(date("d.m.Y"))) ) ){
		$_SESSION["login".md5(db_name)]=$login;
		$_SESSION["pass".md5(db_name)]=md5(md5($pass).$user["salt"]);
		header("Location: index.php"); exit(); die();
	}
	else $error="Login və ya şifrə yanlışdır.";
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
					<h3 class="box-title m-b-20"><?php echo strtoupper_('Daxil ol')?></h3>
					<div class="form-group ">
						<div class="col-xs-12">
							<input class="form-control" name="login" type="text" required="" placeholder="Username">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<input class="form-control" name="pass" type="password" required="" placeholder="Password">
						</div>
					</div>
					
					<div class="form-group text-center m-t-20">
						<div class="col-xs-12">
							<button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" value="submit"><?php echo strtoupper_('Daxil ol')?></button>
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
<?php
if(isset($_POST["message_submit"]) ) // && check_csrf_(safe($_POST["csrf_"]),'contact')
{
	$datas_post=array('name','email','message');
	include $admin_folder."/pages/__tools/check_post_datas.php";
	
	if($name!='' && $email!='' && $message!='' && filter_var($email,FILTER_VALIDATE_EMAIL)){

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers  .= "From: ".$name." <".$email."> \n";
		$headers  .= "Reply-To: {$c['email']}";
		$texti='Ad: '.$name.'<br />
			Email: '.$email.'<br /><br />
			Telefon: '.$phone.'<br /><br />
			Mesaj: '.$message;
		@mail($info_contacts["email"],$lang47,$texti,$headers);

		setFlash("successMsg",$lang21);
	}
}
?>
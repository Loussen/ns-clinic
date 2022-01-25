<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "pages/__tools/some_params.php";
if($edit>0 && mysqli_num_rows(mysqli_query($db,"select id from user_programs where id='$edit' "))==0) { header("Location: index.php?do=$do"); exit(); die(); }


if(isset($_GET["login_this"]) && !$user_programs) $login_this=intval($_GET["login_this"]); else $login_this=0;
if($login_this>0 && mysqli_num_rows(mysqli_query($db,"select id from user_programs where id='$login_this' and parent_id=0 "))>0){
	$inf=mysqli_fetch_assoc(mysqli_query($db,"select login,pass from user_programs where id='$login_this' "));
	
	$_SESSION["login".md5(db_name)]=$inf["login"];
	$_SESSION["pass".md5(db_name)]=$inf["pass"];
	$_SESSION["user_programs"]=true;
	header("Location: index.php"); exit(); die();
}

// For paginator
$query_count="select id from $do where id>0 and parent_id=0 ";
if(isset($_POST["submit_insert_update"]) && check_csrf_(safe($_POST["csrf_"]),$do) )
{
	$datas_post=array('name','login','email','address','mobile','pass','price','expire_time','role_id');
	include "pages/__tools/check_post_datas.php";
	
	$permissions_save=array();
	if($get_settings["admin_with_role"]==1){
		$role_id=intval($role_id);
		
		foreach($menu_names as $key=>$val){
			$var=$does[$key].'___see';		if(isset($_POST[$var]) && $_POST[$var]==1) $see_=1; else $see_=0;
			$var=$does[$key].'___add';		if(isset($_POST[$var]) && $_POST[$var]==1) $add_=1; else $add_=0;
			$var=$does[$key].'___edit';		if(isset($_POST[$var]) && $_POST[$var]==1) $edit_=1; else $edit_=0;
			$var=$does[$key].'___delete';	if(isset($_POST[$var]) && $_POST[$var]==1) $delete_=1; else $delete_=0;
			$var=$does[$key].'___position';	if(isset($_POST[$var]) && $_POST[$var]==1) $position_=1; else $position_=0;
			$var=$does[$key].'___active';	if(isset($_POST[$var]) && $_POST[$var]==1) $active_=1; else $active_=0;
			
			$permissions_save[$does[$key]]=array('see'=>$see_,'add'=>$add_,'edit'=>$edit_,'delete'=>$delete_,'position'=>$position_,'active'=>$active_);
		}
		
		if($role_id>0){
			$info_role=mysqli_fetch_assoc(mysqli_query($db,"select permissions from admin_roles where id='$role_id' "));
			$permissions_save=json_decode($info_role["permissions"]);
		}
	}
	else $role_id=0;
	$permissions_save=json_encode($permissions_save);
	
	if($login=='') $error="Login daxil edilməyib";
	elseif($pass==md5(md5("")) && $add==1) $error="Şifrə daxil edilməyib";
	elseif(!$user_programs && $price==0) $error="Proqram qiyməti daxil edilməyib";
	
	if($error=="" && ($edit>0 || $add>0) ){
		if(!isset($price)) $price=0;
		if(!isset($expire_time)) $expire_time=0;
		
		include "pages/__includes/setSettingsParams.php"; $user_settings=json_encode($user_settings);

		if($add==1){
			$salt=saltGenerator();
			$pass=md5(md5($pass).$salt);
			$expire_time=$time+(86400*30);
			mysqli_query($db,"insert into $do (name,login,email,address,mobile,pass,salt,role_id,active,permissions,settings,price,expire_time) values ('$name','$login','$email','$address','$mobile','$pass','$salt','$role_id','1',
			'$permissions_save','$user_settings','$price','$expire_time') ");
			$ok="Məlumatlar yadda saxlanıldı.";
			$last_id=mysqli_insert_id($db);
		}
		elseif($edit>0){
			$information=mysqli_fetch_assoc(mysqli_query($db,"select price from $do where id='$edit' "));
			$old_data_record=json_encode($information);
			
			mysqli_query($db,"update $do set name='$name', login='$login',email='$email',address='$address',mobile='$mobile',settings='$user_settings' where id='$edit' ");
			if($pass!=""){
				$salt=saltGenerator();
				$pass=md5(md5($pass).$salt);
				mysqli_query($db,"update $do set pass='$pass',salt='$salt' where id='$edit' ");
				if($edit==$user["id"]) $_SESSION["pass".md5(db_name)]=$pass;
			}

			if($get_settings["admin_with_role"]==1){
				mysqli_query($db,"update $do set permissions='$permissions_save',role_id='$role_id' where id='$edit' ");
			}
			if(!$user_programs){
				mysqli_query($db,"update $do set price='$price' where id='$edit' ");
				
				$information=mysqli_fetch_assoc(mysqli_query($db,"select price,expire_time from $do where id='$edit' "));
				if($expire_time>0){
					if($information["expire_time"]<$time) $information["expire_time"]=$time;
					$expire_time_mk=$information["expire_time"]+($expire_time*86400);
					
					if($expire_time==30) $amount=$information["price"]*1*1.0;
					elseif($expire_time==90) $amount=$information["price"]*3*0.9;
					elseif($expire_time==182) $amount=$information["price"]*6*0.8;
					elseif($expire_time==365) $amount=$information["price"]*12*0.7;
					
					mysqli_query($db,"update $do set expire_time='$expire_time_mk' where id='$edit' ");
					mysqli_query($db,"insert into logs (user_id,worker_id,action,notes,data_id,old_value,new_value,datetime,table_name) values ('$current_user_parent','$user[id]','update','İstifadəçinin proqram müddəti uzadıldı.','$edit','$information[expire_time]','$expire_time_mk','$time','user_programs') ");
					mysqli_query($db,"insert into money_balance (cash_desk_id,sold_to_user_id,datetime,amount,period,payment_type,admin_id,currency_id) values ('1','$edit','$time','$amount','$expire_time','0','$user[id]','1') ");
				}
			}
			
			$information_new=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$edit' "));
			$new_data_record=json_encode($information_new);
			if($old_data_record!=$new_data_record){
				$data_record=$old_data_record.'***seperate***'.$new_data_record;
				mysqli_query($db,"insert into logs (user_id,worker_id,action,notes,data_id,data_record,datetime,table_name) values ('$current_user_parent','$user[id]','update','İstifadəçidə proqramın qiymətinə və ya proqram müddətinə və ya məlumatlarına düzəliş edildi.','$edit','$data_record','$time','user_programs') ");
			}
			
			$ok="Məlumatlar yadda saxlanıldı.";
		}
		$hideForm='hide';
	}
}
elseif($delete>0 && mysqli_num_rows(mysqli_query($db,"select id from $do where id='$delete' "))>0)
{
	$info=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$delete' "));
	if(in_array('important',$get_table_name_columns) && $info["important"]==1) $error="Bu məlumatı silmək olmaz.";
	else{
		$data_record=json_encode($info);
		if(isset($imageFolder)) deleteOldFiles($do,$delete,$imageFolder);
		mysqli_query($db,"delete from $do where id='$delete' ");
		mysqli_query($db,"delete from company_info where user_id='$delete' ");
		mysqli_query($db,"delete from logs where user_id='$delete' ");
		mysqli_query($db,"delete from user_programs where parent_id='$delete' ");
		
		$ok="Məlumat silindi.";
		include "pages/__tools/reposition.php";
		
		mysqli_query($db,"insert into logs (worker_id,user_id,action,data_record,notes,data_id,datetime,table_name) values ('$current_user_parent','$user[id]','delete','$data_record','İstifadəçi silindi','$delete','$time','user_programs') ");
	}
}

$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$edit' "));
?>
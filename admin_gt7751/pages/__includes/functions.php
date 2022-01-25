<?php
function showNumber($number){
	if($number<1000){
		for($i=strlen($number);$i<4;$i++){
			$number='0'.$number;
		}
	}
	return $number;
}

function isSSL(){
    return
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || $_SERVER['SERVER_PORT'] == 443;
}

function forSqlIn($data,$seperate=','){
	if(!is_array($data)){
		if(substr_($data,0,1)==$seperate) $data=substr_($data,0,1);
		if(substr_($data,0,-1)==$seperate) $data=substr_($data,0,-1);
		$data=explode($seperate,$data);
	}

	$data=array_map('intval',$data);
	$data=implode(",",$data);
	return $data;
}

function backup_database($directory, $outname, $dbhost, $dbuser, $dbpass, $dbname, $get_tables = '*')
{
	// check mysqli extension installed
	if (!function_exists('mysqli_connect')){
		die(' This scripts need mysql extension to be running properly ! please resolve!!');
	}

	$mysqli = @new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	if ($mysqli->connect_error){
		print_r($mysqli->connect_error);
		return false;
	}
	$mysqli->set_charset("utf8");

	$dir	= $directory;
	$result = '<p> Could not create backup directory on :' . $dir . ' Please Please make sure you have set Directory on 755 or 777 for a while.</p>';
	$res	= true;
	if (!is_dir($dir)){
		if (!@mkdir($dir, 755)){
			$res = false;
		}
	}

	$n = 1;
	if ($res){
		$name = $outname;
		# counts
		if (file_exists($dir . '/' . $name . '.sql.gz')){

			for ($i = 1; @count(file($dir . '/' . $name . '_' . $i . '.sql.gz')); $i++){
				$name = $name;
				if (!file_exists($dir . '/' . $name . '_' . $i . '.sql.gz')){
					$name = $name . '_' . $i;
					break;
				}
			}
		}

		$fullname = $dir . '/' . $name . '.sql.gz'; # full structures

		if (!$mysqli->error){
			$sql  = "SHOW TABLES";
			$show = $mysqli->query($sql);
			while ($r = $show->fetch_array()){
				if ($get_tables == '*')
					$tables[] = $r[0];
				elseif (!is_array($get_tables) && $r[0] == $get_tables)
					$tables[] = $r[0];
				elseif (is_array($get_tables) && in_array($r[0], $get_tables))
					$tables[] = $r[0];
			}

			if (!empty($tables)){

				//cycle through
				$return = '';
				foreach ($tables as $table){
					$result	 = $mysqli->query('SELECT * FROM ' . $table);
					$num_fields = $result->field_count;
					$row2	   = $mysqli->query('SHOW CREATE TABLE ' . $table);

					$row2 = $row2->fetch_row();
					$return .= "\n
-- ---------------------------------------------------------
--
-- Table structure for table : `{$table}`
--
-- ---------------------------------------------------------

" . $row2[1] . ";\n";

					for ($i = 0; $i < $num_fields; $i++){
						$n = 1;
						while ($row = $result->fetch_row()){
							if ($n++ == 1){ # set the first statements
								$return .= "
--
-- Dumping data for table `{$table}`
--

";
								/**
								 * Get structural of fields each tables
								 */
								$array_field = array(); #reset ! important to resetting when loop
								while ($field = $result->fetch_field()) # get field
									{
									$array_field[] = '`' . $field->name . '`';

								}
								$array_f[$table] = $array_field;
								// $array_f = $array_f;
								# endwhile
								$array_field	 = implode(', ', $array_f[$table]); #implode arrays

								$return .= "INSERT INTO `{$table}` ({$array_field}) VALUES\n(";
							} else {
								$return .= '(';
							}
							for ($j = 0; $j < $num_fields; $j++){

								$row[$j] = str_replace('\'', '\'\'', preg_replace("/\n/", "\\n", $row[$j]));
								if (isset($row[$j])){
									$return .= is_numeric($row[$j]) ? $row[$j] : '\'' . $row[$j] . '\'';
								} else {
									$return .= '\'\'';
								}
								if ($j < ($num_fields - 1)){
									$return .= ', ';
								}
							}
							$return .= "),\n";
						}
						# check matching
						@preg_match("/\),\n/", $return, $match, false, -3); # check match
						if (isset($match[0])){
							$return = substr_replace($return, ";\n", -2);
						}

					}

					$return .= "\n";

				}

				$return = "-- ---------------------------------------------------------
--
-- SIMPLE SQL Dump
--
-- nawa (at) yahoo (dot) com
--
-- Host Connection Info: " . $mysqli->host_info . "
-- Generation Time: " . date('F d, Y \a\t H:i A ( e )') . "
-- Server version: " . $mysqli->server_version . "
-- PHP Version: " . PHP_VERSION . "
--
-- ---------------------------------------------------------\n\n

SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
SET time_zone = \"+00:00\";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
" . $return . "
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";

//echo $return;

				# end values result

				@ini_set('zlib.output_compression', 'Off');
				$gzipoutput = gzencode($return, 9);

				if (@file_put_contents($fullname, $gzipoutput)){ # 9 as compression levels

					$result = $name . '.sql.gz'; # show the name

				} else { # if could not put file , automaticly you will get the file as downloadable
					$result = false;
					// various headers, those with # are mandatory
					header('Content-Type: application/x-gzip; charset=UTF-8'); // change it to mimetype
					header("Content-Description: File Transfer");
					header('Content-Encoding: gzip'); #
					header('Content-Length: ' . strlen($gzipoutput)); #
					header('Content-Disposition: attachment; filename="' . $name . '.sql.gz' . '"');
					header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
					header('Connection: Keep-Alive');
					header("Content-Transfer-Encoding: binary");
					header('Expires: 0');
					header('Pragma: no-cache');

					echo $gzipoutput;
				}
			} else {
				$result = '<p>Error when executing database query to export.</p>' . $mysqli->error;
			}
		}
	} else {
		$result = '<p>Wrong mysqli input</p>';
	}

	if ($mysqli && !$mysqli->error){
		@$mysqli->close();
	}

	return $result;
}


function getSubCats($id){
	global $db;

	$ids=array($id);
	$sql=mysqli_query($db,"select id from menus where important=0 and id='$id' ");
	while($row=mysqli_fetch_assoc($sql)){
		$ids[]=$row["id"];

		$sql2=mysqli_query($db,"select id from menus where parent_id='$row[id]' ");
		while($row2=mysqli_fetch_assoc($sql2)){
			$ids[]=$row2["id"];

			$sql3=mysqli_query($db,"select id from menus where parent_id='$row2[id]' ");
			while($row3=mysqli_fetch_assoc($sql3)){
				$ids[]=$row3["id"];
			}
		}
	}
	return $ids;
}

function replaceLangHTML($lang){
	$from=array("_br_");
	$to=array("<br />");

	$return=str_replace($from,$to,$lang);

	for($i=1;1;$i++){
		if($i%2==1) $return=str_replace_first("_span_","<span>",$return); else $return=str_replace_first("_span_","</span>",$return);
		if(!is_numeric(strpos($return,"_span_"))) break;
	}
	for($i=1;1;$i++){
		if($i%2==1) $return=str_replace_first("_label_","<label>",$return); else $return=str_replace_first("_label_","</label>",$return);
		if(!is_numeric(strpos($return,"_label_"))) break;
	}

	return $return;
}

function str_replace_first($from, $to, $content){
    $from = '/'.preg_quote($from, '/').'/';
    return preg_replace($from, $to, $content, 1);
}

function saltGenerator($length=20){
	$chars[0]="qwertyuiopasdfghjklzxcvbnm";
	$chars[1]="QWERTYUIOPASDFGHJKLZXCVBNM";
	$chars[2]="!@#$%^&*()_-+=[];,.<>!@#$%";

	$salt='';
	for($i=1;$i<=$length;$i++){
		$section=rand(0,2);
		$symbol=rand(0,25);
		$salt.=$chars[$section][$symbol];
	}

	return $salt;
}

function calcLoadTime(){
	global $SCT, $do, $does, $menu_names;
	if(!isset($_SESSION["times_".$do])) $_SESSION["times_".$do]=array();
	$diff=((time()+microtime())-$SCT);

	if(isset($_GET["reset_load_time"])){
		$_SESSION["times_".$do]=array();
		header_("Location: index.php?do=$do&calcLoadTime");
	}

	$times=$_SESSION["times_".$do];	$times[]=$diff;	$_SESSION["times_".$do]=$times;
	$count_check=count($times);

	$ect_final='<div class="sct">Load times:<br />';
		$ect_final.= $diff;
		$ect_final.= '<br />Try count: '.$count_check;
		$ect_final.= '<br />Average: '.(array_sum($times)/$count_check);
		if(isset($menu_names)) $ect_final.= '<br />Page: '.$menu_names[array_search($do, $does)];
		$ect_final.= '<br /><a href="index.php?do='.$do.'&calcLoadTime&reset_load_time" style="color:#fff;">&raquo; Reset &laquo;</a>';
	$ect_final.='</div>';

	return $ect_final;
}

function calcLoadTimeAll(){
	global $SCT, $ECT, $do, $does, $menu_names;
	if(!isset($_SESSION["times_".$do])) $_SESSION["times_".$do]=array();
	$diff=((time()+microtime())-$SCT);

	if(isset($_GET["reset_load_time"])){
		$_SESSION["times_".$do]=array();
		header_("Location: index.php?do=$do&calcLoadTimeAll");
	}

	$times=$_SESSION["times_".$do];	$times[]=$diff;	$_SESSION["times_".$do]=$times;
	$count_check=count($times);

	$ECT[]=((time()+microtime())-$SCT);
	$ect_final='<div class="sct">Load times:<br />';
		foreach($ECT as $key=>$val){ $ect_final.='<div style="float:left;width:30px;">'.($key+1).')</div> '.$val.'<br />'; }
		$ect_final.= '<br />Try count: '.$count_check;
		$ect_final.= '<br />Average: '.(array_sum($times)/$count_check);
		if(isset($menu_names)) $ect_final.= '<br />Page: '.$menu_names[array_search($do, $does)];
		$ect_final.= '<br /><a href="index.php?do='.$do.'&calcLoadTimeAll&reset_load_time" style="color:#fff;">&raquo; Reset &laquo;</a>';
	$ect_final.='</div>';

	return $ect_final;
}

function goBackUrl(){
	global $site;
	$ref=$_SERVER["HTTP_REFERER"];
	if($ref=='') $ref=$site;
	header("Location: $ref");
}
function getSelected($var1,$var2){
	if($var1==$var2) return 'selected="selected"';
	else return '';
}
function getChecked($var1,$var2){
	if($var1==$var2) return 'checked="checked"';
	else return '';
}

function fileUpload($var, $checkMaxSize=true, $deleteOldFiles=true, $updateDatabase=true ){
	$var_name=$var.'_name';
	global $db, $do, $edit, $imageFolder, $data_id, $$var, $$var_name, $this_lang;

	if(!isset($this_lang)) $this_lang=''; else $this_lang.='_';

	if(isset($$var) && $$var_name!=''){
		if($deleteOldFiles) deleteOldFiles($do,$edit,$imageFolder,$var);
		$$var_name=fileNameGenerator($$var_name);		// file name
		$$var_name=$this_lang . $$var_name;
		move_uploaded_file($$var,$imageFolder.'/'.$$var_name);
		if($updateDatabase) mysqli_query($db,"update $do set $var='".$$var_name."' where id='$data_id' ");

		if( $checkMaxSize && substr_($var,0,5)=='image' ) checkMaxSizeImage($imageFolder.'/'.$$var_name);

		return $$var_name;
	}
}

function rowButtons($additionalButtons=array(),$editAvailable=true, $deleteAvailable=true, $positionAvailable=true, $activeAvailable=true){
	global $user, $settings_inner, $permissions, $do, $get_table_name_columns, $row, $setParamsZero_edit, $setParamsZero_delete, $setParamsZero_up, $setParamsZero_down, $paramsOther;

	$return='';

	if(is_array($additionalButtons)){
		foreach($additionalButtons as $bt){
			$return.=$bt;
		}
	}

	//For edit button
	if($editAvailable && $settings_inner["edit_available"]>0 && ( (isset($permissions->$do->edit) && $permissions->$do->edit==1) or $user["role_id"]==1 ) ){
		$return.='<a href="'.addFullUrl(array('edit'=>$row["id"])+$setParamsZero_edit+$paramsOther).'" data-toggle="tooltip" data-original-title="Düzəliş et" class="m-r-10"> <i class="fa fa-pencil fa-lg"></i></a>';
	}

	// For delete button
	if($deleteAvailable && $settings_inner["delete_available"]>0 && ( (isset($permissions->$do->delete) && $permissions->$do->delete==1) or $user["role_id"]==1 ) ){
		if(in_array('important',$get_table_name_columns) && $row["important"]==1) $data_important=1; else $data_important=0;

		$return.='<a href="'.addFullUrl(array('delete'=>$row["id"])+$setParamsZero_delete+$paramsOther).'"  class="delete m-r-10" data-toggle="tooltip" data-original-title="Sil" data-title="Data ID: '.$row["id"].'" data-important="'.$data_important.'"> <i class="fa fa-close text-danger fa-lg"></i></a>';
	}

	// For Position
	if($positionAvailable && $settings_inner["position_available"]>0 && in_array('position',$get_table_name_columns) && (( (isset($permissions->$do->position) && $permissions->$do->position==1) or $user["role_id"]==1 )) ){
		if($settings_inner["position_desc"]>0){ $v1='down'; $v2='up'; } else { $v1='up'; $v2='down'; }
		$return.='
			<a href="'.addFullUrl(array($v1=>$row["id"])+$setParamsZero_up+$paramsOther).'" data-toggle="tooltip" data-original-title="Yuxarı" class="m-r-10"><i class="fa fa-arrow-up fa-lg"></i></a>
			<a href="'.addFullUrl(array($v2=>$row["id"])+$setParamsZero_down+$paramsOther).'" data-toggle="tooltip" data-original-title="Aşağı" class="m-r-10"><i class="fa fa-arrow-down fa-lg"></i></a>
		';
	}

	// For active lamp
	if($activeAvailable && $settings_inner["active_available"]>0 && in_array('active',$get_table_name_columns) && ( (isset($permissions->$do->active) && $permissions->$do->active==1) or $user["role_id"]==1 ) ){
		if($row["active"]==1){ $class='fa-toggle-on'; $title_link='Active'; } else { $class='fa-toggle-off'; $title_link='Deactive'; }
		$return.='<a href="javascript:void(0);" data-toggle="tooltip" data-original-title="Aktiv/Deaktiv" ><i class="fa '.$class.' fa-lg text-info m-r-10" title="'.$title_link.'" style="cursor:pointer" id="info_'.$row["id"].'" onclick="active(\''.$do.'\',this.id,this.title)"></i></a>';
	}

	// For New Data
	if(in_array('seen_by_admin',$get_table_name_columns)){
		if($row["seen_by_admin"]==0) $return.='<a href="javascript:void(0);" data-toggle="tooltip" data-original-title="Yeni" ><i class="fa fa-flash fa-lg text-warning m-r-10"></i></a>';
	}

	return $return;
}

function header_($header){
	header($header);
	exit(); die();
}

function is_connected(){
    $connected = @fsockopen("www.facebook.com", 80);  //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;
}

function encrypt_decrypt($action, $string, $key_='', $iv_='') {
	$output = false;
	$encrypt_method = "AES-256-CBC";
	if($key_=='') $secret_key = 'This is my secret key _ 0050'; else $secret_key=$key_;
	if($iv_=='') $secret_iv = 'This is my secret iv _ 0050'; else $secret_iv=$iv_;
	// hash
	$key = hash('sha256', $secret_key);

	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	if ( $action == 'encrypt' ) {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if( $action == 'decrypt' ) {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}

	if(strtolower(substr_($output,0,6))=='select'){
		$output=str_ireplace(array("union","delete","","--","update","truncate"),"",$output);
	}

	return $output;
}

function getTableNameColumns($table){
	global $all_tables, $db;
	$get_table_name_columns=array();
	if(in_array($table,$all_tables)){
	$sql=mysqli_query($db,"SHOW COLUMNS FROM $table ");
		while($row=mysqli_fetch_assoc($sql)){
			$column_name=$row["Field"];
			$get_table_name_columns[]=$column_name;
		}
	}
	return $get_table_name_columns;
}

function checkbox_row($id){
	global $hide_check;
	return '
	<div class="checkbox checkbox-inverse pull-left margin_0 '.$hide_check.'">
		<input type="checkbox" id="chbx_'.$id.'" value="'.$id.'" onclick="chbx_(this.id)" /> <label for="chbx_'.$id.'"></label>
	</div>';
}

function setFlash($name,$text){
	return $_SESSION[$name]=$text;
}
function getFlash($name){
	if(!isset($_SESSION[$name])) $_SESSION[$name]='';
	$return=$_SESSION[$name];
	$_SESSION[$name]='';
	return $return;
}
function isFlash($name){
	if(!isset($_SESSION[$name])) $_SESSION[$name]='';
	$return=$_SESSION[$name];
	if($return!='') return true;
	else return false;
}

function unCurrentClass(){
	global $hideForm;
	if($hideForm=='hide') return ''; else return 'hide';
}

function trimByChar($string, $charToRemove){
	$string=trim($string);
	$charToRemove_length=strlen($charToRemove);
	while(substr($string,0,$charToRemove_length)==$charToRemove){
		$string=substr($string,$charToRemove_length);
	}

	while(substr($string,strlen($string)-$charToRemove_length)==$charToRemove){
		$string=substr($string,0,strlen($string)-$charToRemove_length);
	}

	return $string;
}

function createFileView($imageFolder,$image,$delete=0,$delete_file_column='image'){
	global $current_link, $get_settings;
	if($delete>0) $del_html='<a href="'.addFullUrl(array('delete_file'=>$delete,'delete_file_column'=>$delete_file_column)).'" data-toggle="tooltip" data-original-title="Sil" data-title="'.$image.'" class="delete"><i class="fa fa-close text-danger fa-lg"></i></a>';
	else $del_html='';

	if($get_settings["image_crop"]>0) $crop_html='<a href="index.php?do=image_cropper&image_folder='.base64_encode($imageFolder).'&image='.base64_encode($image).'&return_url='.base64_encode($current_link).'" data-toggle="tooltip" data-original-title="Redaktə et" data-title="'.$image.'" class=""><i class="fa fa-crop fa-lg"></i></a>';
	else $crop_html='';

	if(substr_($delete_file_column,0,5)=='image'){
		$img=$imageFolder.'/'.$image;
		if(is_file($imageFolder.'/thumb_'.$image)) $img_thumb=$imageFolder.'/thumb_'.$image; else $img_thumb=$img;
		if(is_file($img)) $img='<a class="image-popup-no-margins" href="'.$img.'" title=""><img style="margin-top:5px;" src="'.$img_thumb.'" height="50">'.$del_html.''.$crop_html.'</a>';
		else $img='No Image';

		return $img;
	}
	else{
		$file=$imageFolder.'/'.$image;
		if(is_file($file)) $file='<a href="'.$file.'" target="_blank">'.$image.'</a>'.$del_html; else $file='No File';
		return $file;
	}
}

function checkFolderIsset($imageFolder){
	if($imageFolder!=''){
		$exp=explode("/",$imageFolder);
		$ccc='';
		foreach($exp as $f) {
			$ccc.=$f.'/';
			if($f!='..' && $f!='.' && !is_dir($ccc) ) mkdir($ccc,0755);
		}
	}
}

function deleteOldFiles($do,$edit,$imageFolder, $columnName='image'){
	global $db, $all_langs;
	if($edit>0 && checkColumn($do,$columnName)  ){
		$information=mysqli_fetch_assoc(mysqli_query($db,"select $columnName from $do where id='$edit' "));
		if( $information[$columnName]!='' && is_file($imageFolder."/".$information[$columnName]) ) unlink($imageFolder."/".$information[$columnName]);

		if(substr_($columnName,0,5)=='image'){
			if( $information[$columnName]!='' && is_file($imageFolder."/thumb_".$information[$columnName]) ) unlink($imageFolder."/thumb_".$information[$columnName]);
			if( $information[$columnName]!='' && is_file($imageFolder."/thumb2_".$information[$columnName]) ) unlink($imageFolder."/thumb2_".$information[$columnName]);
			if( $information[$columnName]!='' && is_file($imageFolder."/thumb3_".$information[$columnName]) ) unlink($imageFolder."/thumb3_".$information[$columnName]);
			if( $information[$columnName]!='' && is_file($imageFolder."/thumb4_".$information[$columnName]) ) unlink($imageFolder."/thumb4_".$information[$columnName]);
			if( $information[$columnName]!='' && is_file($imageFolder."/thumb5_".$information[$columnName]) ) unlink($imageFolder."/thumb5_".$information[$columnName]);
		}
	}
	elseif($edit>0){
		$information=mysqli_fetch_assoc(mysqli_query($db,"select * from $do where id='$edit' "));
		foreach($all_langs as $one_lang){
			$columnName=$columnName.'_'.$one_lang;

			if(checkColumn($do,$columnName)  ){
				if( $information[$columnName]!='' && is_file($imageFolder."/".$information[$columnName]) ) unlink($imageFolder."/".$information[$columnName]);

				if(substr_($columnName,0,5)=='image'){
					if( $information[$columnName]!='' && is_file($imageFolder."/thumb_".$information[$columnName]) ) unlink($imageFolder."/thumb_".$information[$columnName]);
					if( $information[$columnName]!='' && is_file($imageFolder."/thumb2_".$information[$columnName]) ) unlink($imageFolder."/thumb2_".$information[$columnName]);
					if( $information[$columnName]!='' && is_file($imageFolder."/thumb3_".$information[$columnName]) ) unlink($imageFolder."/thumb3_".$information[$columnName]);
					if( $information[$columnName]!='' && is_file($imageFolder."/thumb4_".$information[$columnName]) ) unlink($imageFolder."/thumb4_".$information[$columnName]);
					if( $information[$columnName]!='' && is_file($imageFolder."/thumb5_".$information[$columnName]) ) unlink($imageFolder."/thumb5_".$information[$columnName]);
				}
			}
		}
	}
}

function checkFileType($file_name,$type='image'){
	if($file_name!=''){
		if($type=='video') $white_list=array('mp4','avi','flv','3gp');
		elseif($type=='document') $white_list=array('pdf','doc','docx','xls','xlsx','txt','jpg','png','jpeg','bmp','gif','webp');
		elseif($type=='music') $white_list=array('mp3','ogg','aag','wma','wav','ptt');
		elseif($type=='other') $white_list=array('swf');
		else $white_list=array('png','jpg','bmp','gif','jpeg','webp');

		$exp=explode(".",$file_name);
		$type=end($exp);
		$type=strtolower_($type);
		if(in_array($type,$white_list)) return true;
		else return false;
	}
	else return true;
}

function checkOrderBy($table,$order,$by,$default_order='id',$default_by='desc'){
	$order=checkColumnsForOrder($table,$order,$default_order);
	$by=strtolower_($by);
	if($by!='asc' && $by!='desc') $by=$default_by;
	return $order.' '.$by;
}

function checkColumnsForOrder($table,$column,$default_column=false){
	$columns=getColumns($table);
	if(in_array($column,$columns)) return $column;
	elseif($default_column==false) return false;
	elseif($default_column=='last') return end($columns);
	elseif(is_numeric($default_column)) return $columns[$default_column];
	else return $default_column;
}

function checkColumn($table,$column){
	$columns=getColumns($table);
	if(in_array($column,$columns)) return true;
	else return false;
}

function getColumns($table){
	global $db;
	$columns=array(); $query=mysqli_query($db,"show columns from $table");
	while($row_query=mysqli_fetch_assoc($query)){
		$columns[]=$row_query["Field"];
	}
	return $columns;
}

function getFirstSentence($text){
	$text=decode_text($text,true,true);
	$exp=explode('.', $text);

	$result='';
	foreach($exp as $key=>$sentence){
		if(trim($sentence)!=''){
			$result.=$sentence.'.';
			if(isset($exp[$key+1])) $next_sentence=$exp[$key+1]; else $next_sentence='';
			$end_of_the_sentence=false;

			if(isset($exp[$key+1])) $next_symbol=substr_(trim($next_sentence),0,1); else $next_symbol='';
			if(isset($exp[$key+1])) $next_first_symbol=substr_($next_sentence,0,1); else $next_first_symbol='';
			$last_symbol=substr_($sentence,-1,1);

			if(!is_numeric($next_symbol) && ctype_upper_($next_symbol)) $end_of_the_sentence=true;
			if(is_numeric($next_symbol) && $next_first_symbol==' ') $end_of_the_sentence=true;
			if(is_numeric($last_symbol) && $next_symbol==' ') $end_of_the_sentence=true;
			if(ctype_upper_($next_symbol) && $next_first_symbol!='' && ctype_upper_($last_symbol)) $end_of_the_sentence=false; // E.Alizade kimi cumlelerde bitirmesin
			//if(is_numeric($next_symbol) && $next_first_symbol!=' ' && !is_numeric($last_symbol)) $end_of_the_sentence=true;
			if($end_of_the_sentence==true) break;
		}
	}

	if(is_numeric(strpos($result,":"))){
		$exp=explode(':', $result);
		$result='';
		foreach($exp as $key=>$sentence){
			if(isset($exp[$key+1])) $next=substr_($exp[$key+1],0,1); else $next='';
			if(trim($sentence)!=''){
				$result.=$sentence.'.';
				$count=substr_count($result,'"')+substr_count($result,'“')+substr_count($result,'”');
				if( ($next=='"' or $next=='”') && $count%2==1 ) $result.=$next;
				elseif( ($next=='"' or $next=='“') && $count%2==1 ) $result.=$next;
				break;
			}
		}
	}

	if(is_numeric(strpos($result,"?!"))){
		$exp=explode('?!', $result);
		$result='';
		foreach($exp as $key=>$sentence){
			if(isset($exp[$key+1])) $next=substr_($exp[$key+1],0,1); else $next='';
			if(trim($sentence)!=''){
				$result.=$sentence.'?!';
				if( ($next=='"' or $next=='”') && (is_numeric(strpos($result,'"')) or is_numeric(strpos($result,'“')) ) ) $result.=$next;
				elseif( ($next=='"' or $next=='“') && (is_numeric(strpos($result,'"')) or is_numeric(strpos($result,'”')) ) ) $result.=$next;
				break;
			}
		}
	}
	else{
		if(is_numeric(strpos($result,"?"))){
			$exp=explode('?', $result);
			$result='';
			foreach($exp as $key=>$sentence){
				if(isset($exp[$key+1])) $next=substr_($exp[$key+1],0,1); else $next='';
				if(trim($sentence)!=''){
					$result.=$sentence.'?';
					$count=substr_count($result,'"')+substr_count($result,'“')+substr_count($result,'”');
					if( ($next=='"' or $next=='”') && $count%2==1 ) $result.=$next;
					elseif( ($next=='"' or $next=='“') && $count%2==1 ) $result.=$next;
					break;
				}
			}
		}
		if(is_numeric(strpos($result,"!"))){
			$exp=explode('!', $result);
			$result='';
			foreach($exp as $key=>$sentence){
				if(isset($exp[$key+1])) $next=substr_($exp[$key+1],0,1); else $next='';
				if(trim($sentence)!=''){
					$result.=$sentence.'!';
					$count=substr_count($result,'"')+substr_count($result,'“')+substr_count($result,'”');
					if( ($next=='"' or $next=='”') && $count%2==1 ) $result.=$next;
					elseif( ($next=='"' or $next=='“') && $count%2==1 ) $result.=$next;
					break;
				}
			}
		}
	}

	$length=strlen_($result);
	for($i=0;$i<=$length;$i++){
		$current=substr_($result,$i,1,false,false);
		$next=substr_($result,$i+1,1,false,false);
		$prev=substr_($result,$i-1,1,false,false);
		if( ctype_upper_($next) && ($current=='"' || $current=='“' || $current=='”') && $prev!=' ' && $i>0 ){
			$sss=substr_($result,0,$i);
			$count=substr_count($sss,'"')+substr_count($sss,'“')+substr_count($sss,'”');
			if($coun%2==1) $result=substr_($result,0,$i+1);
			else $result=substr_($result,0,$i);
			break;
		}
	}


	return $result;
}

function changeFromUsToJapan($string){
	//This function doest not work in Japan alphabet
	$from=array("Ü","ü","Ö","ö",'Ç','ç','Ğ','ğ','Ə','ə','Ş','ş'); $to=array("ひ","ら","が","な","あ","本","人","そ","れ","で","も","急");
	$string=str_replace($from,$to,$string);
	return $string;
}

function changeFromJapanToUs($string){
	//This function doest not work in Japan alphabet
	$from=array("Ü","ü","Ö","ö",'Ç','ç','Ğ','ğ','Ə','ə','Ş','ş'); $to=array("ひ","ら","が","な","あ","本","人","そ","れ","で","も","急");
	$string=str_replace($from,$to,$string);
	return $string;
}

function substr_($string,$start,$limit=99999,$withFullWord=false,$continue=false){
	$originalString = $string;
	//This function doest not work in Japan alphabet
	$from=array("Ü","ü","Ö","ö",'Ç','ç','Ğ','ğ','Ə','ə','Ş','ş','"'); $to=array("ひ","ら","が","な","あ","本","人","そ","れ","で","も","急","変");
	$string=str_replace($from,$to,$string);
	if($withFullWord)
	{
		$string = preg_replace('/\s+?(\S+)?$/', '', mb_substr(decode_text($string,true,true), $start, $limit,"utf-8"));
	}
	else $string = mb_substr(decode_text($string,true,true,false), $start, $limit,"utf-8");
	$string=str_replace($to,$from,$string);
	if(strlen($originalString) > $limit && $continue)
		$string .= ' ...';
	return $string;
}

function generateRandomString($length = 7) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function strlen_($string){
	//az
	$from=array("Ü","Ö","Ğ","Ə","Ç","Ş","İ","ü","ö","ğ","ı","ə","ç","ş"); $to=array("U","O","G","E","C","S","I","u","o","g","i","e","c","s");
	$string=str_replace($from, $to, $string);

	//ru
	$from=array("Й","Ц","У","К","Е","Н","Г","Ш","Щ","З","Х","Ъ","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","Ч","С","М","И","Т","Ь","Б","Ю","Ё");
	$to=array("A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A");
	$string=str_replace($from, $to, $string);

	return strlen($string);
}

function ctype_upper_($string){
	//az
	$from=array("Ü","Ö","Ğ","Ə","Ç","Ş","İ"); $to=array("U","O","G","E","C","S","I");
	$string=str_replace($from, $to, $string);

	//ru
	$from=array("Й","Ц","У","К","Е","Н","Г","Ш","Щ","З","Х","Ъ","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","Ч","С","М","И","Т","Ь","Б","Ю","Ё");
	$to=array("A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A");
	$string=str_replace($from, $to, $string);

	if(ctype_upper($string)) return true;
	else return false;
}

function ctype_lower_($string){
	//az
	$from=array("ü","ö","ğ","ı","ə","ç","ş"); $to=array("u","o","g","i","e","c","s");
	$string=str_replace($from, $to, $string);

	//ru
	$from=array("й","ц","у","к","е","н","г","ш","щ","з","х","ъ","ф","ы","в","а","п","р","о","л","д","ж","э","я","ч","с","м","и","т","ь","б","ю","ё");
	$to=array("a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a");
	$string=str_replace($from, $to, $string);

	if(ctype_lower($string)) return true;
	else return false;
}

function ucfirst_($str, $from_function=''){
	// $from_function is a call from before.   may be strtolower_
	$from=array('Q','Ü','E','R','T','Y','U','İ','O','P','Ö','Ğ','A','S','D','F','G','H','J','K','L','I','Ə','Z','X','C','V','B','N','M','Ç','Ş','W');
	$to=array('q','ü','e','r','t','y','u','i','o','p','ö','ğ','a','s','d','f','g','h','j','k','l','ı','ə','z','x','c','v','b','n','m','ç','ş','w');
	$str=str_replace($from,$to,$str);

	$from=array("Й","Ц","У","К","Е","Н","Г","Ш","Щ","З","Х","Ъ","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","Ч","С","М","И","Т","Ь","Б","Ю","Ё");
	$to=array("й","ц","у","к","е","н","г","ш","щ","з","х","ъ","ф","ы","в","а","п","р","о","л","д","ж","э","я","ч","с","м","и","т","ь","б","ю","ё");
	$str=str_replace($from,$to,$str);

	if($from_function!='strtolower_') $str=strtolower_($str);

	$first_letter=substr_($str,0,1);

	$from=array('Q','Ü','E','R','T','Y','U','İ','O','P','Ö','Ğ','A','S','D','F','G','H','J','K','L','I','Ə','Z','X','C','V','B','N','M','Ç','Ş','W');
	$to=array('q','ü','e','r','t','y','u','i','o','p','ö','ğ','a','s','d','f','g','h','j','k','l','ı','ə','z','x','c','v','b','n','m','ç','ş','w');
	$first_letter=str_replace($to,$from,$first_letter);

	$from=array("Й","Ц","У","К","Е","Н","Г","Ш","Щ","З","Х","Ъ","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","Ч","С","М","И","Т","Ь","Б","Ю","Ё");
	$to=array("й","ц","у","к","е","н","г","ш","щ","з","х","ъ","ф","ы","в","а","п","р","о","л","д","ж","э","я","ч","с","м","и","т","ь","б","ю","ё");
	$first_letter=str_replace($to,$from,$first_letter);

	$str=$first_letter.substr_($str,1);
	return $str;
}

function strtoupper_($str,$lang="az"){
	$from=array('q','ü','e','r','t','y','u','o','p','ö','ğ','a','s','d','f','g','h','j','k','l','ı','ə','z','x','c','v','b','n','m','ç','ş','w');
	$to=array('Q','Ü','E','R','T','Y','U','O','P','Ö','Ğ','A','S','D','F','G','H','J','K','L','I','Ə','Z','X','C','V','B','N','M','Ç','Ş','W');
	$str=str_replace($from,$to,$str);
	if($lang=='az') $str=str_replace('i','İ',$str);
	$str=mb_strtoupper($str,"utf-8");
	return $str;
}

function strtolower_($str,$ucfirst=false,$lang='az'){
	$from=array('Q','Ü','E','R','T','Y','U','İ','O','P','Ö','Ğ','A','S','D','F','G','H','J','K','L','I','Ə','Z','X','C','V','B','N','M','Ç','Ş','W');
	$to=array('q','ü','e','r','t','y','u','i','o','p','ö','ğ','a','s','d','f','g','h','j','k','l','ı','ə','z','x','c','v','b','n','m','ç','ş','w');
	if($lang=='az' || $lang=='tr') $str=str_replace($from,$to,$str);

	$from=array("Й","Ц","У","К","Е","Н","Г","Ш","Щ","З","Х","Ъ","Ф","Ы","В","А","П","Р","О","Л","Д","Ж","Э","Я","Ч","С","М","И","Т","Ь","Б","Ю","Ё");
	$to=array("й","ц","у","к","е","н","г","ш","щ","з","х","ъ","ф","ы","в","а","п","р","о","л","д","ж","э","я","ч","с","м","и","т","ь","б","ю","ё");
	$str=str_replace($from,$to,$str);

	if($lang=='en') $str=strtolower($str);

	if($ucfirst==true) $str=ucfirst_($str,"strtolower_");
	return $str;
}

function addWaterMark($uploaded_image,$stamp_image,$save_image){
	$info=getimagesize($uploaded_image);

	if($info["mime"]=="image/png") $im=imagecreatefrompng($uploaded_image);
	elseif($info["mime"]=="image/jpeg") $im=imagecreatefromjpeg($uploaded_image);
	elseif($info["mime"]=="image/gif") $im=imagecreatefromgif($uploaded_image);
	else return false;

	if($info["mime"]=="image/png"){
		imagealphablending($im, true);
		imagesavealpha($im, true);
	}
	$stamp = imagecreatefrompng($stamp_image);						// for transparent

	// Set the margins for the stamp and get the height/width of the stamp image
	$margin_right = 10; $margin_bottom = 10;
	$sx = imagesx($stamp); $sy = imagesy($stamp);
	$imgx = imagesx($im); $imgy = imagesy($im);

	$centerX=round($imgx/2);		// eger 0 teyin etsek.. tam soldan baslayacaq.
	$centerY=round($imgy/2);		// eger 0 teyin etsek.. tam ustden baslayacaq.

	//imagecopy($im, $stamp, $centerX, $centerY, 0, 0, $sx, $sy);
	//imagecopy($im, $stamp, $imgx - $sx - $margin_right, $imgy - $sy - $margin_bottom, 0, 0, $sx, $sy);
	imagecopy($im, $stamp, $centerX - ($sx/2) , $centerY - ($sy/2), 0, 0, $sx, $sy);	//middle

	if($info["mime"]=="image/png") imagepng($im, $save_image, 9);
	else imagejpeg($im, $save_image, 80);
}

function checkMaxSizeImage($uploaded_image,$maxWidth=1000,$maxHeight=800){
	list($width, $height, $type, $attr) = getimagesize($uploaded_image);
	$exp=explode(".",$uploaded_image);  $tip=end($exp); $tip=strtolower($tip);
	if(!class_exists('SimpleImage')) include "resize_class.php";
	$image = new SimpleImage();
	$compressed=false;
	if($width>$maxWidth){
		if($tip=='png') resizePng($uploaded_image,$uploaded_image,$maxWidth,0);
		else{
			$image->load($uploaded_image);
			$image->resizeToWidth($maxWidth);
			$image->save($uploaded_image);
		}
		list($width, $height, $type, $attr) = getimagesize($uploaded_image);
		$compressed=true;
	}
	if($height>$maxHeight){
		if($tip=='png') resizePng($uploaded_image,$uploaded_image,0,$maxHeight);
		else{
			$image->load($uploaded_image);
			$image->resizeToHeight($maxHeight);
			$image->save($uploaded_image);
		}
		$compressed=true;
	}
	if($compressed==false){
		$tmp=str_replace('.'.$tip,'_'.time().'.'.$tip,$uploaded_image);
		copy($uploaded_image,$tmp);
		makeThumb($uploaded_image,$uploaded_image);

		if(filesize($uploaded_image)>filesize($tmp)) copy($tmp,$uploaded_image);
		unlink($tmp);
	}
}

function makeThumb($uploaded_image, $output, $thumbWidth=0, $thumbHeight=0, $smallToBig=true){
	list($width, $height, $type, $attr) = getimagesize($uploaded_image);
	if($thumbWidth==0 && $thumbHeight==0){ $thumbWidth=$width; $thumbHeight=$height; }

	$tip=explode(".",$uploaded_image);  $tip=end($tip); $tip=strtolower($tip);
	if( ($smallToBig==false && $width>$thumbWidth && $height>$thumbHeight) or $smallToBig==true){
		if(!class_exists('SimpleImage')) include "resize_class.php";
		$image = new SimpleImage();
		$image->load($uploaded_image);

		if($thumbWidth>0 && $thumbHeight==0){
			if($tip=='png') resizePng($uploaded_image,$output,$thumbWidth,0);
			else{

				$image->resizeToWidth($thumbWidth);
				$image->save($output);
			}
		}
		elseif($thumbWidth==0 && $thumbHeight>0){
			if($tip=='png') resizePng($uploaded_image,$output,0,$thumbHeight);
			else{
				$image->resizeToHeight($thumbHeight);
				$image->save($output);
			}
		}
		else{
			if($thumbHeight>$thumbWidth) { $findResultWidth=intval($width/($height/$thumbHeight)); $findResultHeight=$thumbHeight; }
			else { $findResultHeight=intval($height/($width/$thumbWidth)); $findResultWidth=$thumbWidth; }

			if(
				( $thumbWidth==$thumbHeight && $width>=$height )
				or  ($thumbWidth!=$thumbHeight && ( ($thumbHeight>=$thumbWidth && $findResultWidth>=$thumbWidth) or ($thumbHeight<$thumbWidth && $findResultHeight<$thumbHeight) ) )
			){
				if($tip=='png') resizePng($uploaded_image,$output,0,$thumbHeight);
				else{
					$image->resizeToHeight($thumbHeight);
					$image->save($output);
				}
			}
			else{
				if($tip=='png') resizePng($uploaded_image,$output,$thumbWidth,0);
				else{
					$image->resizeToWidth($thumbWidth);
					$image->save($output);
				}
			}

			$uploaded_image=$output;
			list($width, $height, $type, $attr) = getimagesize($uploaded_image);
			if( ($width!=$thumbWidth || $height!=$thumbHeight)  ){	// && $width>=$thumbWidth && $height>=$thumbHeight
				create_thumbnail($uploaded_image,$output,$thumbWidth,$thumbHeight);
			}
		}
	}
}

function create_thumbnail($path,$save,$width,$height){
	$info=getimagesize($path);
	if($width==0) $width=$info[0];
	if($height==0) $height=$info[1];
	$size=array($info[0],$info[1]);

	if($info["mime"]=="image/png") $img=imagecreatefrompng($path);
	elseif($info["mime"]=="image/jpeg") $img=imagecreatefromjpeg($path);
	elseif($info["mime"]=="image/gif") $img=imagecreatefromgif($path);
	else return false;
	$tmp=imagecreatetruecolor($width,$height);
	imagesavealpha($tmp, true);
	$color = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
	imagefill($tmp, 0, 0, $color);

	$src_aspect=$size[0]/$size[1];
	$thumb_aspect=$width/$height;
	if($src_aspect<$thumb_aspect){
		$scale=$width/$size[0];
		$new_size=array($width,$width/$src_aspect);
	}
	elseif($src_aspect>$thumb_aspect){
		$scale=$height/$size[1];
		$new_size=array($height*$src_aspect,$height);
	}
	else $new_size=array($width,$height);

	$new_size[0]=max($new_size[0],1);
	$new_size[1]=max($new_size[1],1);
	$mL=($new_size[0]-$width)/2; $mT=($new_size[1]-$height)/2;
	imagecopyresampled($tmp,$img,0,0,$mL,$mT,$new_size[0],$new_size[1],$size[0],$size[1]);
	if($save==false){
		if($info["mime"]=="image/png") return imagepng($tmp,9);
		else return imagejpeg($tmp,90);
	}
	else{
		if($info["mime"]=="image/png") return imagepng($tmp,$save,9);
		return imagejpeg($tmp,$save,90);
	}
}

function resizePng($uploaded_image, $output, $newWidth=0, $newHeight=0){
	list($uploadWidth, $uploadHeight) = getimagesize($uploaded_image);
	if($newWidth>0 && $newHeight==0) $newHeight=$uploadHeight/($uploadWidth/$newWidth);
	elseif($newWidth==0 && $newHeight>0) $newWidth=intval($uploadWidth/($uploadHeight/$newHeight));
	elseif($newWidth==0 && $newHeight==0) {$newWidth=$uploadWidth; $newHeight=$uploadHeight;}

	if($newWidth>0 && $uploadWidth>=$newWidth && $newHeight>0 && $uploadHeight>=$newHeight){
		$img = imagecreatefrompng($uploaded_image);
		list($width, $height) = getimagesize($uploaded_image);

		$newHeight = ($height / $width) * $newWidth;			// for proporsional
		$tmp = imagecreatetruecolor($newWidth, $newHeight);
		imagesavealpha($tmp, true);
		$color = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
		imagefill($tmp, 0, 0, $color);

		imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		imagepng($tmp, $output);
	}
	else copy($uploaded_image,$output);
}

function changeLang($newLang=''){
	$uri = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if($newLang!=''){
		if($newLang=='ru'){
			$uri=str_replace(array(SITE_PARTH.'/az',SITE_PARTH.'/en',SITE_PARTH.'/ru/en',SITE_PARTH.'/en/ru'),SITE_PARTH.'/',$uri);
		}
		elseif($newLang=='en'){
			$uri=str_replace(array(SITE_PARTH.'/az',SITE_PARTH.'/ru',SITE_PARTH.'/ru/en',SITE_PARTH.'/en/ru'),SITE_PARTH.'/',$uri);
		}
		$uri.=$newLang;
	}
	else {$newLang='az'; $uri=str_replace(array(SITE_PARTH.'/ru',SITE_PARTH.'/en'),SITE_PARTH.'/'.$newLang,$uri);}
	return $uri;
}

function addFullUrl($adds=array(),$clearDefaultParams=true){
	global $add, $edit, $delete, $up, $down, $hideForm;
	$uri = parse_url($_SERVER['QUERY_STRING'], PHP_URL_PATH);

	if($clearDefaultParams){
		if(strpos($uri,"add=")>0 && ($add==0 || $hideForm=='hide') ) $uri=remove_qs_key($uri,'add');
		if(strpos($uri,"edit=")>0 && ($edit==0 || $hideForm=='hide') ) $uri=remove_qs_key($uri,'edit');
		if(strpos($uri,"delete=")>0 && ($delete==0 || $hideForm=='hide') ) $uri=remove_qs_key($uri,'delete');
		if(strpos($uri,"up=")>0 && ($up==0 || $hideForm=='hide') ) $uri=remove_qs_key($uri,'up');
		if(strpos($uri,"down=")>0 && ($down==0 || $hideForm=='hide') ) $uri=remove_qs_key($uri,'down');
	}

	foreach($adds as $variable=>$value){
		if(strpos($uri,$variable."=")!==false) $uri=remove_qs_key($uri,$variable);
		if($value!='0') $uri.='&'.decode_text($variable).'='.decode_text($value);
	}
	$return='index.php?'.$uri;

	$return=str_replace("&amp;","&",$return);
	$return=str_replace("?&","?",$return);

	return $return;
}
function remove_qs_key($url, $key) {
	if(strpos($url,"*")===false) $url='&'.$url;
	$url = preg_replace('/(?:&|(\?))' . $key . '=[^&]*(?(1)&|)?/i', "$1", $url);

	for($i=1;1;$i++){
		if(substr_($url,0,1)=='&') $url=substr_($url,1); else break;
	}
	return $url;
}

function page_nav($count_rows=0){
	global $query_count, $start, $limit, $db;
	if($count_rows==0) $count_rows=mysqli_num_rows(mysqli_query($db,$query_count));
	if($count_rows>0){
		if($limit>$count_rows) $show_limit=$count_rows; else $show_limit=$limit;
		if($show_limit+$start>$count_rows){
			$show_limit=$count_rows-$start;
			if($show_limit<1) $show_limit=1;
		}
		return 'Cəmi məlumatların sayı: <b>'.$count_rows.'</b>, göstərilir: <b>'.($start+1).'-'.($start+$show_limit).'</b>';
	}
	else return 'Cəmi məlumatların sayı: <b>'.$count_rows.'</b>';
}

function fileNameGenerator($name,$type=''){
	global $time;
	$name=decode_text($name); $name=strip_tags($name);
	$from=array('ü','ö','ğ','ı','ə','ç','ş','Ü','Ö','Ğ','I','Ə','Ç','Ş','İ',' ',',','~','.');
	$to=array('u','o','g','i','e','c','s','U','O','G','I','E','C','S','I','-','','','zz-type-zz');
	$name=str_replace($from,$to,$name);
	$name = preg_replace("/[^a-zA-Z0-9-]+/", "", $name);
	$name=strtolower($name);
	$name=str_replace('zz-type-zz','-'.$time.'.',$name);

	if($type!=''){
		$this_type=explode(".",$name); $this_type=end($this_type); $this_type=strtolower_($this_type,false);
		$name=str_replace(".".$this_type,".".$type,$name);
	}
	return $name;
}

function youtube_embed($url){
    /*
    * type1: http://www.youtube.com/watch?v=H1ImndT0fC8
    * type2: http://www.youtube.com/watch?v=4nrxbHyJp9k&feature=related
    * type3: http://youtu.be/H1ImndT0fC8
    */
    $vid_id = "";
    $flag = false;
    if(isset($url) && !empty($url)){
        /*case1 and 2*/
        $parts = explode("?", $url);
        if(isset($parts) && !empty($parts) && is_array($parts) && count($parts)>1){
            $params = explode("&", $parts[1]);
            if(isset($params) && !empty($params) && is_array($params)){
                foreach($params as $param){
                    $kv = explode("=", $param);
                    if(isset($kv) && !empty($kv) && is_array($kv) && count($kv)>1){
                        if($kv[0]=='v'){
                            $vid_id = $kv[1];
                            $flag = true;
                            break;
                        }
                    }
                }
            }
        }

        /*case 3*/
        if(!$flag){
            $needle = "youtu.be/";
            $pos = null;
            $pos = strpos($url, $needle);
            if ($pos !== false) {
                $start = $pos + strlen($needle);
                $vid_id = substr($url, $start, 11);
                $flag = true;
            }
        }
    }
    return $vid_id;
}
function decode_text($value,$runHtml=false,$strip=false,$trim=true){
	if($trim){
		$value=str_replace("&nbsp;", " ", $value);
		$value=trim($value);
	}
	$from=array('&single_quot;','\\\\'," ","  "); $to=array("'",'\\'," "," "); $value=str_replace($from, $to, $value);
	if($runHtml) $value=html_entity_decode($value); else $value=htmlentities($value);
	if($strip) $value=strip_tags($value);
	return $value;
}
function run_script($script){
	global $license_key, $error1_msg, $error2_msg, $ok_msg;
	eval($script);
}
function get_fcontent($url, $method = 'GET', $data =  [], $header = []){
    $method=strtoupper($method);
    $c=curl_init();

    $user_agents=[
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36",
        "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36 OPR/58.0.3135.132",
        "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0",
    ];
    $useragent=$user_agents[array_rand($user_agents)];

    $opts=[
        CURLOPT_URL=>$url.($method=='GET'&&!empty($data)?'?'.http_build_query($data):''),
        CURLOPT_RETURNTRANSFER=>true,
        CURLOPT_SSL_VERIFYPEER=>false,
        CURLOPT_USERAGENT=>$useragent,
        CURLOPT_HTTPHEADER=>$header,
        CURLOPT_HEADER=>true,
    ];

    if($method=='POST'){
        $opts[CURLOPT_CUSTOMREQUEST]='POST';
        $opts[CURLOPT_POSTFIELDS]=http_build_query($data);
    }
	elseif($method=='GET'){
        $opts[CURLOPT_CUSTOMREQUEST]='GET';
    }
    elseif($method=='DELETE'){
        $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        $opts[CURLOPT_POST] = true;
        $opts[CURLOPT_POSTFIELDS] = http_build_query($data);
    }

    curl_setopt_array($c, $opts);
    $result = curl_exec($c);
	$status = curl_getinfo($c);

	if($status['http_code']!=200){
		if($status['http_code'] == 301 || $status['http_code'] == 302) {
			list($header) = explode("\r\n\r\n", $result, 2);
			$matches = array();
			preg_match("/(Location:|URI:)[^(\n)]*/", $header, $matches);
			$url = trim(str_replace($matches[1],"",$matches[0]));
			$url_parsed = parse_url($url);
			return (isset($url_parsed))? get_fcontent($url):'';
		}
	}
	$result = substr($result, curl_getinfo($c, CURLINFO_HEADER_SIZE));

    curl_close( $c );


    return $result;
}
function set_csrf_($name=''){
	global $do;
	if(!isset($do)) $do='';
	$_SESSION["csrf_".$do.$name]=md5(rand(1,99999));
	return $_SESSION["csrf_".$do.$name];
}

function update_csrf_($name=''){
	global $do;
	if(!isset($do)) $do='';
	$_SESSION["csrf_".$do.$name]=md5(rand(1,99999));
}

function get_csrf_($name=''){
	global $do;
	if(!isset($do)) $do='';
	if(!isset($_SESSION["csrf_".$do.$name])) $_SESSION["csrf_".$do.$name]='';
	return $_SESSION["csrf_".$do.$name];
}

function check_csrf_($csrf_,$name=''){
	global $do;
	if(!isset($do)) $do='';
	if(!isset($_SESSION["csrf_".$do.$name])) $_SESSION["csrf_".$do.$name]='';
	if($csrf_==safe($_SESSION["csrf_".$do.$name])) return true;
	else return false;
}
function slugGenerator($slug,$space='-',$onlyEnglish=true,$lang_name='az'){
	if($onlyEnglish==true){
		$from=array('ü','ö','ğ','ı','ə','ç','ş'); $to=array('u','o','g','i','e','c','s');
		$slug=str_replace($from,$to,$slug);
	}
	$slug=strtolower_($slug,false,$lang_name);

	$slug=str_replace('&amp;','-',$slug); $slug=str_replace('&','-',$slug); $slug=str_replace('quot','',$slug);
	$slug=decode_text($slug,true);
	$slug=strip_tags($slug);
	$lettersNumbersSpacesHyphens = '/[^\-\s\pN\pL]+/u';
	$spacesDuplicateHypens = '/[\-\s]+/';
	$slug = preg_replace($lettersNumbersSpacesHyphens, '', $slug);
	$slug = preg_replace($spacesDuplicateHypens, $space, $slug);
	$slug = trim($slug, '-');
	if(strlen($slug)>190) $slug=mb_substr($slug,0,190,"UTF-8");
	$slug=str_replace(' ','',$slug);
	return $slug;
}
?>

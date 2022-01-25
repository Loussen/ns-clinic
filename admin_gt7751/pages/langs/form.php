<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php $t_title_add="Əlavə et"; include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<div class="<?php if($add==1 || $edit>0) echo 'hide'; ?>" style="margin-bottom:10px;">
	<img src="images/icon_accept.png" alt="" /> <b>Əsas dili təyin et:</b>
	<select style="margin-right:50px" onchange="MM_jumpMenu('parent',this,0)">
		<?php
		$info_main_lang=mysqli_fetch_assoc(mysqli_query($db,"select id from langs where status='1' "));
		$sql=mysqli_query($db,"select id,name from langs order by position");
		while($row=mysqli_fetch_assoc($sql))
		{
			if($row["id"]==$info_main_lang["id"]) $selected='selected="selected"'; else $selected='';
			echo '<option value="index.php?do='.$do.'&main_lang_change='.$row["id"].'" '.$selected.'>'.decode_text($row["name"]).'</option>';
		}
		?>
	</select>
</div>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
	<div class="tab-content">
		<?php if($lang_edit==0)
		{ ?>
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">Adı:</label>
				<div class="col-md-10">
					<input name="name" class="form-control" type="text" value="<?php echo decode_text($information["name"])?>" />
				</div>
			</div>
			
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">Tam adı:</label>
				<div class="col-md-10">
					<input name="full_name" class="form-control" type="text" value="<?php echo decode_text($information["full_name"])?>" />
				</div>
			</div>
			
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">Icon:</label>
				<div class="col-md-10">
					<select name="flag" class="form-control" id="flag" onchange="show_flag(this.value)">
					<?php
					$folder='assets/plugins/images/flags';
					$ac=opendir($folder);
					while($file=readdir($ac)){
						if(is_file($folder."/".$file)) $flags[]=$file;
					}
					sort($flags);
					foreach($flags as $key)
					{
						if($key==$information["flag"]) $selected='selected="selected"'; else $selected='';
						echo '<option value="'.$folder.'/'.$key.'" '.$selected.'>'.substr($key,0,strpos($key,"-")).'</option>';
					}
					unset($flags);
					?>
					</select>
				</div>
			</div>
			
			<?php if($edit>0) $flag=$information["flag"]; else $flag="Afghanistan-Flag-64.png"; ?>
			<div class="form-group row">
				<label for="example-text-input" class="col-md-2 col-form-label">Seçilmiş bayraq:</label>
				<div class="col-md-10">
					<img id="flag_image" src="assets/plugins/images/flags/<?php echo $flag; ?>" alt="" width="32" style="margin-bottom:-10px" />
				</div>
			</div>
		<?php
		}
		else
		{
			$information_lang=mysqli_fetch_assoc(mysqli_query($db,"select name from langs where id='$edit' "));
			echo '<b>Dil tərkibində düzəlişlər: ('.$information_lang["name"].')</b><br /><br />';
			
			if(is_file("langs/".$information_lang["name"]."/lang.txt")){
				$lang_data=file_get_contents("langs/".$information_lang["name"]."/lang.txt");
				if($lang_data!='') $explode_edit_file=json_decode($lang_data,true);
				else $explode_edit_file=[];
			}
			else $explode_edit_file=[];
			
			$increament=1;
			foreach($explode_edit_file as $key)
			{
				echo '
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Söz '.($increament++).':</label>
					<div class="col-md-10">
						<input name="lang_edit[]" class="form-control" type="text" value="'.decode_text($key).'" />
					</div>
				</div>
				';
			}
			
			for($i=1;$i<=10;$i++){
				echo '
					<div class="form-group row">
						<label for="example-text-input" class="col-md-2 col-form-label">Söz '.($increament++).':</label>
						<div class="col-md-10">
							<input name="lang_edit[]" class="form-control" type="text" value="" />
						</div>
					</div>
				';
			}
			
		}
		?>
		
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
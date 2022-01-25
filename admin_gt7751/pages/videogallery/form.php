<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php $t_title_add="Əlavə et"; include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
	<div class="tab-content">
		<?php
//		if($add==1){
//			$datetime=date("d").'/'.date("m").'/'.date("Y");
//			$hour=date("H:i");
//		}
//		else{
//			$datetime=date("d/m/Y",$information["datetime"]);
//			$hour=date("H:i",$information["datetime"]);
//		}
		?>

        <?php
	        $sql=mysqli_query($db,"select id,name from langs order by position");
	        $inc=1;
	        while($row=mysqli_fetch_assoc($sql))
	        {
	            echo '<div role="tabpanel" class="tab-pane lang-panel" id="tab_lang'.$row["id"].'">';

	            echo ' <h2 style="text-align: center; text-decoration: underline; font-weight: bold;">Dil üzrə dəyişən xanalar</h2>
					<div class="form-group row">
						<label for="example-text-input" class="col-md-2 col-form-label">Başlıq:</label>
						<div class="col-md-10">
							<input name="name_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["name_".$row["name"]]).'" />
						</div>
					</div>
				
					';

	            echo '</div>';
	        }
        ?>

		<div class="form-group row hide">
			<label for="example-text-input" class="col-md-2 col-form-label">Tarix:</label>
			<div class="col-md-10">
				<div class="input-group">
					<input type="text" name="datetime" class="form-control datepicker-autoclose" placeholder="dd/mm/yyyy" value="<?php echo $datetime?>" />
					<span class="input-group-addon"><i class="icon-calender"></i></span>
				</div>
			</div>
		</div>
		
		<div class="form-group row hide">
			<label for="example-text-input" class="col-md-2 col-form-label">Saat:</label>
			<div class="col-md-10">
				<div class="input-group clockpicker" data-autoclose="true">
					<input type="text" name="hour" class="form-control" value="<?php echo $hour?>">
					<span class="input-group-addon"> <span class="glyphicon glyphicon-time"></span> </span>
				</div>
			</div>
		</div>
		
		<?php
//		$current_file=''; $column_nm='image';
//		if($information[$column_nm]!="" && $edit>0) $current_file=createFileView($imageFolder,$information[$column_nm],$edit,$column_nm);
		?>
		<div class="form-group row hide">
			<label for="example-text-input" class="col-md-2 col-form-label">Şəkil:</label>
			<div class="col-md-10">
				<input name="<?php echo decode_text($column_nm)?>" type="file" /> <?php echo $current_file?>
			</div>
		</div>
		
		<div class="form-group row hide">
			<label for="example-text-input" class="col-md-2 col-form-label">Kod:</label>
			<div class="col-md-10">
				<input name="code" class="form-control" type="text" value="<?php echo decode_text($information["code"])?>" />
			</div>
		</div>
		
		<div class="form-group row">
			<label for="example-text-input" class="col-md-2 col-form-label">Video Url (Youtube):</label>
			<div class="col-md-10">
				<input name="video_url" class="form-control" type="text" value="<?php echo decode_text($information["video_url"])?>" />
			</div>
		</div>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
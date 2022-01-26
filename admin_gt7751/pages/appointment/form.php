<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php include "pages/__tools/add_new_link.php"; ?>
<?php //include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="tab-content">
		<?php
		$inc=1;
		$sql=mysqli_query($db,"select id,name from langs order by position");
		while($row=mysqli_fetch_assoc($sql))
		{
			echo '<div role="tabpanel" class="tab-pane lang-panel hide" id="tab_lang'.$row["id"].'">';
			
				echo '<h2 style="text-align: center; text-decoration: underline; font-weight: bold;">Dil üzrə dəyişən xanalar</h2>
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Başlıq:</label>
					<div class="col-md-10">
						<input name="name_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["name_".$row["name"]]).'" />
					</div>
				</div>
				
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Tam məlumat:</label>
					<div class="col-md-10">
						<textarea name="full_text_'.decode_text($row["name"]).'" class="form-control" id="editor'.$inc++.'">'.decode_text($information["full_text_".$row["name"]]).'</textarea>
					</div>
				</div>
				';
			
			echo '</div>';
		}
		?>
		
		<div>
		
			<div class="form-group row">
				<?php
				$current_file=''; $column_nm='image';
				if($information[$column_nm]!="") $current_file=createFileView($imageFolder,$information[$column_nm],1,$column_nm);
				?>
				<label for="example-text-input" class="col-md-2 col-form-label">Ana səhifə form şəkil (550 x 742):</label>
				<div class="col-md-10"><input name="<?=decode_text($column_nm)?>" type="file" /><?php echo $current_file?></div>
			</div>

			<div class="form-group row">
                <?php
                $current_file=''; $column_nm='image2';
                if($information[$column_nm]!="") $current_file=createFileView($imageFolder,$information[$column_nm],1,$column_nm);
                ?>
				<label for="example-text-input" class="col-md-2 col-form-label">Ana səhifə pasiyentlər bloku şəkil (960 x 846):</label>
				<div class="col-md-10"><input name="<?=decode_text($column_nm)?>" type="file" /><?php echo $current_file?></div>
			</div>
			
		</div>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
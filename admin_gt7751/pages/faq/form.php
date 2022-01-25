<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php $t_title_add="Əlavə et"; include "pages/__tools/add_new_link.php"; ?>
<?php include "pages/__tools/lang_tabs.php"; ?>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
	<div class="tab-content">
		<div class="form-group row <?php if($settings_inner["category_available"]==0) echo 'hide'; ?>">
			<label for="example-text-input" class="col-md-2 col-form-label">Kateqoriya:</label>
			<div class="col-md-10">
				<select name="category_id" class="form-control">
					<option value="0"></option>
					<?php
					$sql=mysqli_query($db,"select * from faq_categories order by position");
					while($row=mysqli_fetch_assoc($sql)){
						if($row["id"]==$information["category_id"]) $selected='selected="selected"'; else $selected='';
						echo '<option value="'.$row["id"].'" '.$selected.'>'.decode_text($row[$Name]).'</option>';
					}
					?>
				</select>
			</div>
		</div>
		
		<?php
		$sql=mysqli_query($db,"select id,name from langs order by position");
		while($row=mysqli_fetch_assoc($sql))
		{
			echo '<div role="tabpanel" class="tab-pane" id="tab_lang'.$row["id"].'">';
			
				// You can user this variable in to value="'.$question_.'"
				if($add==1){
					$v='question_'; $v2=$v.$row["name"];	if(isset($$v2)) $$v=stripslashes($$v2); else $$v='';
					$v='answer_'; $v2=$v.$row["name"];	if(isset($$v2)) $$v=stripslashes($$v2); else $$v='';
				}
				else{
					$v='question_'; $v2=$v.$row["name"]; $$v=stripslashes($information[$v2]);
					$v='answer_'; $v2=$v.$row["name"]; $$v=stripslashes($information[$v2]);
				}
				
				echo '
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Sual:</label>
					<div class="col-md-10">
						<input name="question_'.decode_text($row["name"]).'" class="form-control" type="text" value="'.decode_text($information["question_".$row["name"]]).'" />
					</div>
				</div>
				
				<div class="form-group row">
					<label for="example-text-input" class="col-md-2 col-form-label">Cavab:</label>
					<div class="col-md-10">
						<textarea name="answer_'.decode_text($row["name"]).'" class="form-control">'.decode_text($information["answer_".$row["name"]]).'</textarea>
					</div>
				</div>
				';
			
			echo '</div>';
		}
		?>
		
		<?php $submit_value='Yadda saxla'; include "pages/__tools/submit_button.php"; ?>
	</div>
</form>
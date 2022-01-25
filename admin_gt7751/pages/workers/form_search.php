<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<div style="border:1px solid #ccc;padding:7px;" class="print_hide <?php echo unCurrentClass($hideForm)?>">
	<form action="<?=addFullUrl(array('add'=>0,'edit'=>0))?>" method="post" id="search_form">

		<div class="form-group row">
			
			<div class="col-md-3">
				<select name="search_user_id" class="form-control select2">
					<option value="0">İşçi seçin</option>
					<?php
					$sql=mysqli_query($db,"select id,email,login from user_programs where parent_id=0 order by email");
					while($row=mysqli_fetch_assoc($sql)){
						echo '<option value="'.$row["id"].'" '.getSelected($search_user_id,$row["id"]).'>'.decode_text($information["email"]).' ('.decode_text($information["login"]).')</option>';
					}
					?>
				</select>
			</div>

		</div>
	</form>
</div>
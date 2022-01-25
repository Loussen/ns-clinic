<div style="border:1px solid #ccc;padding:7px;" class="print_hide <?php echo unCurrentClass($hideForm)?>">
	<form action="" method="post" id="search_form">

		<div class="form-group row">
			
			<?php if($search_from==0) $search_from=''; else $search_from=date("d/m/Y",$search_from); ?>
			<div class="col-md-2">
				<div class="input-group">
					<input type="text" name="search_from" class="form-control datepicker-autoclose" placeholder="Tarixdən" value="<?php echo decode_text($search_from)?>" />
					<span class="input-group-addon"><i class="icon-calender"></i></span>
				</div>
			</div>
			<?php if($search_to==0) $search_to=''; else $search_to=date("d/m/Y",$search_to); ?>
			<div class="col-md-2">
				<div class="input-group">
					<input type="text" name="search_to" class="form-control datepicker-autoclose" placeholder="Tarixə" value="<?php echo decode_text($search_to)?>" />
					<span class="input-group-addon"><i class="icon-calender"></i></span>
				</div>
			</div>
			
			<div class="col-md-2"><input name="search_name" placeholder="Sakinin adı" class="form-control" type="text" value="<?php echo decode_text($search_name)?>" /></div>
			<div class="col-md-2"><input name="search_number" placeholder="Müqavilə №" class="form-control" type="text" value="<?php echo decode_text($search_number)?>" /></div>
			
			<div class="col-md-2">
				<select name="search_street" class="form-control">
					<option value="0">Küçə</option>
					<?php
					$sql=mysqli_query($db,"select id,$Name from streets order by position");
					while($row=mysqli_fetch_assoc($sql)){
						if($row["id"]==$search_street) $selected='selected="selected"'; else $selected='';
						echo '<option value="'.$row["id"].'" '.$selected.'>'.decode_text($row[$Name]).'</option>';
					}
					?>
				</select>
			</div>
			
			<div class="col-md-2">
				<select name="search_building" class="form-control">
					<option value="0">Bina</option>
					<?php
					$sql=mysqli_query($db,"select id,$Name,street_id from buildings order by position");
					while($row=mysqli_fetch_assoc($sql)){
						$info_street=mysqli_fetch_assoc(mysqli_query($db,"select $Name from streets where id='$row[street_id]' "));
						if($row["id"]==$search_building) $selected='selected="selected"'; else $selected='';
						echo '<option value="'.$row["id"].'" '.$selected.'>'.decode_text($row[$Name]).' ('.decode_text($info_street[$Name]).')</option>';
					}
					?>
				</select>
			</div>

		</div>
	</form>
</div>
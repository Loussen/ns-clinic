<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php if($langs_have){ ?>
	<ul class="nav nav-tabs <?php if($settings_inner["add_new_available"]>0 && $hideForm=='hide') echo 'hide'; ?>" role="tablist">
		<?php
		$count=1;
		$sql=mysqli_query($db,"select id,name from langs where active=1 order by position");
		if(mysqli_num_rows($sql)>1){
			while($row=mysqli_fetch_assoc($sql)){
				if($count==1) $class='active'; else $class='';
				echo '<li role="presentation" class="'.$class.' nav-item"><a href="#tab_lang'.$row["id"].'" class="nav-link" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"> '.ucfirst($row["name"]).'</a></li>';
				$count++;
			}
		}
		?>
	</ul>
<?php } ?>
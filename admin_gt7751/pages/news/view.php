<?php
if(!defined('db_name')) { header("Location: ../"); exit(); die(); }
include "controller.php";
$page_title="Xəbərlər";
?>
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo $page_title?></h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="index.php"><?php echo $mainSection?></a></li>
				<li><a href="<?php echo addFullUrl(array('add'=>0,'edit'=>0,'delete'=>0))?>" class="li_active"><?php echo $page_title?></a></li>
				<?php include "pages/__tools/print_button.php"; ?>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<?php
				include "form.php";
				include "pages/__tools/all_check_buttons.php";
				?>
				
				<div class="table-responsive dataTables_wrapper <?php echo unCurrentClass()?>">
					<form method="post" action="" class="print_hide filter_blok">
						
						<div class="form-group row <?php if($settings_inner["category_available"]==0) echo 'hide'; ?>">
							<label for="example-text-input" class="col-md-2 col-form-label">Kateqoriyalar:</label>
							<div class="col-md-10">
								<select class="form-control" onchange="MM_jumpMenu('parent',this,0)">
									<option value="<?php echo addFullUrl(array('category_id'=>0,'add'=>0,'edit'=>0))?>">Bütün</option>
									<?php
									$sql=mysqli_query($db,"select id,$Name from categories order by $Name");
									while($row=mysqli_fetch_assoc($sql)){
										if($category_id==$row["id"]) $selected='selected="selected"'; else $selected='';
										echo '<option value="'.addFullUrl(array('category_id'=>$row["id"],'add'=>0,'edit'=>0)).'" '.$selected.' >'.decode_text($row[$Name]).'</option>';
									}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group row <?php if($Type==0) echo 'hide'; ?>">
							<label for="example-text-input" class="col-md-2 col-form-label">Müəlliflər:</label>
							<div class="col-md-10">
								<select class="form-control" onchange="MM_jumpMenu('parent',this,0)">
									<option value="<?php echo addFullUrl(array('author_id'=>0,'add'=>0,'edit'=>0))?>">Bütün</option>
									<?php
									$sql=mysqli_query($db,"select id,$Name from authors order by $Name");
									while($row=mysqli_fetch_assoc($sql)){
										if($author_id==$row["id"]) $selected='selected="selected"'; else $selected='';
										echo '<option value="'.addFullUrl(array('author_id'=>$row["id"],'add'=>0,'edit'=>0)).'" '.$selected.' >'.decode_text($row[$Name]).'</option>';
									}
									?>
								</select>
							</div>
						</div>
						
					</form>
		
					<table class="table table-striped">
						<thead>
							<tr class="auto_resize">
								<th><?php echo $input_allcheckbox?> Adı</th>
								<th>Şəkil</th>
								<th class="print_hide">Alətlər</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$query=str_replace("select id ","select * ",$query_count);
						$query.=" $orderBy limit $start,$limit";
						$sql=mysqli_query($db,$query);
						while($row=mysqli_fetch_assoc($sql))
						{
							$image=createFileView($imageFolder,$row["image"]);
							$author='';
							if($row["author_id"]>0){
								$author=mysqli_fetch_assoc(mysqli_query($db,"select $Name from authors where id='$row[author_id]' "));
								$author='('.$author[$Name].')';
							}
							
							$addButtons=array('<a href="index.php?do=news_gallery&parent_id='.$row["id"].'" data-toggle="tooltip" data-original-title="Qalereya" class="m-r-10"><i class="fa fa-photo fa-lg"></i></a>');
							echo '<tr>
									<td>'.checkbox_row($row["id"]).' '.decode_text($row[$Name]).' '.decode_text($author).'</td>
									<td>'.$image.'</td>
									<td class="print_hide">'.rowButtons().'</td>
								</tr>';
						}
						?>
						</tbody>
					</table>
					<?php include "pages/__tools/paginator.php"; ?>
				</div>
				
			</div>
		</div>
	</div>
	
</div>
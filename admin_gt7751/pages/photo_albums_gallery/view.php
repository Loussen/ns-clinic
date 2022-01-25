<?php
if(!defined('db_name')) { header("Location: ../"); exit(); die(); }
include "controller.php";

$data_info=mysqli_fetch_assoc(mysqli_query($db,"select * from $table where id='$parent_id' "));
$page_title="Şəkillər";
?>
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo $page_title?> (<?php echo $data_info[$Name]?>)</h4>
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
					<table class="table table-striped">
						<thead>
							<tr>
								<th style="width:25%"><?php echo $input_allcheckbox?> Adı</th>
								<th style="width:25%">Şəkil</th>
								<th style="width:25%">Ölçüsü</th>
								<th style="width:25%" class="print_hide">Alətlər</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$query=str_replace("select id ","select * ",$query_count);
						$query.=" $orderBy limit $start,$limit";
						$sql=mysqli_query($db,$query);
						while($row=mysqli_fetch_assoc($sql))
						{
							if($row["image"]!=""){
								$image=createFileView($imageFolder,$row["image"]);
								list($width, $height, $type, $attr) = getimagesize($imageFolder.'/'.$row["image"]);
							}
							echo '<tr>
									<td>'.checkbox_row($row["id"]).' '.decode_text($row[$Name]).'</td>
									<td>'.$image.'</td>
									<td>'.$width.'x'.$height.'</td>
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
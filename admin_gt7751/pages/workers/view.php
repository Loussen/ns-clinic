<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
include "controller.php";
$page_title="İşçilərim";
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
					<table class="table table-striped">
						<thead>
							<tr class="auto_resize">
								<th style="width:50%"><?php echo $input_allcheckbox?> ID</th>
								<th style="width:50%">Ad</th>
								<th style="width:50%">Login</th>
								<th style="width:50%">Email</th>
								<th style="width:50%" class="print_hide">
									Alətlər
									<?php $sql_encode=encrypt_decrypt('encrypt',str_replace("select id ","select * ",$query_count)); ?>
									<a href="PHPExcel/<?php echo $do?>.php?sql=<?php echo $sql_encode?>"  class="print_hide pull-right" data-toggle="tooltip" data-animation="false" data-original-title="Excel">
										<i class="fa fa-file-excel-o fa-2x"></i>
									</a>
								</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$query=str_replace("select id ","select * ",$query_count);
						$query.=" $orderBy limit $start,$limit";
						$sql=mysqli_query($db,$query);
						while($row=mysqli_fetch_assoc($sql))
						{
							$addButtons=array('<a href="index.php?do=workers&login_this='.$row["id"].'" data-toggle="tooltip" data-animation="false" data-original-title="Bu adla daxil ol" class="m-r-10"> <i class="fa fa-sign-in fa-lg"></i></a>');
							
							echo '<tr>
									<td>'.checkbox_row($row["id"]).' '.$row["id"].'</td>
									<td>'.decode_text($row["name"]).'</td>
									<td>'.decode_text($information["login"]).'</td>
									<td>'.decode_text($information["email"]).'</td>
									<td class="print_hide">'.rowButtons($addButtons).'</td>
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
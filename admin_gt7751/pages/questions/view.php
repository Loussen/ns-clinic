<?php
if(!defined('db_name')) { header("Location: ../"); exit(); die(); }
include "controller.php";
if($parent_id>0) $page_title="Cavablar"; else $page_title='Suallar';
?>
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">
				<?php if($parent_id>0) { ?>
					<a href="<?php echo addFullUrl(array('parent_id'=>0,'add'=>0,'edit'=>0))?>" data-toggle="tooltip" data-original-title="Geri qayıt" class="m-r-10"><i class="fa fa-arrow-left fa-lg"></i></a>
				<?php } ?>
				<?php echo $page_title?>
			</h4>
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
								<th style="width:50%"><?php echo $input_allcheckbox?> Sual / Cavab</th>
								<th style="width:50%" class="print_hide">Alətlər</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$query=str_replace("select id ","select * ",$query_count);
						$query.=" $orderBy limit $start,$limit";
						$sql=mysqli_query($db,$query);
						while($row=mysqli_fetch_assoc($sql))
						{
							if($parent_id>0) $var=decode_text($row["answer_".$lang_name]).' - <b>'.$row["vote_count"].'</b>';
							else $var='<a href="'.addFullUrl(array('parent_id'=>$row["id"],'edit'=>0,'add'=>0)).'">'.decode_text($row["question_".$lang_name]).'</a>';
							echo '<tr>
									<td>'.checkbox_row($row["id"]).' '.$var.'</td>
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
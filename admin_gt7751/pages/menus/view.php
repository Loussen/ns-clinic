<?php
if(!defined('db_name')) { header("Location: ../"); exit(); die(); }
include "controller.php";
$page_title="Menyular";
?>
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo $page_title?></h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="index.php"><?php echo $mainSection?></a></li>
				<li><a href="<?php echo addFullUrl(array('add'=>0,'edit'=>0,'delete'=>0))?>" class="li_active"><?php echo $page_title?> <?php if($edit>0) echo '(Menu ID: '.$edit.')'; ?></a></li>
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
				
				<?php
				function sub_menus($do,$parent_id){
					global $Name, $hide_check, $lang_name, $setParamsZero_edit, $setParamsZero_delete, $setParamsZero_up, $setParamsZero_down, $settings_inner, $get_table_name_columns, $db, $permissions, $user;
					$mesafe='';
					$yoxlanis_parent_id=$parent_id;
					for($i=1;$i<=10;$i++){
						$yoxlanis=mysqli_fetch_assoc(mysqli_query($db,"select id, parent_id from $do where id='$yoxlanis_parent_id' "));
						if($yoxlanis["id"]==0) break;
						else{
							$yoxlanis_parent_id=$yoxlanis["parent_id"];
							$mesafe.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
					}
					
					if($settings_inner["position_desc"]>0){ $v1='down'; $v2='up'; } else { $v1='up'; $v2='down'; }
					
					$sql=mysqli_query($db,"select id,$Name,important,parent_id,active from $do where parent_id='$parent_id' order by position");
					while($row=mysqli_fetch_assoc($sql)){
						$parent_menu=mysqli_fetch_assoc(mysqli_query($db,"select $Name from $do where id='$row[parent_id]' "));
						
						if($row["active"]==1){ $class='fa-toggle-on'; $title_link='Active'; } else { $class='fa-toggle-off'; $title_link='Deactive'; }
						if(in_array('important',$get_table_name_columns) && $row["important"]==1) $data_important=1; else $data_important=0;
						
						$addButton=array();
						if($settings_inner["edit_available"]>0 && ( (isset($permissions->$do->edit) && $permissions->$do->edit==1) or $user["role_id"]==1 ) )
							$addButton[]='<a href="'.addFullUrl(array('edit'=>$row["id"])+$setParamsZero_edit).'" data-toggle="tooltip" data-original-title="Düzəliş et" class="m-r-10"> <i class="fa fa-pencil fa-lg"></i></a>';
						if($settings_inner["delete_available"]>0 && ( (isset($permissions->$do->delete) && $permissions->$do->delete==1) or $user["role_id"]==1 ) )
							$addButton[]='<a href="'.addFullUrl(array('delete'=>$row["id"])+$setParamsZero_delete).'"  class="delete m-r-10" data-toggle="tooltip" data-original-title="Sil" data-title="Data ID: '.$row["id"].'" data-important="'.$data_important.'"> <i class="fa fa-close text-danger fa-lg"></i></a>';
						
						if($settings_inner["position_available"]>0  && in_array('position',$get_table_name_columns) && ( (isset($permissions->$do->position) && $permissions->$do->position==1) or $user["role_id"]==1 ) )
							$addButton[]='
							<a href="'.addFullUrl(array($v1=>$row["id"])+$setParamsZero_up).'" data-toggle="tooltip" data-original-title="Yuxarı" class="m-r-10"><i class="fa fa-arrow-up fa-lg"></i></a>
							<a href="'.addFullUrl(array($v2=>$row["id"])+$setParamsZero_down).'" data-toggle="tooltip" data-original-title="Aşağı" class="m-r-10"><i class="fa fa-arrow-down fa-lg"></i></a>
						';
						
						if($settings_inner["active_available"]>0 && ( (isset($permissions->$do->active) && $permissions->$do->active==1) or $user["role_id"]==1 ) )
							$addButton[]='<a href="javascript:void(0);" data-toggle="tooltip" data-original-title="Aktiv/Deaktiv" ><i class="fa '.$class.' fa-lg text-info m-r-10" title="'.$title_link.'" style="cursor:pointer" id="info_'.$row["id"].'" onclick="active(\''.$do.'\',this.id,this.title)"></i></a>';
						
						echo '<tr>
							<td>'.checkbox_row($row["id"]).' '.$mesafe.decode_text($row[$Name]).'</td>
							<td>'.decode_text($parent_menu[$Name]).'</td>
							<td class="print_hide">'.rowButtons($addButton,false,false,false,false).'</td>
						</tr>';
						
						if(mysqli_num_rows(mysqli_query($db,"select id from $do where parent_id='$row[id]' and $row[id]>0"))>0){
							sub_menus($do,$row["id"]);
						}
					}
				}
				?>
				<div class="table-responsive dataTables_wrapper <?php echo unCurrentClass()?>">
					<table class="table table-striped">
						<thead>
							<tr>
								<th style="width:33%"><?php echo $input_allcheckbox?> Adı</th>
								<th style="width:33%">Ana menyu</th>
								<th style="width:33%" class="print_hide">Alətlər</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$query=str_replace("select id ","select * ",$query_count);
						$query.=" $orderBy limit $start,$limit";
						$sql=mysqli_query($db,$query);
						while($row=mysqli_fetch_assoc($sql))
						{
							$parent_menu=mysqli_fetch_assoc(mysqli_query($db,"select $Name from $do where id='$row[parent_id]' "));
							echo '<tr>
								<td>'.checkbox_row($row["id"]).' '.decode_text($row[$Name]).'</td>
								<td>'.decode_text($parent_menu[$Name]).'</td>
								<td class="print_hide">'.rowButtons().'</td>
							</tr>';

							if(mysqli_num_rows(mysqli_query($db,"select id from $do where parent_id='$row[id]' "))>0){
								sub_menus($do,$row["id"]);
							}
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
<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php if($settings_inner["show_datacount"]>0) { ?>
	<div class="dataTables_info" id="myTable_info" role="status" aria-live="polite"><?php echo page_nav()?></div>
<?php } ?>

<?php
if($settings_inner["paginator_available"]>0) {
	if(isset($query_count )) {
		$count_rows=mysqli_num_rows(mysqli_query($db,$query_count));
		$max_page=ceil($count_rows/$limit);
		if($max_page<1) $max_page=1;
		if($page>$max_page) $page=$max_page;
	}
?>
	<div class="dataTables_paginate paging_simple_numbers print_hide <?php if($max_page==1) echo 'hide'; ?>">
	<ul class="pagination">
		<?php
		if(isset($query_count )) {
			if(!isset($otherPaginatorPrams)) $otherPaginatorPrams=array();
			$show=3;
			if($page>$show+1) echo '<li class="paginate_button previous"><a href="'.addFullUrl(array('page'=>1)+$otherPaginatorPrams).'">İlk səhifə</a></li>';
			if($page>1) echo '<li class="paginate_button previous"><a href="'.addFullUrl(array('page'=>($page-1))+$otherPaginatorPrams).'">«</a></li>';
				for($i=$page-$show;$i<=$page+$show;$i++)
				{
					if($i==$page) $class='current'; else $class='';
					if($i>0 && $i<=$max_page) echo '<li class="paginate_button '.$class.'"><a href="'.addFullUrl(array('page'=>$i)+$otherPaginatorPrams).'">'.$i.'</a></li>';
				}
			if($page<$max_page) echo '<li class="paginate_button next"><a href="'.addFullUrl(array('page'=>($page+1))+$otherPaginatorPrams).'">»</a></li>';
			if($page<$max_page-$show && $max_page>1) echo '<li class="paginate_button next"><a href="'.addFullUrl(array('page'=>$max_page)+$otherPaginatorPrams).'"> Son səhifə </a></li>';
		}
		else echo 'Please check your $query_count variable. Set in the controller';
		?>
	</ul>
	</div>
<?php } ?>
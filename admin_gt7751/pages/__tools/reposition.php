<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

// After delete.. Delete all childs
if($delete>0 && isset($delChildForThis) && in_array($delChildForThis,$get_table_name_columns) ){
	include "pages/__tools/delete_all_childs.php";
}

// After delete.. Do reposition
if(in_array('position',$get_table_name_columns)){
	if(isset($addPositionQuery) && $addPositionQuery!='' ) $addQ=$addPositionQuery; else $addQ='';
	
	$new_position=1;
	$sql=mysqli_query($db,"select id from $do where id>0 $addQ order by position"); $positionUpdate='';
	while($row=mysqli_fetch_assoc($sql)){
		$positionUpdate.=" when id='$row[id]' $addQ then '$new_position' ";
		$new_position++;
	}
	$query_update="update $do set position=case".$positionUpdate."else position end;";
	if($positionUpdate!='') mysqli_query($db,$query_update);
	
	
	if(in_array('parent_id',$get_table_name_columns)){
	    $new_position=1;
    	$sql=mysqli_query($db,"select id from $do where parent_id=0 order by position"); $positionUpdate='';
    	while($row=mysqli_fetch_assoc($sql)){
    		$positionUpdate.=" when id='$row[id]' then '$new_position' ";
    		$new_position++;
    	}
    	$query_update="update $do set position=case".$positionUpdate."else position end;";
	    if($positionUpdate!='') mysqli_query($db,$query_update);
	    
	    
    	$sql=mysqli_query($db,"select id from $do where parent_id=0 order by position"); $positionUpdate='';
    	while($row=mysqli_fetch_assoc($sql)){
    	    $new_position=1;
    	    $sql2=mysqli_query($db,"select id from $do where parent_id='$row[id]' order by position");
    	    while($row2=mysqli_fetch_assoc($sql2)){
        		$positionUpdate.=" when id='$row2[id]' then '$new_position' ";
        		$new_position++;
    	    }
    	}
    	$query_update="update $do set position=case".$positionUpdate."else position end;";
	    if($positionUpdate!='') mysqli_query($db,$query_update);
	    
	    
    	$sql=mysqli_query($db,"select id from $do where parent_id=0 order by position"); $positionUpdate='';
    	while($row=mysqli_fetch_assoc($sql)){
    	    $sql2=mysqli_query($db,"select id from $do where parent_id='$row[id]' order by position");
    	    while($row2=mysqli_fetch_assoc($sql2)){
    	        $new_position=1;
    	        $sql3=mysqli_query($db,"select id from $do where parent_id='$row2[id]' order by position");
    	        while($row3=mysqli_fetch_assoc($sql3)){
            		$positionUpdate.=" when id='$row3[id]' then '$new_position' ";
            		$new_position++;
    	        }
    	    }
    	}
    	$query_update="update $do set position=case".$positionUpdate."else position end;";
	    if($positionUpdate!='') mysqli_query($db,$query_update);
	    
	    
    	$sql=mysqli_query($db,"select id from $do where parent_id=0 order by position"); $positionUpdate='';
    	while($row=mysqli_fetch_assoc($sql)){
    	    $sql2=mysqli_query($db,"select id from $do where parent_id='$row[id]' order by position");
    	    while($row2=mysqli_fetch_assoc($sql2)){
    	        $sql3=mysqli_query($db,"select id from $do where parent_id='$row2[id]' order by position");
    	        while($row3=mysqli_fetch_assoc($sql3)){
    	            $new_position=1;
    	            $sql4=mysqli_query($db,"select id from $do where parent_id='$row3[id]' order by position");
    	            while($row4=mysqli_fetch_assoc($sql4)){
                		$positionUpdate.=" when id='$row4[id]' then '$new_position' ";
                		$new_position++;
    	            }
    	        }
    	    }
    	}
    	$query_update="update $do set position=case".$positionUpdate."else position end;";
	    if($positionUpdate!='') mysqli_query($db,$query_update);
	    
	}
}
?>
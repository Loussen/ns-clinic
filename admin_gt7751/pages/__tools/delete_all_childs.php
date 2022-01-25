<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }

// TREE 1
$sql=mysqli_query($db,"select id from $do where $delChildForThis='$delete' ");
if(mysqli_num_rows($sql)>0){
	while($row=mysqli_fetch_assoc($sql)){
		
		// TREE 2
		$sql2=mysqli_query($db,"select id from $do where $delChildForThis='$row[id]' ");
		if(mysqli_num_rows($sql2)>0){
			while($row2=mysqli_fetch_assoc($sql2)){
				
				// TREE 3
				$sql3=mysqli_query($db,"select id from $do where $delChildForThis='$row2[id]' ");
				if(mysqli_num_rows($sql3)>0){
					while($row3=mysqli_fetch_assoc($sql3)){
						
						// TREE 4
						$sql4=mysqli_query($db,"select id from $do where $delChildForThis='$row3[id]' ");
						if(mysqli_num_rows($sql4)>0){
							while($row4=mysqli_fetch_assoc($sql4)){
								
								// TREE 5
								$sql5=mysqli_query($db,"select id from $do where $delChildForThis='$row4[id]' ");
								if(mysqli_num_rows($sql5)>0){
									while($row5=mysqli_fetch_assoc($sql5)){
										
										// etc.
										mysqli_query($db,"delete from $do where $delChildForThis='$row5[id]' ");
									}
								}
								mysqli_query($db,"delete from $do where $delChildForThis='$row4[id]' ");
							}
						}
						mysqli_query($db,"delete from $do where $delChildForThis='$row3[id]' ");
					}
				}
				mysqli_query($db,"delete from $do where $delChildForThis='$row2[id]' ");
			}
		}
		mysqli_query($db,"delete from $do where $delChildForThis='$row[id]' ");
	}
}
mysqli_query($db,"delete from $do where $delChildForThis='$delete' ");
?>
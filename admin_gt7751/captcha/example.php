<img src="securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" width="100" height="25" align="absmiddle" id="image" />&nbsp;<a href="#" onClick="document.getElementById('image').src = 'securimage_show.php?sid=' + Math.random(); return false">Yenilə</a>


<?php
//include("sekilli_kod/securimage.php");
//$img = new Securimage();
//@$valid = $img->check($_POST['code']);
//if($valid == true)
?>
<?php
$errorMsg=''; $successMsg=''; $infoMsg=''; $runJs='';

if($do=='haqqimizda'){
	$info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='haqqimizda' "));
	$siteTitle=$info_menu["name_".$lang_name];
	$siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
	$siteKeywords=$info_description["keywords_".$lang_name];
	$siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='haber'){
	$info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='haberler' "));
	$id=intval($_GET["id"]);
	$info_data=mysqli_fetch_assoc(mysqli_query($db,"select * from news where id='$id' "));
	if(mysqli_num_rows(mysqli_query($db,"select id from news where id='$id' "))==0) {header("Location: $site"); exit();}
	$siteTitle=$info_data["name_".$lang_name];
	$siteDescription=substr_(decode_text($info_data["full_text_".$lang_name],true,true),0,250);
	$siteKeywords=$info_description["keywords_".$lang_name];
	$siteImage=SITE_PATH.'/images/news/'.$info_data["image"];
}
elseif($do=='markalarimiz'){
	$info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='markalarimiz' "));
	$siteTitle=$info_menu["name_".$lang_name];
	$siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
	$siteKeywords=$info_description["keywords_".$lang_name];
	$siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='marka'){
	$info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='markalarimiz' "));
	
	$id=intval($_GET["id"]);
	$info_data=mysqli_fetch_assoc(mysqli_query($db,"select * from products where id='$id' "));
	if(mysqli_num_rows(mysqli_query($db,"select id from products where id='$id' "))==0) {header("Location: $site"); exit();}
	$siteTitle=$info_data["name_".$lang_name];
	$siteDescription=substr_(decode_text($info_data["full_text_".$lang_name],true,true),0,250);
	$siteKeywords=$info_description["keywords_".$lang_name];
	$siteImage=SITE_PATH.'/images/products/'.$info_data["image"];
	
	$info_cat=mysqli_fetch_assoc(mysqli_query($db,"select * from categories where id='$info_data[category_id]' "));
}
elseif($do=='fason-uretim'){
	$info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='fason-uretim' "));
	$siteTitle=$info_menu["name_".$lang_name];
	$siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
	$siteKeywords=$info_description["keywords_".$lang_name];
	$siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='uretim'){
	$info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='markalarimiz' "));
	
	$id=intval($_GET["id"]);
	$info_data=mysqli_fetch_assoc(mysqli_query($db,"select * from products2 where id='$id' "));
	if(mysqli_num_rows(mysqli_query($db,"select id from products2 where id='$id' "))==0) {header("Location: $site"); exit();}
	$siteTitle=$info_data["name_".$lang_name];
	$siteDescription=substr_(decode_text($info_data["full_text_".$lang_name],true,true),0,250);
	$siteKeywords=$info_description["keywords_".$lang_name];
	$siteImage=SITE_PATH.'/images/products2/'.$info_data["image"];
	
	$info_cat=mysqli_fetch_assoc(mysqli_query($db,"select * from categories2 where id='$info_data[category_id]' "));
}
elseif($do=='pages'){
	$menu_id=intval($_GET["menu_id"]);
	$info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where id='$menu_id' and active=1 "));
	if(intval($info_menu["id"])==0) {header("Location: $site"); exit();}
	
	$siteTitle=$info_menu["name_".$lang_name];
	$siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
	$siteKeywords=$info_description["keywords_".$lang_name];
	$siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='iletishim'){
	$info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='iletishim' "));
	$siteTitle=$info_menu["name_".$lang_name];
	$siteDescription=$info_description["description_".$lang_name];
	$siteKeywords=$info_description["keywords_".$lang_name];
	$siteImage=SITE_PATH.'/assets/img/logo-rentit.png';
}
elseif($do=='albom'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='albom'"));
    $siteTitle=$info_menu["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='fotoqalereya'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='albom' "));

    $id=intval($_GET["id"]);
    $info_data=mysqli_fetch_assoc(mysqli_query($db,"select * from photo_albums where id='$id' "));
    if(mysqli_num_rows(mysqli_query($db,"select id from photo_albums where id='$id' "))==0) {header("Location: $site"); exit();}
    $siteTitle=$info_data["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_data["text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/photo_albums/'.$info_data["image"];
}
elseif($do=='videoqalereya'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='videoqalereya' "));

    $siteTitle=$info_menu["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='service'){
    $id=intval($_GET["id"]);
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='xidmetler' and active=1 "));
    $info_service=mysqli_fetch_assoc(mysqli_query($db,"select * from services where id='$id' and active=1 "));
    if(intval($info_menu["id"])==0 || intval($info_service['id'])==0) {header("Location: $site"); exit();}

    $siteTitle=$info_menu["name_".$lang_name]." - ".$info_service["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_service["full_text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/services/'.$info_service["image"];
}
elseif($do=='services'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='xidmetler'"));
    $siteTitle=$info_menu["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='method'){
    $id=intval($_GET["id"]);
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='mualice-metodlari' and active=1 "));
    $info_method=mysqli_fetch_assoc(mysqli_query($db,"select * from methods where id='$id' and active=1 "));
    if(intval($info_menu["id"])==0 || intval($info_method['id'])==0) {header("Location: $site"); exit();}

    $siteTitle=$info_menu["name_".$lang_name]." - ".$info_method["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_method["full_text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/methods/'.$info_method["image"];
}
elseif($do=='methods'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='mualice-metodlari'"));
    $siteTitle=$info_menu["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='genetik-test'){
    $id=intval($_GET["id"]);
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='genetik-testler' and active=1 "));
    $info_genetik=mysqli_fetch_assoc(mysqli_query($db,"select * from methods where id='$id' and active=1 "));
    if(intval($info_menu["id"])==0 || intval($info_genetik['id'])==0) {header("Location: $site"); exit();}

    $siteTitle=$info_menu["name_".$lang_name]." - ".$info_genetik["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_genetik["full_text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/methods/'.$info_genetik["image"];
}
elseif($do=='genetik-testler'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='genetik-testler'"));
    $siteTitle=$info_menu["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='departments'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='departamentler'"));
    $siteTitle=$lang44;
    $siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='doctors'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='hekimlerimiz'"));
    $siteTitle=$info_menu["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/doctors/'.$info_menu["image"];
}
elseif($do=='comments'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='reyler'"));
    $siteTitle=$info_menu["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='department'){
    $id=intval($_GET["id"]);
//    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='departamentler' and active=1 "));
    $info_department=mysqli_fetch_assoc(mysqli_query($db,"select * from departments where id='$id' and active=1 "));
    if(intval($info_department['id'])==0) {header("Location: $site"); exit();}

    $siteTitle=$lang44." - ".$info_department["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_department["full_text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/departments/'.$info_department["image"];
}
elseif($do=='doctor'){
    $id=intval($_GET["id"]);
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='hekimlerimiz' and active=1 "));
    $info_doctor=mysqli_fetch_assoc(mysqli_query($db,"select * from doctors where id='$id' and active=1 "));
    if(intval($info_menu["id"])==0 || intval($info_doctor['id'])==0) {header("Location: $site"); exit();}

    $siteTitle=$info_menu["name_".$lang_name]." - ".$info_doctor["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_doctor["full_text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/doctors/'.$info_doctor["image"];
}
elseif($do=='contact'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='elaqe'"));
    $siteTitle=$info_menu["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='appointment'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from appointment "));
    $siteTitle=$info_menu["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_menu["full_text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='bloq'){
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='bloq'"));
    $siteTitle=$info_menu["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_menu["text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/menus/'.$info_menu["image"];
}
elseif($do=='xeber'){
    $id=intval($_GET["id"]);
    $info_menu=mysqli_fetch_assoc(mysqli_query($db,"select * from menus where link='bloq' and active=1 "));
    $info_news=mysqli_fetch_assoc(mysqli_query($db,"select * from news where id='$id' and active=1 "));
    if(intval($info_menu["id"])==0 || intval($info_news['id'])==0) {header("Location: $site"); exit();}

    $siteTitle=$info_menu["name_".$lang_name]." - ".$info_news["name_".$lang_name];
    $siteDescription=substr_(decode_text($info_news["short_text_".$lang_name],true,true),0,250);
    $siteKeywords=$info_description["keywords_".$lang_name];
    $siteImage=SITE_PATH.'/images/news/'.$info_news["image"];
}
else{
	$siteTitle=$info_description["title_".$lang_name];
	$siteDescription=$info_description["description_".$lang_name];
	$siteKeywords=$info_description["keywords_".$lang_name];
	$siteImage=SITE_PATH.'/assets/img/logo/logo_new.png';
}
?>
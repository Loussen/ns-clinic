<?php
session_start();
require_once "pages/__includes/simple_html_dom.php";

$start_url='';
$file = "";
$limit=500;
$check_all_links='no';

if(isset($_POST["start_submit"])){
	if(isset($_POST["start_url"])) $start_url=$_POST["start_url"]; else $start_url='';
	if(isset($_POST["check_all_links"])) $check_all_links=$_POST["check_all_links"]; else $check_all_links='no';
	if(isset($_POST["file"])){
		$file='../'.$_POST["file"];
		$exp=explode(".",$file);
		if(strtolower(end($exp))!='xml'){
			$error="Sitemap URL is not correct!";
			$start_url='';
		}
	}
}

if(isset($_GET["cancel"])){
	if(is_file($file)) unlink($file);
	header("Location: sitemap-generator.php");
	exit();
}

$extension = [".html", ".php", "/"]; 
$freq = "daily";
$priority = "1.0";

function rel2abs($rel, $base) {
	if(strpos($rel,"//") === 0) {
		return "http:".$rel;
	}
	/* return if  already absolute URL */
	if  (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;
	$first_char = substr ($rel, 0, 1);
	/* queries and  anchors */
	if ($first_char == '#'  || $first_char == '?') return $base.$rel;
	/* parse base URL  and convert to local variables:
	$scheme, $host,  $path */
	extract(parse_url($base));
	/* remove  non-directory element from path */
	$path = preg_replace('#/[^/]*$#',  '', $path);
	/* destroy path if  relative url points to root */
	if ($first_char ==  '/') $path = '';
	/* dirty absolute  URL */
	$abs =  "$host$path/$rel_111";
	/* replace '//' or  '/./' or '/foo/../' with '/' */
	$re =  array('#(/.?/)#', '#/(?!..)[^/]+/../#');
	for($n=1; $n>0;  $abs=preg_replace($re, '/', $abs, -1, $n)) {}
	/* absolute URL is  ready! */
	return  $scheme.'://'.$abs;
}

function GetUrl($url , $method = 'GET' ,   $data =  []){
	$method=strtoupper($method);
	$c=curl_init();

	$user_agents=[
	"Mozilla/5.0(Linux;Android5.0.2;AndromaxC46B2GBuild/LRX22G)AppleWebKit/537.36(KHTML,likeGecko)Version/4.0Chrome/37.0.0.0MobileSafari/537.36[FB_IAB/FB4A;FBAV/60.0.0.16.76;]",
	"[FBAN/FB4A;FBAV/35.0.0.48.273;FBDM/{density=1.33125,width=800,height=1205};FBLC/en_US;FBCR/;FBPN/com.facebook.katana;FBDV/Nexus7;FBSV/4.1.1;FBBK/0;]",
	"Mozilla/5.0(Linux;Android5.1.1;SM-N9208Build/LMY47X)AppleWebKit/537.36(KHTML,likeGecko)Chrome/51.0.2704.81MobileSafari/537.36",
	"Mozilla/5.0(Linux;U;Android5.0;en-US;ASUS_Z008Build/LRX21V)AppleWebKit/534.30(KHTML,likeGecko)Version/4.0UCBrowser/10.8.0.718U3/0.8.0MobileSafari/534.30",
	"Mozilla/5.0(Linux;U;Android5.1;en-US;E5563Build/29.1.B.0.101)AppleWebKit/534.30(KHTML,likeGecko)Version/4.0UCBrowser/10.10.0.796U3/0.8.0MobileSafari/534.30",
	"Mozilla/5.0(Linux;U;Android4.4.2;en-us;CelkonA406Build/MocorDroid2.3.5)AppleWebKit/533.1(KHTML,likeGecko)Version/4.0MobileSafari/533.1"
	];
	$useragent=$user_agents[array_rand($user_agents)];

	$opts=[
		CURLOPT_URL=>$url.($method=='GET'&&!empty($data)?'?'.http_build_query($data):''),
		CURLOPT_RETURNTRANSFER=>true,
		CURLOPT_SSL_VERIFYPEER=>false,
		CURLOPT_USERAGENT=>$useragent
	];

	if($method=='POST'){
		$opts[CURLOPT_POST]=true;
		$opts[CURLOPT_POSTFIELDS]=http_build_query($data);
	}
	elseif($method=='DELETE'){
		$opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
		$opts[CURLOPT_POST] = true;
		$opts[CURLOPT_POSTFIELDS] = http_build_query($data);
	}
	curl_setopt_array($c, $opts);
	$result = curl_exec( $c );
	curl_close( $c );
	return $result;
}

function validate_url($website){
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      return false;
    }
    else return true;
}

function Scan ($url) {
	global $start_url, $extension, $freq, $priority, $limit, $check_all_links, $file;
	
	$added=$_SESSION["added"];
	$queue=$_SESSION["queue"];

	if (!validate_url ($url) || in_array ($url, $added)) {
		return;
	}
	else{
		$pr = number_format ( round ( $priority / count ( explode( "/", trim ( str_ireplace ( array ("http://", "https://"), "", $url ), "/" ) ) ) + 0.5, 3 ), 1 );
		$pf = fopen ($file, "a+");
		$write= "  <url>\n" .
					 "    <loc>" . htmlentities ($url) ."</loc>\n" .
					 "    <changefreq>$freq</changefreq>\n" .
					 "    <priority>$pr</priority>\n" .
					 "  </url>\n";
		fwrite ($pf, $write);
		fclose ($pf);
		$added[]=$url;
		$_SESSION["added"]=$added;
		
		$key = array_search($url, $queue);
		if(is_numeric($key)){
			unset($queue[$key]);
			sort($queue);
		}
	}
	
	$html = str_get_html (GetUrl ($url));
	$a1l_a   = $html->find('a');

	foreach ($a1l_a as $val){
		$this_url = $val->href or "";
		
		if($this_url=='') continue;
		
		$fragment_split = explode ("#", $this_url);
		$this_url       = $fragment_split[0];

		if ((substr ($this_url, 0, 7) != "http://")  && 
			(substr ($this_url, 0, 8) != "https://") &&
			(substr ($this_url, 0, 6) != "ftp://")   &&
			(substr ($this_url, 0, 7) != "mailto:"))
		{
			$this_url = @rel2abs ($this_url, $url);
		}

		if (substr ($this_url, 0, strlen ($start_url)) == $start_url) {
			$ignore = false;

			if (!validate_url ($this_url)) $ignore = true;
			if (in_array ($this_url, $added)) $ignore = true;
			if (in_array ($this_url, $queue)) $ignore = true;

			if (!$ignore) {
				foreach ($extension as $ext) {
					if (strpos ($this_url, $ext) > 0) {
						$queue[]=$this_url;
						break;
					}
				}
			}
		}
	}
	$_SESSION["queue"]=$queue;
	
	
	if($check_all_links=='no'){
		$pf = fopen ($file, "a+");
		foreach($queue as $q){
			$pr = number_format ( round ( $priority / count ( explode( "/", trim ( str_ireplace ( array ("http://", "https://"), "", $q ), "/" ) ) ) + 0.5, 3 ), 1 );
			$write= "  <url>\n" .
					 "    <loc>" . htmlentities ($q) ."</loc>\n" .
					 "    <changefreq>$freq</changefreq>\n" .
					 "    <priority>$pr</priority>\n" .
					 "  </url>\n";
			fwrite ($pf, $write);
			$added[]=$url;
		}
		fwrite ($pf, "</urlset>\n");
		fclose ($pf);
		$_SESSION["added"]=$added;
		
		return count($_SESSION["added"]).'~~~0~~~finished~~~'.$file.'~~~~'.$file;
	}
	
	
	if( count($queue)==0 || count($added)>=$limit ){
		$pf = fopen ($file, "a+");
		fwrite ($pf, "</urlset>\n");
		fclose ($pf);
		
		return 'finished~~~'.count($_SESSION["added"]).'~~~'.$file;
	}
	else{
		foreach($queue as $q){
			return $q;
		}
	}
}

if(isset($_POST["processName"])) $processName=$_POST["processName"]; else $processName='';
if($processName=='crawling'){
	if(isset($_POST["check_all_links"])) $check_all_links=$_POST["check_all_links"]; else $check_all_links='no';
	if(isset($_POST["first_request"])) $first_request=$_POST["first_request"]; else $first_request='no';
	if(isset($_POST["next_url"])) $next_url=$_POST["next_url"]; else $next_url='';
	if(isset($_POST["start_url"])) $start_url=$_POST["start_url"]; else $start_url='';
		if($start_url=='') exit();
		
	if(isset($_POST["file"])) $file=$_POST["file"]; else $file='';
		$file=$_POST["file"];
		$exp=explode(".",$file);
		if(strtolower(end($exp))!='xml'){
			$error="Sitemap URL is not correct!";
			$start_url='';
		}
		
	if($first_request=='yes'){
		$pf = fopen ($file, "w+");
		fwrite ($pf, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
				 "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n" .
				 "        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n" .
				 "        xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n" .
				 "        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n" .
				 "  <url>\n" .
				 "    <loc>" . htmlentities ($start_url) ."</loc>\n" .
				 "    <changefreq>$freq</changefreq>\n" .
				 "    <priority>$priority</priority>\n" .
				 "  </url>\n");
		fclose ($pf);
		$_SESSION["queue"][]=$start_url;
	}
	
	if($next_url!=''){
		$res=Scan($next_url);
	}

	$_SESSION["request_count"]++;
	
	if($check_all_links=='no'){
		echo $res;
	}
	else{
		echo count($_SESSION["added"]).'~~~'.count($_SESSION["queue"]).'~~~'.$res.'~~~'.$_SESSION["request_count"].'~~~'.$next_url;
	}
	exit();
}
else{
	$_SESSION["next_url"]='';
	$_SESSION["added"]=[];
	$_SESSION["queue"]=[];
	$_SESSION["request_count"]=0;
}

if(!isset($_SESSION["next_url"])) $_SESSION["next_url"]='';
?>

<!doctype html>
<html lang="en">
<head>
	<title>Sitemap Generator</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?php if($processName!='crawling'){ ?>
		<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
		<link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" />
	<?php } ?>
	<script>
	function scan(next_url,first_request='no'){
		$.post("sitemap-generator.php",{processName:'crawling',start_url:'<?=$start_url?>',next_url:next_url,file:'<?=$file?>',check_all_links:'<?=$check_all_links?>',first_request:first_request},function(data){
			console.log(data);
			var exp=data.split('~~~');
			$("#added_url").html(exp[0]);
			$("#queue_url").html(exp[1]);
			$("#current_url").html(exp[2]);
			
			if(exp[2]!='finished'){
				setTimeout(function(){
					scan(exp[2]);
				}, 100);
			}
			else{
				$("#added_url").html(exp[0]);
				$("#queue_url").html('0');
				$("#current_url").html('Finished');
				$(".progress-bar").html('Finished');
				$(".progress-bar").removeClass('progress-bar-animated');
				$(".cancel_button").hide();
			}
			
		});
	}
	
	<?php if($start_url!=''){ ?>
		$(document).ready(function(){
			setTimeout(function(){
				scan('<?=$start_url?>','yes');
			},1000);
		});
	<?php } ?>
	</script>

</head>
<body>
<div class="container">
	<?php if($start_url!=''){ ?>
		<br />
		<h1 style="text-align:center;">Sitemap Generator is working...</h1>
		<br />
		
		<div class="progress">
			<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">Crawling... Please wait...</div>
		</div>

		<br />
		<b>Current crawling URL:</b> &nbsp; <label id="current_url" style="font-style:italic;color:blue;"><?=$start_url?></label><br />
		<b>Added URL:</b> <label id="added_url" style="color:blue;">Calculating...</label><br />
		<b>Queue:</b> <label id="queue_url" style="color:blue;">Calculating...</label><br />
		
		<br /><br /><a href="" class="btn btn-info">Back to main</a>
		<br /><br /><a href="?cancel=1" class="btn btn-danger cancel_button">Cancel Crawling and delete sitemap</a>
	<?php }else{ ?>
		<br />
		<h1 style="text-align:center;">Sitemap Generator</h1>
		<br />
		
		<form action="" method="post">
			<label>URL:</label><br/>
			<input type="text" name="start_url" placeholder="http://yourdomain.com" value="<?=$start_url?>" class="form-control" required />
			<br/>
			
			<label>File save path:</label><br/>
			<input type="text" name="file" placeholder="sitemap-az.xml or sitemap-ru.xml" value="sitemap-az.xml" class="form-control" required />
			<br/>
			
			<?php /*
			<label>Check All links:</label><br/>
			<select name="check_all_links" class="form-control">
				<option value="no">No</option>
				<option value="yes">Yes</option>
			</select>
			<br/>
			*/
			?>
			<input type="submit" name="start_submit" value="Start Sitemap Generator" class="btn btn-success form-control" />
		</form>

	<?php } ?>
</div>
<body>
</html>
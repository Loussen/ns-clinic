<?php
if(!defined('db_name')) { header("Location: ../../"); exit(); die(); }
$currency_active=$get_settings["currency"];
$namaz_active=$get_settings["namaz"];
$wheather_active=$get_settings["wheather"];
$today=date("Y-m-d");
//Valyuta update
if(mysqli_num_rows(mysqli_query($db,"select id from currency where date='$today' "))==0 && $currency_active==1){
	
	function getHTML($url , $method = 'GET' ,   $data =  []){
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

	$htmls=getHTML("http://valyuta.com/api/get_rate_current_all/USD/AZN,EUR,RUB");
	$json=json_decode($htmls,true);
	$usd=$json[0]['result'];
	$eur=$json[1]['result'];
	$rub=$json[2]['result'];
	if($usd>0) mysqli_query($db,"update currency set usd='$usd', eur='$eur', rub='$rub', date='$today' ");
	
	
	/*
	$all_valyuta = simplexml_load_file("http://cbar.az/currencies/" .date("d.m.Y").".xml");
	foreach($all_valyuta->ValType as $a){
		foreach($a->Valute as $b){
			if(strtoupper($b["Code"])=='USD') $usd=$b->Value;
			if(strtoupper($b["Code"])=='EUR') $eur=$b->Value;
			if(strtoupper($b["Code"])=='RUB') $rub=$b->Value;
		}
	}
	if($usd>0) mysqli_query($db,"update currency set usd='$usd', eur='$eur', rub='$rub', date='$today' ");
	*/
	
	
	/*
	$from="USD";	$to="AZN"; $amount=1;
	$html=file_get_contents('http://www.xe.com/currencyconverter/convert/?Amount='.$amount.'&From='.$from.'&To='.$to);
	$html=strstr($html,'rightCol');		$usd=substr($html,10,6);

	$from="EUR";	$to="AZN"; $amount=1;
	$html=file_get_contents('http://www.xe.com/currencyconverter/convert/?Amount='.$amount.'&From='.$from.'&To='.$to);
	$html=strstr($html,'rightCol');		$eur=substr($html,10,6);

	$from="RUB";	$to="AZN"; $amount=1;
	$html=file_get_contents('http://www.xe.com/currencyconverter/convert/?Amount='.$amount.'&From='.$from.'&To='.$to);
	$html=strstr($html,'rightCol');		$rub=substr($html,10,6);

	$from="GEL";	$to="AZN"; $amount=1;
	$html=file_get_contents('http://www.xe.com/currencyconverter/convert/?Amount='.$amount.'&From='.$from.'&To='.$to);
	$html=strstr($html,'rightCol');		$gel=substr($html,10,6);

	$from="GBP";	$to="AZN"; $amount=1;
	$html=file_get_contents('http://www.xe.com/currencyconverter/convert/?Amount='.$amount.'&From='.$from.'&To='.$to);
	$html=strstr($html,'rightCol');		$gbp=substr($html,10,6);

	$from="SAR";	$to="AZN"; $amount=1;
	$html=file_get_contents('http://www.xe.com/currencyconverter/convert/?Amount='.$amount.'&From='.$from.'&To='.$to);
	$html=strstr($html,'rightCol');		$sar=substr($html,10,6);

	$from="TRY";	$to="AZN"; $amount=1;
	$html=file_get_contents('http://www.xe.com/currencyconverter/convert/?Amount='.$amount.'&From='.$from.'&To='.$to);
	$html=strstr($html,'rightCol');		$try=substr($html,10,6);

	if($usd>0) mysqli_query($db,"update currency set usd='$usd', eur='$eur', rub='$rub', gel='$gel', gbp='$gbp', sar='$sar', try='$try', date='$today' ");
	*/
//
}
elseif(mysqli_num_rows(mysqli_query($db,"select id from namaz_time where date='$today' "))==0 && $namaz_active==1)	//Namaz update
{
$all_date=file_get_contents('http://www.islamicfinder.org/prayer_service.php?country=azerbaijan&city=baku&state=&zipcode=&latitude=40.3953&longitude=49.8822&timezone=4&HanfiShafi=1&pmethod=1&fajrTwilight1=10&fajrTwilight2=10&ishaTwilight=&ishaInterval=30&dhuhrInterval=1&maghribInterval=1&dayLight=1&page_background=FFFFFF&table_background=FFFFFF&table_lines=FFFFFF&text_color=000000&link_color=000000&prayerFajr=Facr&prayerSunrise=Subh&prayerDhuhr=Zohr&prayerAsr=Asr&prayerMaghrib=Magrib&prayerIsha=Isha&lang=');
$all_date=strstr($all_date,'Facr'); $all_date=strstr($all_date,'000000'); $subh=trim(substr($all_date,8)); $end=strpos($all_date,"<"); $subh=substr($subh,0,$end);
$all_date=strstr($all_date,'Subh'); $all_date=strstr($all_date,'000000'); $gun=trim(substr($all_date,8)); $end=strpos($all_date,"<"); $gun=substr($gun,0,$end);
$all_date=strstr($all_date,'Zohr'); $all_date=strstr($all_date,'000000'); $zohr=trim(substr($all_date,8)); $end=strpos($all_date,"<"); $zohr=substr($zohr,0,$end);
$all_date=strstr($all_date,'Asr'); $all_date=strstr($all_date,'000000'); $esr=trim(substr($all_date,8)); $end=strpos($all_date,"<"); $esr=substr($esr,0,$end);
$all_date=strstr($all_date,'Magrib'); $all_date=strstr($all_date,'000000'); $megrib=trim(substr($all_date,8)); $end=strpos($all_date,"<"); $megrib=substr($megrib,0,$end);
$all_date=strstr($all_date,'Isha'); $all_date=strstr($all_date,'000000'); $isha=trim(substr($all_date,8)); $end=strpos($all_date,"<"); $isha=substr($isha,0,$end);
$neyi=array('</font></','</font><'); $neye=array('','');
$subh=str_replace($neyi,$neye,$subh);
$gun=str_replace($neyi,$neye,$gun);
$zohr=str_replace($neyi,$neye,$zohr);
$esr=str_replace($neyi,$neye,$esr);
$megrib=str_replace($neyi,$neye,$megrib);
$isha=str_replace($neyi,$neye,$isha);
mysqli_query($db,"update namaz_time set subh='$subh', gun='$gun', zohr='$zohr', esr='$esr', megrib='$megrib', isha='$isha', date='$today' ");
//
}
elseif(mysqli_num_rows(mysqli_query($db,"select id from wheather where date='$today' "))==0 && $wheather_active==1)	//Hava update
{
	function getCodes(){
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
		curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
		$headers = [
		':authority: www.accuweather.com',
		':method: GET',
		':path: /az/az/baku/27103/daily-weather-forecast/27103',
		':scheme: https',
		'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
		'accept-encoding: gzip, deflate, br',
		'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7,de;q=0.6,az;q=0.5,tr;q=0.4,nl;q=0.3',
		'cache-control: max-age=0',
		'upgrade-insecure-requests: 1',
		'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36'
		];
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$content = curl_exec( $ch );
		curl_close ( $ch );
		return $content;
	}
	
	$query_update="update wheather set ";
	$regions=array(
		'baki'=>'27103',
		'sumqayit'=>'26921',
		'gence'=>'28166',
		'lenkeran'=>'29090',
		'quba'=>'30500',
		'seki'=>'27610',
		'sirvan'=>'30724',
		'mingecevir'=>'29699',
		'naxcivan'=>'30012',
		'susa'=>'30815',
		
	);
	foreach($regions as $key=>$val){
		$all_hava=getCodes("http://www.accuweather.com/az/az/baku/".$val."/daily-weather-forecast/".$val);
		$this_hava=strstr($all_hava,'<span class="temp">');
		$gunduz=intval(substr($this_hava,19,5)); $this_hava=substr($this_hava,19); $this_hava=strstr($this_hava,'<span class="temp">');
		$gece=intval(substr($this_hava,19,5)); $this_hava=$gunduz."```".$gece;
		$query_update.="$key='$this_hava', ";
		break;
	}
		
	$query_update.=" date='$today' ";
	mysqli_query($db,$query_update);
}
?>
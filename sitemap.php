<?php
require_once "admin_gt7751/pages/__includes/config.php";

header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

$sql_menus = mysqli_query($db, "select * from menus where active=1 order by position");

while($row_menus = mysqli_fetch_assoc($sql_menus)) {
    if($row_menus["link"] != '' && $row_menus["link"] != '#') {
        $link = $site . '/' . $row_menus["link"];
    } elseif($row_menus["link"] == '#') {
        continue;
    } else {
        $link = $site . '/pages/' . slugGenerator($row_menus["name_" . $lang_name], '-', false, $lang_name) . '-' . $row_menus["id"];
    }

    echo '<url>' . PHP_EOL;
    echo '<loc>'.$link .'/</loc>' . PHP_EOL;
    echo '<lastmod>'.date('Y-m-dTH:i:sP', time()).'</lastmod>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '<priority>'.($row_menus['link'] == 'home' ? '1.00' : '0.80').'</priority>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

$sql_services = mysqli_query($db, "select * from services where active=1 order by id desc");

while ($row_services = mysqli_fetch_assoc($sql_services)) {
    echo '<url>' . PHP_EOL;
    echo '<loc>'.$site.'/xidmet/'.slugGenerator($row_services['name_'.$lang_name]).'-'.$row_services["id"].'/</loc>' . PHP_EOL;
    echo '<lastmod>'.date('Y-m-dTH:i:sP', time()).'</lastmod>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '<priority>0.80</priority>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

$sql_methods = mysqli_query($db,"select * from methods where active=1 order by id desc");

while ($row_methods = mysqli_fetch_assoc($sql_methods)) {
    echo '<url>' . PHP_EOL;
    echo '<loc>'.$site.'/mualice-metodu/'.slugGenerator($row_methods['name_'.$lang_name]).'-'.$row_methods["id"].'/</loc>' . PHP_EOL;
    echo '<lastmod>'.date('Y-m-dTH:i:sP', time()).'</lastmod>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '<priority>0.80</priority>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

$sql_news = mysqli_query($db,"select * from news where active=1 order by id desc");

while ($row_news = mysqli_fetch_assoc($sql_news)) {
    echo '<url>' . PHP_EOL;
    echo '<loc>'.$site.'/xeber/'.slugGenerator($row_news['name_'.$lang_name]).'-'.$row_news["id"].'/</loc>' . PHP_EOL;
    echo '<lastmod>'.date('Y-m-dTH:i:sP', time()).'</lastmod>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '<priority>0.80</priority>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

echo '<url>' . PHP_EOL;
echo '<loc>'.$site.'/404'.'/</loc>' . PHP_EOL;
echo '<lastmod>'.date('Y-m-dTH:i:sP', time()).'</lastmod>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '<priority>0.80</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;



echo '</urlset>' . PHP_EOL;
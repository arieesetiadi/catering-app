<?PHP require_once "./sw-library/config.php";
header("location:" . $site_url . "/sitemap.xml");
/////////////////////////// SITEMAP OTOMATIS
$file = fopen("./sitemap.xml", "wb");
$_xml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"      
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"    
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9            
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

$_xml .= "\r\n <url>\r\n";
$_xml .= "<loc>" . $site_url . "/</loc>\r\n";
$_xml .= "</url>\r\n";

$_xml .= "\r\n <url>\r\n";
$_xml .= "<loc>" . $site_url . "/aqiqah</loc>\r\n";
$_xml .= "</url>\r\n";


$_xml .= "\r\n <url>\r\n";
$_xml .= "<loc>" . $site_url . "/contact.html</loc>\r\n";
$_xml .= "</url>\r\n";

// sitemap Property
$query = "SELECT product_id,seoname FROM product WHERE active='1' order by product_id desc";
$result = $connection->query($query);
while ($row = $result->fetch_assoc()) {
	extract($row);
	$post_url = "" . $sub_url . "/product/" . $product_id . "-" . $seoname . ".html";
	$_xml .= "<url>\r\n";
	$_xml .= "<loc>" . $post_url . "</loc>\r\n";
	$_xml .= "</url>\r\n";
}


// sitemap post
$query = "SELECT post_id,seotitle FROM post WHERE post_status='1' order by post_id desc";
$result = $connection->query($query);
while ($rows = $result->fetch_assoc()) {
	extract($rows);
	$post_url = "" . $sub_url . "/blog/" . $post_id . "-" . $seotitle . ".html";
	$_xml .= "<url>\r\n";
	$_xml .= "<loc>" . $post_url . "</loc>\r\n";
	$_xml .= "</url>\r\n";
}

#------------------- halaman -----------------------------------
$pages = "SELECT seotitle FROM page WHERE active='Y' order by page_id desc";
$result = $connection->query($pages);
while ($rows = $result->fetch_assoc()) {
	extract($rows);
	$pages_link = "" . $site_url . "/pages/" . $seotitle . ".html";
	$_xml .= "<url>\r\n";
	$_xml .= "<loc>" . $pages_link . "</loc>\r\n";
	$_xml .= "</url>\r\n";
}



#-------------------  kategori Blog -----------------------------------
$query_tags = "SELECT seotitle FROM category WHERE type='2' order by category_id desc";
$result_tags = $connection->query($query_tags);
while ($rows = $result_tags->fetch_assoc()) {
	extract($rows);
	$kategori_link = "" . $site_url . "/blog/category/" . $seotitle . ".html";
	$_xml .= "<url>\r\n";
	$_xml .= "<loc>" . $kategori_link . "</loc>\r\n";
	$_xml .= "</url>\r\n";
}

#-------------------  Tags -----------------------------------
$query_kategori = "SELECT seotitle FROM tags WHERE type='2' order by id desc";
$result_kategori = $connection->query($query_kategori);
while ($rows = $result_kategori->fetch_assoc()) {
	extract($rows);
	$tags_link = "" . $site_url . "/blog/tags/" . $seotitle . ".html";
	$_xml .= "<url>\r\n";
	$_xml .= "<loc>" . $tags_link . "</loc>\r\n";
	$_xml .= "</url>\r\n";
}


$_xml .= "</urlset>";
fwrite($file, $_xml);
fclose($file);


echo '<!DOCTYPE html>
<html lang="en"><head>
<title>Sitemap</title>

</head>
<body">

</body>
</html>';

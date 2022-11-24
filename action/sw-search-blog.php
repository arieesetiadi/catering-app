<?php error_reporting(0);
if(!empty($_GET['search_term_string'])){
	$search_term_string = strip_tags($_GET['search_term_string']);
	$search_term_string = strtolower(str_replace(' ', '-', $search_term_string));
	header('location:./blog/search/'.$search_term_string.'.html');}
else {
	header('location:./blog/search/404.html');
}


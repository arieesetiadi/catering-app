<?PHP
$slash = addslashes("'");
$slash = str_replace("'", "", $slash);
function replace_character($string){
	$string = str_replace('(', '', $string);
	$string = str_replace(')', '', $string);
	$string = str_replace('[', '', $string);
	$string = str_replace(']', '', $string);
	$string = str_replace('{', '', $string);
	$string = str_replace('}', '', $string);
	$string = str_replace('/', '', $string);
	$string = str_replace('*', '', $string);
	$string = str_replace('&', '', $string);
	$string = str_replace('^', '', $string);
	$string = str_replace('@', '', $string);
	$string = str_replace('#', '', $string);
	$string = str_replace('$', '', $string);
	$string = str_replace('!', '', $string);
	$string = str_replace(':', '', $string);
	$string = str_replace(';', '', $string);
	$string = str_replace('?', '', $string);
	$string = str_replace('+', '', $string);
	$string = str_replace('=', '', $string);
	$string = str_replace('|', '', $string);
	$string = str_replace('`', '', $string);
	$string = str_replace('~', '', $string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace("%", '', $string);
	$string = str_replace("_", '', $string);
	$string = str_replace(".", '', $string);
	$string = str_replace("..", '', $string);
	$string = str_replace(",", '', $string);
	$string = str_replace(" ", '', $string);
	return $string;
}

?>
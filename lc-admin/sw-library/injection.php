<?PHP
function anti_sql_injection($string) {
$string = str_replace("'", " ", $string);
$string = str_replace('"', ' ', $string);
$string = str_replace('=', ' ', $string);
$string = str_replace('}', ' ', $string);
$string = str_replace('{', ' ', $string);
$string = str_replace('[', ' ', $string);
$string = str_replace(']', ' ', $string);
$string = str_replace('?', ' ', $string);
$string = str_replace('!', ' ', $string);
$string = str_replace('$', ' ', $string);
$string = str_replace('#', ' ', $string);
$string = str_replace('%', ' ', $string);
$string = str_replace('*', ' ', $string);
$string = str_replace(')', ' ', $string);
$string = str_replace('(', ' ', $string);
$string = str_replace('~', ' ', $string);
$string = str_replace('-', ' ', $string);
$string = str_replace('+', ' ', $string);
$string = str_replace('|', ' ', $string);
$string = str_replace('>', ' ', $string);
$string = str_replace('<', ' ', $string);
$string = str_replace('^', ' ', $string);
$string = stripslashes($string);
$string = strip_tags($string);
$string =stripslashes(strip_tags(htmlspecialchars($string)));
return $string;
}
?>
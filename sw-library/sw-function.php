<?php error_reporting(0);
@session_start();
date_default_timezone_set('Asia/Jakarta');
$date     = DATE('Y-m-d');
$day      = DATE('d');
$day_en   = DATE('l');
$month_en = DATE('F');
$year     = DATE('Y');
$time     = DATE('H:i:s');
$timeNow  = DATE('Y-m-d H:i:s');

function ubah_tgl2($tanggal) {
   $pisah   = explode('-',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('/',$larik);
   return $satukan;
}

function hari(){
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari     = date("w");
$hari_ini = $seminggu[$hari];
return $hari_ini;
}

function hari_in(){
 $today_in = hari().", ".tgl_indo(date('Y-m-d'));
 return $today_in;
}

function hari_en(){
 $today_en = date('l').", ".date('F')." ".date('d').", ".date('Y');
 return $today_en;
}

$tgl_sekarang = date("Ymd");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

$tanggal=date("Y-m-d");
$tgl_jam = date("Y-m-d H:i:s");

function jam_id($tgl){
  $tanggal = substr($tgl,11,5);
  return $tanggal;
}

function jam_indo($timeNow){
  $tgl_jam = substr($timeNow,11,8);
  return $tgl_jam;
}


// 14 Maret 2014
function tgl_indo($tgl){
  $tanggal = substr($tgl,8,2);
  $bulan   = ambilbulan(substr($tgl,5,2));
  $tahun   = substr($tgl,0,4);
  return $tanggal.' '.$bulan.' '.$tahun;
}
function tgl_ind($tgl){
  $tanggal = substr($tgl,8,2);
  $bulan   = ambil_bulan(substr($tgl,5,2));
  $tahun   = substr($tgl,0,4);
  return $tanggal.' '.$bulan.' '.$tahun;
}

function tanggal_ind($tanggal) {
   $pisah   = explode('-',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('-',$larik);
   return $satukan;
}

function tanggal_en($tanggal) {
   $pisah   = explode('-',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('-',$larik);
   return $satukan;
}

function ambilbulan($bln){
  if     ($bln=="01") return "Januari";
  elseif ($bln=="02") return "Februari";
  elseif ($bln=="03") return "Maret";
  elseif ($bln=="04") return "April";
  elseif ($bln=="05") return "Mei";
  elseif ($bln=="06") return "Juni";
  elseif ($bln=="07") return "Juli";
  elseif ($bln=="08") return "Agustus";
  elseif ($bln=="09") return "September";
  elseif ($bln=="10") return "Oktober";
  elseif ($bln=="11") return "November";
  elseif ($bln=="12") return "Desember";
}

function ambil_bulan($bln){
  if ($bln=="01") return "Jan";
  elseif ($bln=="02") return "Feb";
  elseif ($bln=="03") return "Mar";
  elseif ($bln=="04") return "Apr";
  elseif ($bln=="05") return "Mei";
  elseif ($bln=="06") return "Jun";
  elseif ($bln=="07") return "Jul";
  elseif ($bln=="08") return "Agu";
  elseif ($bln=="09") return "Sep";
  elseif ($bln=="10") return "Okt";
  elseif ($bln=="11") return "Nov";
  elseif ($bln=="12") return "Des";
}

function ubah_tgl($tanggal) {
   $pisah   = explode('/',$tanggal);
   $larik   = array($pisah[2],$pisah[1],$pisah[0]);
   $satukan = implode('-',$larik);
   return $satukan;
}

function current_date(){
  $tGL=date("Y-m-d");
  $jam=date("H:i:s");
  $tgljam=$tGL." ".$jam;
  return "$tgljam";
}

function getformat($tGl){
$pisah   = explode(' ',$tGl);
$aray = array($pisah[0]);
$get = format_indo($aray);
return $get;
}

function jam($jam) {
   $pisah   = explode(':',$jam);
   $larik   = array($pisah[0],$pisah[1]);
   $satukan = implode(':',$larik);
   return $satukan;
}


function format_angka($angka) {
    $hasil =  number_format($angka,0, ",",".");
    return $hasil;
}

function format_nomer($angka2) {
    $hasil2 =  number_format($angka2,3, ".",",");
    return $hasil2;
}


function time_since($original)
{
  date_default_timezone_set('Asia/Jakarta');
  $chunks = array(
      array(60 * 60 * 24 * 365, 'tahun'),
      array(60 * 60 * 24 * 30, 'bulan'),
      array(60 * 60 * 24 * 7, 'minggu'),
      array(60 * 60 * 24, 'hari'),
      array(60 * 60, 'jam'),
      array(60, 'menit'),
  );
 
  $today = time();
  $since = $today - $original;
 
  if ($since > 604800)
  {
    $print = date("M jS", $original);
    if ($since > 31536000)
    {
      $print .= ", " . date("Y", $original);
    }
    return $print;
  }
 
  for ($i = 0, $j = count($chunks); $i < $j; $i++)
  {
    $seconds = $chunks[$i][0];
    $name = $chunks[$i][1];
 
    if (($count = floor($since / $seconds)) != 0)
      break;
  }
 
  $print = ($count == 1) ? '1 ' . $name : "$count {$name}";
  return $print . ' yang lalu';
}

/* ------------- Konversi berat ------------------------ */

function formatSizeUnits($berat)
    {
      if ($berat >= 1000)
        {
            $berat =$berat / 1000 . ' Kg';
        }

      elseif ($berat >= 999)
        {
            $berat = $berat / 999 . ' Gg';
        }
        elseif ($berat >= 900)
        {
            $berat = $berat / 900 . ' Gram';
        }
        elseif ($berat > 1)
        {
            $berat= $berat . ' Gram';
        }
        elseif ($berat == 1)
        {
            $berat = $berat . ' Gram';
        }
        else
        {
            $berat = '0 Gram';
        }
 
        return $berat;
} 

function timezoneList(){
    $timezoneIdentifiers = DateTimeZone::listIdentifiers();
    $utcTime = new DateTime('now', new DateTimeZone('UTC'));
    $tempTimezones = array();
    foreach($timezoneIdentifiers as $timezoneIdentifier){
        $currentTimezone = new DateTimeZone($timezoneIdentifier);
        $tempTimezones[] = array(
            'offset' => (int)$currentTimezone->getOffset($utcTime),
            'identifier' => $timezoneIdentifier
        );
    }
    function sort_list($a, $b){
        return ($a['offset'] == $b['offset'])
            ? strcmp($a['identifier'], $b['identifier'])
            : $a['offset'] - $b['offset'];
    }
    usort($tempTimezones, "sort_list");
    $timezoneList = array();
    foreach($tempTimezones as $tz){
        $sign = ($tz['offset'] > 0) ? '+' : '-';
        $offset = gmdate('H:i', abs($tz['offset']));
        $timezoneList[$tz['identifier']] = '(UTC ' . $sign . $offset . ') ' .
            $tz['identifier'];
    }
    return $timezoneList;
}

function anti_injection($data){
  $filter  = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
  return $filter;
}

function _goto($location){
  header('location:'.$location);
}

function _gotoprocess($mod){
  echo "sw-mod/$mod/proses.php";
}

$plug         = "sw-assets/global/plugins/";
$globalcss    = "sw-assets/global/css/";
$layoutcss    = "sw-assets/admin/layout/css/";
$globalplug   = "sw-assets/global/plugins/";
$globalscript = "sw-assets/global/scripts/";
$layoutscript = "sw-assets/admin/layout/scripts/";
$pagesScript  = "sw-assets/admin/pages/scripts/";


// function untuk menyensor kata dari inputan pesan
function sensor_kata($sw_filter){
$sw_filter = ereg_replace ("jelek","**", $sw_filter);
$sw_filter = ereg_replace ("tai","**", $sw_filter);
$sw_filter = ereg_replace ("penipu","**", $sw_filter);
$sw_filter = ereg_replace ("nipu","**", $sw_filter);
$sw_filter = ereg_replace ("bohong","**", $sw_filter);
return $sw_filter;}

function get_parse_ini($file)
{   // if cannot open file, return false
    if (!is_file($file))
        return false;
    $ini = file($file);
    // to hold the categories, and within them the entries
    $cats = array();
    foreach ($ini as $i) {
        if (@preg_match('/\[(.+)\]/', $i, $matches)) {
            $last = $matches[1];
        } elseif (@preg_match('/(.+)=(.+)/', $i, $matches)) {
            $cats[$last][trim($matches[1])] = trim($matches[2]);
        }
    }
    return $cats;
}
function put_ini_file($file, $array, $i = 0){
  $str="";
  foreach ($array as $k => $v){
    if (is_array($v)){
      $str.=str_repeat(" ",$i*2)."[$k]\r\n";
      $str.=put_ini_file("",$v, $i+1);
    }else
      $str.=str_repeat(" ",$i*2)."$k = $v\r\n";
  }
  $phpstr = "<?PHP\r\n/*\r\n".$str."*/\r\n?>"; 
 if($file)
    return file_put_contents($file,$phpstr);
  else
    return $str;
}


function _e($s){
  if(!isset($_SESSION['lang'])){
    $lang = 'en-US';
  }else{
    $lang = @$_SESSION['lang'];
  }
  $fl = "../sw-library/lang/$lang/$lang.json";
  if(file_exists($fl)){
    $dict = @file_get_contents($fl);
    $object_dict = json_decode($dict);
    $found = false;
    for($i=0; $i < count($object_dict->dictionary); $i++){
      $dt = $object_dict->dictionary;
      if($dt[$i]->f == $s){
        $found = true;
        return $dt[$i]->t;
        exit;
      }
    }
    if(!$found){
      return $s;
    }
  }
}

class SwValidasi{
  function __construct(){}
  function xss($str){
    $str = htmlspecialchars($str);
    return $str;
  }
  function sql($str){
    $rms = array("'","`","=",'"',"@","<",">","*");
    $str = str_replace($rms, '', $str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
  }
}

function _pisah($x){
	$a = explode('_',$x);
	$b = array($a[0],$a[1]);
	$c = implode(' ',$b);
	$d = ucwords($c);
	return $d;
}

function seo_title($s){
  $c = array (' ');
  $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
  $s = str_replace($d, '', $s);
  $s = strtolower(str_replace($c, '-', $s));
  return $s;
}

function filterurl($s){
  $c = array (' ');
  $d = array ('?sw=error','?sw=success','?sw=success?sw=success','?sw=error','?sw=error','?sw=success?sw=error','?sw=error?sw=success');
  $s = str_replace($d, '', $s);
  //$s = strtolower(str_replace($c, '-', $s));
  return $s;
}

function minify_html($string){
  $string = preg_replace('/<!--(?!\[if|\<\!\[endif)(.|\s)*?-->/', '', $string);
  $string = preg_replace('/\t+/', '', $string);
  $string = preg_replace('/\n+/', '', $string);
  $string = preg_replace('/>\r+/', '>', $string);
  $string = preg_replace('/\r+</', '<', $string);
  $string = preg_replace('/>\s+</', '><', $string);
  return $string;
}
function minify_js($buffer){
  $buffer = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $buffer);
  $buffer = str_replace(array("\r\n","\r","\t","\n",'  ','    ','     '), '', $buffer);
  $buffer = preg_replace(array('(( )+\))','(\)( )+)'), ')', $buffer);
  return $buffer;
}

$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari     = date("w");
$hari_ini = $seminggu[$hari]; // konversi menjadi hari bahasa indonesia


function cuthighlight ($option, $data, $long){
    $content = $data;
    if ($option == "post"){
      $content = html_entity_decode($content);
      $content = strip_tags($content);
      $content = substr($content,0,$long);
      $content = substr($content,0,strrpos($content," "));
    }else{
      $content = substr($content,0,$long);
    }
    return $content;
  }
function cutContent($option, $data, $long){
  $content = $data;
  if ($option == "post"){
    $content = html_entity_decode($content);
    $content = strip_tags($content);
    $content = substr($content,0,$long);
    $content = substr($content,0,strrpos($content," "));
  }else{
    $content = substr($content,0,$long);
  }
  return $content;
}


function json(Array $a){
  /**
   * Json function, to put clear data respone.
   * @since 1.1.3-dev
   */
  echo json_encode($a);
  exit;
}
function result(Array $a, $result = 'r'){
  /**
   * Mixing json and showing manual redirect if javascript fail to load.
   * @since 1.1.3-dev
   * @param r = redirect, j = json
   */

  if($result == 'j'){
    json($a);
  }else{
    // set session first
    @$_SESSION['msg'] = $a['msg_ses'];
    // update for new message displayed, effective way
    @$_SESSION['msg_code'] = $a['msg_ses'];
    @$_SESSION['msg_content'] = $a['msg'];
    @$_SESSION['msg_icon'] = @$a['msg_icon'];
    // error code (for bootstrap)
    if($a['status'] == 'ok'){
      @$_SESSION['msg_type'] = 'success';
    }
    else if($a['status'] == 'error'){
      @$_SESSION['msg_type'] = 'warning';
    }
    else if($a['status'] == 'danger'){
      @$_SESSION['msg_type'] = 'danger';
    }

    // only if red set
    if(!empty($a['red'])){
      header('location: '.@$a['red']);
      exit;
    }
  }
  //exit;
}
function get_message($class = 'depth-xs note note-%msg_type%'){

  // debug
  $debug = false;

  // unset
  if(isset($_GET['msg_close'])){
    msg_close();
  }

  // replace
  $class = str_replace('%msg_type%', @$_SESSION['msg_type'], $class);
  $msg_icon = (isset($_SESSION['msg_icon']) ? '<i class="'.$_SESSION['msg_icon'].'"></i>&nbsp;&nbsp;': '');

  // if set
  if(isset($_SESSION['msg'])){
    printf('<div class="%s" id="%s">%s%s<a href="%s&msg_close" class="btn btn-xs pull-right"><i class="fa fa-times"></i>&nbsp;%s</a></div>', $class, @$_SESSION['msg_code'], $msg_icon, @$_SESSION['msg_content'], get_url('current'), __('Close'));
    // close it
    msg_close();
  }
}
function msg_close(){
  // close function
  unset($_SESSION['msg']);
  unset($_SESSION['msg_type']);
  unset($_SESSION['msg_code']);
  unset($_SESSION['msg_icon']);
  unset($_SESSION['msg_content']);
  unset($_SESSION['msg_type']);
}
function showAlert(){
  /**
   * Show alert message.
   * new version : support non javascript browser.
   * @since 1.1.3-beta-3
   */
  if(!empty($_SESSION['msg_code'])){
    echo '<div class="note note-'.$_SESSION['msg_type'].'">'.$_SESSION['msg_content'].'</div>';
  }
  // release
  $_SESSION['msg_code'] = '';
  $_SESSION['msg_type'] = '';
  $_SESSION['msg_content'] = '';
}
function UploadImage($fupload_name = null, $folder = null, array $quality = NULL){
  /**
   * Upload image and compress them.
   * @since 1.0.0
   */
  // debug
  $debug = false;

  $vdir_upload = "../../../sw-content/upload/$folder/";

  $vfile_upload = $vdir_upload . $fupload_name;

  // set
  //set_error_handler("custom_error");

  // check directory writeable
  if(!is_writeable(root_uri().str_replace('../../../','', $vdir_upload))){
    // // set error return
    // $return = [
    //   "error" => [
    //     "code"    => "permission_denied",
    //     "message" => __('Failed while uploading image, permission denied.')
    //   ]
    // ];
  }else{
    // move uploaded
    if(!@move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload)){
      // // give error space dude
      // $error_msg = __('Failed while processing image.');
      // // set error return
      // $return = [
      //   "error" => [
      //     "code"    => "failed_moving_image",
      //     "message" => __('Failed while moving image to specifict directory.')
      //   ]
      // ];
      // new result function
      /*
      result(array(
        'status' => 'error',
        'title' => lg('Error'),
        'msg' => lg('Failed to processing uploaded image. Contact adminisitrator.'),
        'msg_ses' => 'failed_processing',
        'red' => ''
      ), 'j');*/
    }else{
      // compress to all size
      if(empty($quality)){
        // compress
        // 1280px ~ 90%
        resize(1280,$vdir_upload . "hd-" . $fupload_name,$vfile_upload, 90);
        // 300px ~ 80%
        resize(300,$vdir_upload . "md-" . $fupload_name,$vfile_upload, 80);
        // 100px  ~ 40%
        resize(100,$vdir_upload . "sm-" . $fupload_name,$vfile_upload, 40);
        // 50px ~ 30%
        resize(50,$vdir_upload . "xs-" . $fupload_name,$vfile_upload, 30);
      }else{
        // compress to spesific size only
        if(in_array('hd', $quality)){
          // 1280px ~ 90%
          resize(1280,$vdir_upload . "hd-" . $fupload_name,$vfile_upload, 90);
        }
        if(in_array('md', $quality)){
          // 300px ~ 80%
          resize(300,$vdir_upload . "md-" . $fupload_name,$vfile_upload, 80);
        }
        if(in_array('sm', $quality)){
          // 100px  ~ 40%
          resize(100,$vdir_upload . "sm-" . $fupload_name,$vfile_upload, 40);
        }
        if(in_array('xs', $quality)){
          // 50px ~ 30%
          resize(50,$vdir_upload . "xs-" . $fupload_name,$vfile_upload, 30);
        }
      }
    }
  }

  if($debug){
    var_dump(@$return['error']['message'].' '.sprintf(__('Filename: %s, Uplaod Path: %s,  Module: %s, Compression: %s, Uploaded: %s'), @$fupload_name, @$vfile_upload, @$mod, var_dump(@$quality), var_dump(@$ok)));
    exit;
  }else{
    return $return;
  }
}

 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
function resize($newWidth, $targetFile, $originalFile, $quality) {
    $info = getimagesize($originalFile);
    $mime = $info['mime'];
    switch ($mime) {
            case 'image/jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    $new_image_ext = 'jpg';
                    break;

            case 'image/png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    $new_image_ext = 'png';
                    break;

            case 'image/gif':
                    $image_create_func = 'imagecreatefromgif';
                    $image_save_func = 'imagegif';
                    $new_image_ext = 'gif';
                    break;

            default:
                    throw Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
            unlink($targetFile);
    }
    $image_save_func($tmp, "$targetFile", $quality);
}
function UploadFile($fupload_name,$mod){
  /**
   * Upload a file.
   * @since 1.0.0
   */
  $vdir_upload = "../../../elybin-file/$mod/";
  $vfile_upload = $vdir_upload . $fupload_name;

  move_uploaded_file($_FILES["file"]["tmp_name"], $vfile_upload);
}

function root_uri($sring_result = true){
  /**
   * Count how many directory transversal needed
   * @since 1.1.3
   */
  // current dir
  $current_url = @getcwd();
  $current_url = str_replace("\\","/", $current_url);
  $strpos = strpos($current_url, "sw-admin26");
  $home_url = substr($current_url, 0, $strpos);

  return $home_url;
}

function uploadMedia($fupload_name){
  $vdir_upload  = "../../../sw-content/media/";
  $vfile_upload = $vdir_upload . $fupload_name;

  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  $im_src     = imagecreatefromjpeg($vfile_upload);
  $src_width  = imageSX($im_src);
  $src_height = imageSY($im_src);

  $dst_width  = 390;
  $dst_height = ($dst_width/$src_width)*$src_height;
  $im         = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
  imagejpeg($im,$vdir_upload . "medium-" . $fupload_name);

  imagedestroy($im_src);
  imagedestroy($im);
}

function getBrowser()
{
    $u_agent  = $_SERVER['HTTP_USER_AGENT'];
    $bname    = 'Unknown';
    $platform = 'Unknown';
    $version  = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub    = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub    = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub    = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub    = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub    = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub    = "Netscape";
    }

    // finally get the correct version number
    $known   = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'   => $pattern,
        'browser'   => $ub
    );
}

$salt = '$%DSuTyr47542@#&*!=QxR094{a911}+';

function epm_encode($id){
  $a   = array("0","1","2","3","4","5","6","7","8","9");
  $b   = array("Plz","OkX","Ijc","UhV","Ygb","TfN","RdZ","Esx","WaC","Qmv");
  $r   = str_replace($a, $b, $id);
  $enc = rand(10,99).base64_encode(base64_encode($r));
  return $enc;
}
function epm_decode($enc) {
  $tr  = substr($enc,2,strlen($enc));
  $str = base64_decode(base64_decode($tr));
  $b   =  array("Plz","OkX","Ijc","UhV","Ygb","TfN","RdZ","Esx","WaC","Qmv");
  $a   = array("0","1","2","3","4","5","6","7","8","9");
  $id  = str_replace($b, $a, $str);
  if(!preg_match("/^[0-9]+$/", $id)){
    $id = 0;
  }
  return $id;
}

function deleteDir($dirname){
  // Sanity check
    if (!file_exists($dirname)){
        return false;
    }
    // Simple delete for a file
    if (is_file($dirname) || is_link($dirname)){
        return unlink($dirname);
    }
    // Create and iterate stack
    $stack       = array($dirname);
    while($entry = array_pop($stack)){
        // Watch for symlinks
        if (is_link($entry)){
            unlink($entry);
            continue;
        }
        // Attempt to remove the directory
        if (@rmdir($entry)){
            continue;
        }
        // Otherwise add it to the stack
        $stack[] = $entry;
        $dh      = opendir($entry);
        while(false !== $child = readdir($dh)){
            // Ignore pointers
            if ($child === '.' || $child === '..') {
                continue;
            }
            // Unlink files and add directories to stack
            $child = $entry . DIRECTORY_SEPARATOR . $child;
            if (is_dir($child) && !is_link($child)) {
                $stack[] = $child;
            } else {
                unlink($child);
            }
        }
        closedir($dh);
    }
    return true;
}

function set(){
  // get options
  $tbso   = new ElybinTable('elybin_options');
  // this is all information
  $option = array('main_cms' => "Elybin CMS");
  // option
  $getop  = $tbso->Select('','');
  foreach ($getop as $sop) {
    $option = array_merge($option, array($sop->name => $sop->value));
  }
  // convert array to object
  $op = new stdClass();
  foreach ($option as $key => $value)
  {
      $op->$key = $value;
  }

  //ret
  return $op;
}
$availableAdTheme = array(1=>"night", "amethyst", "modern", "autumn", "flatie", "spring", "fancy", "fire", "siger");
function getAvailableAdTheme(){
    $outt = "";
    while(list($key,$adThemeId) = each($GLOBALS['availableAdTheme'])){
        $adThemeLib = ($GLOBALS['adThemeTranslated'][$adThemeId])? $GLOBALS['adThemeTranslated'][$adThemeId] : $adThemeId;
        $outt .= '<option value="'.$key.'"'.(($GLOBALS['localAdTheme']==$adThemeId)? ' selected="selected"' : '' ).'>'.$adThemeLib.'</option>'."\n";
    }
    return $outt;
}


<?php 
/**
* @version    2.0
* @package    Fiyo CMS
* @copyright  Copyright (C) 2014 Fiyo CMS.
* @license    GNU/GPL, see LICENSE.txt
**/

session_start();
if(!isset($_SESSION['login'])){
}else{
require_once ('../../../system/jscore.php');


$online = angka(FQuery('statistic_online'));
$total = angka(FQuery('statistic'));

$dtf = date('Y-m-d 00:00:00');
$today = angka(FQuery('statistic',"time >= '$dtf'","","","time ASC"));

$dtf = date('Y-m-d 00:00:00',strtotime("-1 Months"));
$month = angka(FQuery('statistic',"time >= '$dtf'","","","time ASC"));
  
$timer = time() - 300;
$db->delete(FDBPrefix.'statistic_online',"time < $timer");

echo "
{ \"today\":\"$today\" , \"month\":\"$month\", \"total\":\"$total\", \"online\":\"$online\" }";

}

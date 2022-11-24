<?PHP if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location: ../login');
}else{
$gotoprocess = "sw-mod/home/proses.php";
require_once('../sw-library/sw-function.php');

//post
$post=mysqli_query($connection,"SELECT post_id from post"); 
$count_post = mysqli_num_rows($post);
// user
$user=mysqli_query($connection,"SELECT user_id from user"); 
$count_user = mysqli_num_rows($user);
// Kategori
$category=mysqli_query($connection,"SELECT product_id from product"); 
$count_cat = mysqli_num_rows($category);
// tag
$tags=mysqli_query($connection,"SELECT id from tags"); 
$count_tags = mysqli_num_rows($tags);
// halaman
$pages=mysqli_query($connection,"SELECT page_id from page"); 
$count_pages = mysqli_num_rows($pages);

//pesan
$pesan=mysqli_query($connection,"SELECT msg_id from message"); 
$count_pesan = mysqli_num_rows($pesan);

// Product
$product=mysqli_query($connection,"SELECT product_id from product"); 
$count_product = mysqli_num_rows($product);

 ?>
<!-- Page content -->
    <div class="content-header">
        <div class="header-section"> 
            <div class="row">
<div class="col-md-12">
<?php $iB = getBrowser(); 
if($icon = $iB['browser'] == 'Firefox'){
$icon='<i class="fa fa-firefox"></i>';}
elseif($iB['browser'] == 'Chrome'){
$icon='<i class="fa fa-chrome"></i>';    
}
elseif($iB['browser'] == 'MSIE'){
$icon='<i class="fa fa-ie"></i>';
}
elseif($iB['browser'] == 'Opera'){
$icon='<i class="fa fa-opera"></i>';  
}
else{
$icon='<i class="gi gi-riflescope"></i>';   
}
echo'
<div class="col-md-12">
<h1>'.$icon.''._e('Welcome').'<strong> '.$rows_login['fullname'].'</strong><br><small>'._e('Your Login Info:').' <span>'.$rows_login['browser'].' Ip '.$rows_login['ip'].'</span></small></h1>
</div>
</div>
</div>
</div>
</div>';?>


<div class="row">
<div class="col-sm-6 col-lg-3">
<a href="?mod=post" class="widget widget-hover-effect1">
<div class="widget-simple">
<div class="widget-icon pull-left themed-background-default animation-fadeIn">
    <i class="fa fa-file-text"></i>
</div>
<h3 class="widget-content text-right animation-pullDown">
    <strong><?PHP echo _e('Post');?></strong><br>
<small><?PHP echo $count_post;?></small>
</h3>
</div>
</a>
</div> 

<div class="col-sm-6 col-lg-3">
<a href="?mod=product" class="widget widget-hover-effect1">
    <div class="widget-simple">
        <div class="widget-icon pull-left themed-background-amethyst animation-fadeIn">
            <i class="fa fa-shopping-bag"></i>
        </div>
        <h3 class="widget-content text-right animation-pullDown">
            <strong><?PHP echo _e('Product');?></strong>
           <small><?php echo $count_product;?></small>
        </h3>
    </div>
</a>
</div>


<div class="col-sm-6 col-lg-3">
<a href="?mod=user" class="widget widget-hover-effect1">
    <div class="widget-simple">
        <div class="widget-icon pull-left themed-background-fire animation-fadeIn">
            <i class="gi gi-group"></i>
        </div>
        <h3 class="widget-content text-right animation-pullDown">
            <strong><?php echo _e('User');?></strong><br>
           <small><?php echo $count_user;?></small>
        </h3>
    </div>
</a>
</div>

<div class="col-sm-6 col-lg-3">
<a href="?mod=tag" class="widget widget-hover-effect1">
    <div class="widget-simple">
        <div class="widget-icon pull-left themed-background-modern animation-fadeIn">
            <i class="gi gi-tags"></i>
        </div>
        <h3 class="widget-content text-right animation-pullDown">
            <strong><?php echo _e('Tags');?></strong>
          <small><?php echo $count_tags;?></small>
        </h3>
    </div>
</a>
</div>

<div class="col-sm-6 col-lg-3">
<a href="?mod=page" class="widget widget-hover-effect1">
    <div class="widget-simple">
        <div class="widget-icon pull-left themed-background-fancy animation-fadeIn">
            <i class="fa fa-file-o"></i>
        </div>
        <h3 class="widget-content text-right animation-pullDown">
            <strong><?php echo _e('Page');?></strong>
        <small><?php echo $count_pages;?></small>
        </h3>
    </div>
</a>
</div> 

<div class="col-sm-6 col-lg-3">
<a href="?mod=testimoni" class="widget widget-hover-effect1">
    <div class="widget-simple">
        <div class="widget-icon pull-left themed-background-fancy animation-fadeIn">
         <i class="fa fa-gears"></i>
        </div>
        <h3 class="widget-content text-right animation-pullDown">
            <strong><?php echo _e('Setting');?></strong>
        </h3>
    </div>
</a>
</div> 

<div class="col-sm-6 col-lg-3">
<a href="?mod=slider" class="widget widget-hover-effect1">
    <div class="widget-simple">
        <div class="widget-icon pull-left themed-background-autumn animation-fadeIn">
            <i class="fa fa-folder-open"></i>
        </div>
        <h3 class="widget-content text-right animation-pullDown">
            <strong><?php echo _e('Slider');?></strong>
        </h3>
    </div>
</a>
</div>

<div class="col-sm-6 col-lg-3">
<a href="?mod=message" class="widget widget-hover-effect1">
    <div class="widget-simple">
        <div class="widget-icon pull-left themed-background-fancy animation-fadeIn">
         <i class="fa fa-envelope-o"></i>
        </div>
        <h3 class="widget-content text-right animation-pullDown">
            <strong><?php echo _e('Message');?></strong>
        <small><?php echo $count_pesan;?></small>
        </h3>
    </div>
</a>
</div> 

</div>


<?php echo'
<div class="row">
<div class="col-md-12">
<div class="block">
<div class="block-title">
<h3>'._e('Color Theme').'</h3>
</div>
<form action="'.$gotoprocess.'" method="post" class="form-horizontal form-bordered">
<div class="form-group">
<label class="col-md-3 control-label">'._e('Theme').'</label>
<div class="col-md-9">
<input type="hidden" name="modul" value="home">
<input type="hidden" name="aksi" value="adtheme">
<select class="select-chosen" name="adtheme" onChange="submit()">';
$query_color="SELECT id,name from colortheme";
$result_color=$connection->query($query_color);
while($row_color = $result_color->fetch_assoc()){
if($rows_login['colortheme'] == $row_color['id']){
echo'<option value="'.$row_color['id'].'" selected>'.$row_color['name'].'</option>';
}else {
echo'<option value="'.$row_color['id'].'">'.$row_color['name'].'</option>';
}}
echo'
</select>
</div>
</div>
</form>
</div>
</div>';?>

    <?php 
    $date = date("d-m-Y",strtotime("-6 days"));
    $D = substr($date,0,2);
    $M = substr($date,3,2)-1;
    $Y = substr($date,6,4);
    $tgl_skrg = date("Y-m-d");
    $seminggu = strtotime("-1 week +1 day",strtotime($tgl_skrg));
    $hasilnya = date('Y-m-d', $seminggu);
    //visitor
    for ($i=0; $i<=6; $i++){
      $tgl_pengujung   = strtotime("+$i day",strtotime($hasilnya));
      $hasil_pengujung = date("Y-m-d", $tgl_pengujung);
      $table="SELECT ip from statistic where tanggal ='$hasil_pengujung' group by ip";
      $result=$connection->query($table);
      $num = mysqli_num_rows($result);
      $allVisitor []= $num;
    }

    // hits
    for ($i=0; $i<=6; $i++){
      $tgl_hits   = strtotime("+$i day",strtotime($hasilnya));
      $hasil_hits = date('Y-m-d', $tgl_hits);
   $query_hits="SELECT hits FROM statistic where tanggal='$hasil_hits'"; 
   $result = $connection->query($query_hits);
   if($result->num_rows > 0){
   $row= $result->fetch_assoc();
    $hits_today[] = $row['hits'];
   } else{
    $hits_today[] =0;
   }
}

    // implode visitor
    $allVisitor = implode(',',$allVisitor);
    // implode hits
    $hits_today = implode(',',$hits_today); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="block full">
                <div class="block-title">
                    <h3><?=_e('Visitor Statistic')?></h3>
                </div>
                <div id="statistic"><div class="loading">Loading...</div></div>
            </div>
        </div>
    </div>

    <script>
    $(function () {
        var chart;
        var hits = [<?php echo "$hits_today"; ?>];
        var visitor = [<?php echo "$allVisitor"; ?>];
        $('#statistic').highcharts({
            chart: {renderTo: 'statistic',type: 'area',},
            colors: ['#009ae1', '#15aa00'],
            title: {text: ''},
            xAxis: {type: 'datetime',labels: {overflow: 'justify'}},
            yAxis: {title: {text: null},},
            tooltip: {valueSuffix: null,shared: true,},
            plotOptions: {area: {lineWidth: 3,states: {hover: {lineWidth: 3,}},
            marker: {fillColor: '#FFFFFF',lineWidth: 2,radius: 4,symbol : 'circle',lineColor: null},
            pointInterval: 3600000*24, // one hour
            pointStart: Date.UTC( <?php echo $Y;?>,  <?php echo $M;?>, <?php echo $D;?>, 0, 0, 0)},
            series: {fillOpacity: 0.05,},},
            credits: {enabled: false},
            series: [{name: 'Hits',data: hits}, {
            name: 'Uniqeu Visitor',data: visitor}],
            navigation: {menuItemStyle: {fontSize: '10px'}}
        });
    });
    </script>

<?php } 

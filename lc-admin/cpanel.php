<?php
function theme_head(){
require_once'../sw-library/sw-function.php';
    define("START_EXEC", microtime());
require_once'../sw-library/config.php';
require_once'./login/login_session.php';?>
<?PHP }?>
<?PHP function theme_foot(){ 
if(!empty($_GET['mod'])){ 
$mod = $_GET['mod'];}
else {
$mod ='';}?>

<footer class="clearfix">
<div class="pull-right">
<?php $memory  = ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB';
echo round(((microtime()-START_EXEC)/60),5).' sec / '.$memory ?>
</div>
<div class="pull-left">
<span>2021 - <?php echo DATE('Y');?></span> &copy; <span id="credits"><a class='credits_a' href="https://yusronwirawan.me" target="_blank">Lina Dwi Jayanti Developer</a></span>
</div>
<div id="alertalldel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i> Remove Items</h4>
    </div>
    <div class="modal-body">Are Your Sure ?</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" id="confirmdel"><i class="fa fa-trash-o"></i> Remove</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> Batal</button>
    </div>
</div>
</div>
</div>
</footer>
</div>
</div>
<a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>
<?PHP require_once'./sw-assets/js.php';?>
    </body>
</html><?PHP }?>
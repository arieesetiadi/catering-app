<?php
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
    header('location:./login');
}else{
$message='';
if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}
$gotoprocess = "sw-mod/$mod/proses.php";
$query_role = "SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='1' AND level_id='$level_user'"; 
if($result_role->num_rows > 0){
$result_role = $connection->query($query_role);
$rows_akses= $result_role->fetch_assoc();
extract($rows_akses);

switch(@$_GET['op']){ default: ?>
<?php echo'<div class="content-header">
<div class="header-section">
<h1>
<i class="gi gi-book"></i>'._e('Module Management').'<br>
</h1>
</div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>'._e('Module Management').'</li>
</ul>';
if($read_access == 'Y'){
    echo'
    <div class="block full">
        <div class="block-title">
            <h2>'._e('Manajemen Module').'</h2>
            <div class="block-options pull-right">
                <div class="btn-group btn-group-sm">
                    <a href="#addModule" class="btn btn-sm btn-default enable-tooltip" title="Add" data-toggle="modal"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>';?>
        <?php

        /* Function menu_showNested
         * @desc Create inifinity loop for nested list from database
         * @return echo string
        */
    $host       = DB_HOST;      // Host name
    $username   = DB_USER;           // Mysql username
    $password   = DB_PASSWD;               // Mysql password
    $db_name    = DB_NAME;       // Mysql password
    $connection = mysqli_connect($host, $username, $password, $db_name);

        function menu_showNested($parentID) {
            global $connection;
            $sql = "SELECT * FROM module WHERE parent_id='$parentID' ORDER BY position";
            $result = mysqli_query($connection,$sql);
            $numRows = mysqli_num_rows($result);

            if ($numRows > 0) {
                echo "\n";
                echo "<ol class='dd-list'>\n";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "\n";
                        echo "<li class='dd-item dd3-item' data-id='{$row['module_id']}'>\n";
                            echo "<div class='dd-handle dd3-handle'></div><div class='dd3-content'><i class='{$row['icon']}'></i> "._e($row['displayname'])." <span class='pull-right'><a href='?mod=module&op=edit&id={$row['module_id']}'>Edit</a> | <a class='label label-danger alertdel' id='{$row['module_id']}'><i class='fa fa-trash-o'></i></a></span></div>\n";
                            menu_showNested($row['module_id']);
                        echo "</li>\n";
                    }
                echo "</ol>\n";
            }
        }

        ## Show the top parent elements from DB
        ######################################
        $sql = "SELECT * FROM module WHERE parent_id='0' ORDER BY position";
        $result = mysqli_query($connection,$sql);
        $numRows = mysqli_num_rows($result);

        echo "<div class='cf nestable-lists'>\n";
            echo "<div class='dd' id='nestableMenu'>\n\n";
                echo "<ol class='dd-list outer'>\n";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "\n";
                        echo "<li class='dd-item dd3-item' data-id='{$row['module_id']}'>";
                            echo "<div class='dd-handle dd3-handle'></div><div class='dd3-content'><i class='{$row['icon']}'></i> "._e($row['displayname'])." <span class='pull-right'><a href='?mod=module&op=edit&id={$row['module_id']}'>Edit</a> | <a class='label label-danger alertdel' id='{$row['module_id']}'><i class='fa fa-trash-o'></i></a></span></div>";
                        menu_showNested($row['module_id']);
                        echo "</li>\n";
                    }
                echo "</ol>\n\n";
            echo "</div>\n";
        echo "</div>\n\n";

        // // Feedback div for update hierarchy to DB
        // // IMPORTANT: This needs to be here! But you can remove the style
        echo "<div id='sortDBfeedback' style='border:1px solid #eaeaea; padding:10px; margin:15px;'></div>\n";

        // Script output for debuug
        echo "<textarea id='nestableMenu-output'></textarea>";
    ?>

    </div>
    <div id="alertdel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form id="form-delete" method="post" action="" autocomplete="off">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 id="modal-title"><i class="fa fa-exclamation-circle text-danger"></i> <?=_e('Deleted')?></h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="modul" value="module">
                        <input type="hidden" name="aksi" value="delete">
                        <input type="hidden" id="delid" name="id">
                        <?=_e('The Item will be deleted')?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> <?=_e('Delete')?></button>
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> <?=_e('Cancel')?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="addModule" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-validation" method="post" autocomplete="off">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title"><?=_e('Add Module')?></h3>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="modul" value="module">
                        <input type="hidden" name="aksi" value="add">
                        <div class="form-group">
                            <label><?=_e('Module Name')?></label>
                            <div>
                            <input class="form-control" type="text" name="modulename" placeholder="Type New Module Name here" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label><?=_e('Link')?></label>
                            <div>
                            <input class="form-control" type="text" name="link" placeholder="Type link Module here" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?=_e('Display Name')?></label>
                            <div>
                            <input class="form-control" type="text" name="displayname" placeholder="Type Dipslay Name here" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label><?=_e('Icon')?></label>
                            <div>
                            <input class="form-control" type="text" name="icon" placeholder="Type Module Icon here" value="gi gi-more_windows" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?=_e('Active')?></label>
                            <div>
                            <div class="row">
                            <div class="col-sm-6">
                                <label class='switch switch-primary'><input type='checkbox' name='active' checked><span></span></label>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submitAdd" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> <?=_e('Submit')?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
function lagXHRobjekt() {
    var XHRobjekt = null;

    try {
        ajaxRequest = new XMLHttpRequest(); // Firefox, Opera, ...
    } catch(err1) {
        try {
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP"); // Noen IE v.
        } catch(err2) {
            try {
                    ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP"); // Noen IE v.
            } catch(err3) {
                ajaxRequest = false;
            }
        }
    }
    return ajaxRequest;
}


function menu_updatesort(jsonstring) {
    mittXHRobjekt = lagXHRobjekt();

    if (mittXHRobjekt) {
        mittXHRobjekt.onreadystatechange = function() {
            if(ajaxRequest.readyState == 4){
                var ajaxDisplay = document.getElementById('sortDBfeedback');
                ajaxDisplay.innerHTML = ajaxRequest.responseText;
            } else {
                // Uncomment this an refer it to a image if you want the loading gif
                //document.getElementById('sortDBfeedback').innerHTML = "<img style='height:11px;' src='images/ajax-loader.gif' alt='ajax-loader' />";

            }
        }

        ajaxRequest.open("GET", "sw-mod/module/menuSortableSave.php?jsonstring=" + jsonstring + "&rand=" + Math.random()*9999, true);
        ajaxRequest.send(null);
    }
}

$(document).ready(function()
    {

        /* The output is ment to update the nestableMenu-output textarea
         * So this could probably be rewritten a bit to only run the menu_updatesort function onchange
        */
        // activate Nestable for list 1

        var updateOutput = function(e)
        {
            var list   = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                menu_updatesort(window.JSON.stringify(list.nestable('serialize')));


            } else {
                output.val('JSON browser support required for this demo.');
            }
        };

        // activate Nestable for list menu
        $('#nestableMenu').nestable({
            group: 1
        })
        .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestableMenu').data('output', $('#nestableMenu-output')));

        $('#nestable-menu').on('click', function(e)
        {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });

        $('#nestable3').nestable();

    });


</script>
<?php } else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';}?>

<!-- edit ==================================================== -->
<?php break; case 'edit': ?>
<?php
echo'<div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-book"></i>'._e('Module Management').'<br>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
        <li><a href="./?mod=module">'._e('Module Management').'</a></li>
        <li>'._e('Edit').'</li>
    </ul>';

if($modify_access == 'Y'){
    echo'
<div class="alert alert-danger fade in" style="display:';if($message==''){echo'none';} else {echo'display';}echo'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-times-circle"></i> '.$message.'</div>';

echo'
    <div class="block">';
if(!empty($_GET['id'])){
$id=  mysqli_real_escape_string($connection,$_GET['id']); 
$update = "SELECT * FROM module WHERE module_id='$id'";
$result_update = $connection->query($update) or die($connection->error.__LINE__);
if($result_update->num_rows > 0){
 while($rows= $result_update->fetch_assoc()){
extract($rows);
echo'
<form action="'.$gotoprocess.'" method="post" class="form-bordered">
            <input type="hidden" name="modul" value="module">
            <input type="hidden" name="aksi" value="edit">
            <input type="hidden" name="id" value="'.$module_id.'">
            <div class="form-group">
                <label>Nama Module</label>
                <input type="text" name="modulename" class="form-control" value="'.$modulename.'">
            </div>
            <div class="form-group">
                <label>Link</label>
                <input type="text" name="link" class="form-control" value="'.$link.'">
            </div>
            <div class="form-group">
                <label>Nama Tampilan</label>
                <input type="text" name="displayname" class="form-control" value="'.$displayname.'">
            </div>
            <div class="form-group">
                <label>Icon</label>
                <input type="text" name="icon" class="form-control" value="'.$icon.'">
            </div>
            <div class="form-group">
                <label>Aktif</label>
                <div class="row">
                    <div class="col-sm-6">';
            if($active=='Y')
            {echo "<label class='switch switch-primary'><input type='checkbox' name='active' checked><span></span></label>";
            } else
            {
            echo "<label class='switch switch-primary'><input type='checkbox' name='active'><span></span></label>";
            }
            echo'</div>
                </div>
            </div>
            <div class="form-group form-actions">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> '._e('Edit').'</button>
                <button type="button" class="btn btn-sm btn-warning pull-right" onclick="history.back();"><i class="fa fa-repeat"></i> '._e('Cancel').'</button>
            </div>
        </form>';}} else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Tidak ada yang bisa ditampilkan</p></div>';}}?>
    </div>

<?php } else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';}?>
<?php break; } }else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}}

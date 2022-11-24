<?php
@session_start();
if(empty($_SESSION['SESION_LOGIN']) && empty($_SESSION['SESION_USER'])){
header('location:../login/');
}else{
$message='';
if(!empty($_SESSION['message'])){$message = $_SESSION['message'];}
$gotoprocess = "sw-mod/$mod/proses.php";
$query_role = "SELECT read_access,write_access,modify_access,delete_access FROM user_role where module_id='6' AND level_id='$level_user'"; 

if($result_role->num_rows > 0){
$result_role = $connection->query($query_role);
$rows_akses= $result_role->fetch_assoc();
extract($rows_akses);
echo'<link href="sw-assets/css/menu.css" rel="stylesheet">';
switch(@$_GET['act']){
  default:?>
  <?php echo'
<div class="content-header">
<div class="header-section"><h1>Menu Manager</h1></div>
</div>
<ul class="breadcrumb breadcrumb-top">
<li><a href="./"><i class="fa fa-home"></i> '._e('Dashboard').'</a></li>
<li>Input, edit, view and delete menu management</li>
</ul>';
if($read_access == 'Y'){
    echo'
<div class="block full">
<div class="block-title"><h2>Menu Manager</h2></div>
<div class="row">
<div class="col-md-8 ul-menu"> 
<ul id="menu-group">';

        /* Function menu_showNested
         * @desc Create inifinity loop for nested list from database
         * @return echo string
        */
    $host       = DB_HOST;      // Host name
    $username   = DB_USER;           // Mysql username
    $password   = DB_PASSWD;               // Mysql password
    $db_name    = DB_NAME;       // Mysql password
    $connection = mysqli_connect($host, $username, $password, $db_name);
$query="SELECT * from menu_group";
$result=$connection->query($query);
while($row= $result->fetch_assoc()){
echo'
<li id="group-1">
<a href="./?mod='.$mod.'&group_id='.$row['id'].'">'.$row['title'].'</a>
</li>';}?>

<li id="add-group"><a href="#addgroup" data-toggle="modal" title="Add Menu Group">+</a></li>
</ul>
</div>
<div class="clearfix"></div>
<div class="col-md-8">

<div class="ns-row" id="ns-header">
	<div class="ns-actions">Actions</div>
	<div class="ns-class">Class</div>
	<div class="ns-url">URL</div>
	<div class="ns-title">Title</div>
</div>
<div class="clearfix"></div>

<?php if(!empty($_GET['group_id'])){
 $group_id = $_GET['group_id'];
function menu_showNested($parentID) {
	global $connection;
	$sql = "SELECT * FROM menu WHERE parent_id='$parentID' and group_id='$_GET[group_id]' ORDER BY position";
	$result = mysqli_query($connection,$sql);
	$numRows = mysqli_num_rows($result);

            if ($numRows > 0) {
                echo "\n";
                echo "<ol class='dd-list'>\n";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "\n";
                         echo "<li class='dd-item dd3-item' data-id='{$row['id']}'>";
                            echo "<div class='dd-handle dd3-handle'></div>
                            <div class='dd3-content'>
                            <div class='ns-title'>".substr($row['title'],0,15)."</div><div class='ns-url'> | ".substr($row['url'],0,20)."</div><div class='ns-class'> | ".$row['class']."</div>
                            <span class='pull-right'>"?>

 <a href="#edit_form" title="Edit" data-toggle="modal" onclick="getElementById('title').value='<?php echo $row['title'];?>';getElementById('url').value='<?php echo $row['url'];?>';getElementById('class').value='<?php echo $row['class'];?>';getElementById('id').value='<?php echo $row['id'];?>';getElementById('group_id').value='<?php echo $_GET['group_id'];?>';">Edit</a> | <?php echo"<a class='label label-danger' data-href='sw-mod/menumanager/proses.php?id=".$row['id']."&aksi=delete&group_id=".$_GET['group_id']."' data-toggle='modal' data-target='#hapus'><i class='fa fa-trash-o'></i></a></span></div>";
                            menu_showNested($row['id']);
                        echo "</li>\n";
                    }
                echo "</ol>\n";
            }
        }

        ## Show the top parent elements from DB
        ######################################
        $sql = "SELECT * FROM menu WHERE parent_id='0' and group_id='$_GET[group_id]' ORDER BY position";
        $result = mysqli_query($connection,$sql);
        $numRows = mysqli_num_rows($result);

      echo "<div class='cf'>\n";
            echo "<div class='dd' id='nestableMenu'>\n\n";
                echo "<ol class='dd-list outer'>\n";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "\n";
                        echo "<li class='dd-item dd3-item' data-id='{$row['id']}'>";
                            echo "<div class='dd-handle dd3-handle'></div><div class='dd3-content'> <div class='ns-title'>".substr($row['title'],0,15)."</div><div class='ns-url'> | ".substr($row['url'],0,20)."</div><div class='ns-class'> | ".$row['class']."</div><span class='pull-right'>"?>

 <a href="#edit_form" title="Edit" data-toggle="modal" onclick="getElementById('title').value='<?php echo $row['title'];?>';getElementById('url').value='<?php echo $row['url'];?>';getElementById('class').value='<?php echo $row['class'];?>';getElementById('id').value='<?php echo $row['id'];?>';getElementById('group_id').value='<?php echo $_GET['group_id'];?>';">Edit</a> | <?php echo"<a class='label label-danger' data-href='sw-mod/menumanager/proses.php?id=".$row['id']."&aksi=delete&group_id=".$_GET['group_id']."' data-toggle='modal' data-target='#hapus'><i class='fa fa-trash-o'></i></a></span></div>";
                        menu_showNested($row['id']);
                        echo "</li>\n";
                    }
                echo "</ol>\n\n";
            echo "</div>\n";
        echo "</div>\n\n";

        // // Feedback div for update hierarchy to DB
        // // IMPORTANT: This needs to be here! But you can remove the style
       // echo "<div id='sortDBfeedback' style='border:1px solid #eaeaea; padding:10px; margin:15px;'></div>\n";

        // Script output for debuug
      //  echo "<textarea id='nestableMenu-output'></textarea>";
    }
    else {
    	function menu_showNested($parentID) {
	global $connection;
	$sql = "SELECT * FROM menu WHERE parent_id='$parentID' and group_id='1' ORDER BY position";
	$result = mysqli_query($connection,$sql);
	$numRows = mysqli_num_rows($result);

            if ($numRows > 0) {
                echo "\n";
                echo "<ol class='dd-list'>\n";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "\n";
                         echo "<li class='dd-item dd3-item' data-id='{$row['id']}'>";
                            echo "<div class='dd-handle dd3-handle'></div>
                            <div class='dd3-content'>
                            <div class='ns-title'>".$row['title']."</div><div class='ns-url'> | ".$row['url']."</div><div class='ns-class'> | ".$row['class']."</div>
                            <span class='pull-right'>"?>

 <a href="#edit_form" title="Edit" data-toggle="modal" onclick="getElementById('title').value='<?php echo $row['title'];?>';getElementById('url').value='<?php echo $row['url'];?>';getElementById('class').value='<?php echo $row['class'];?>';getElementById('id').value='<?php echo $row['id'];?>';getElementById('group_id').value='1';">Edit</a> | <?php echo"<a class='label label-danger' data-href='sw-mod/menumanager/proses.php?id=".$row['id']."&aksi=delete' data-toggle='modal' data-target='#hapus'><i class='fa fa-trash-o'></i></a></span></div>";
                            menu_showNested($row['id']);
                        echo "</li>\n";
                    }
                echo "</ol>\n";
            }
        }

        ## Show the top parent elements from DB
        ######################################
        $sql = "SELECT * FROM menu WHERE parent_id='0' and group_id='1' ORDER BY position";
        $result = mysqli_query($connection,$sql);
        $numRows = mysqli_num_rows($result);

      echo "<div class='cf'>\n";
            echo "<div class='dd' id='nestableMenu'>\n\n";
                echo "<ol class='dd-list outer'>\n";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "\n";
                        echo "<li class='dd-item dd3-item' data-id='{$row['id']}'>";
                            echo "<div class='dd-handle dd3-handle'></div><div class='dd3-content'> <div class='ns-title'>".$row['title']."</div><div class='ns-url'> | ".$row['url']."</div><div class='ns-class'> | ".$row['class']."</div><span class='pull-right'>"?>

 <a href="#edit_form" title="Edit" data-toggle="modal" onclick="getElementById('title').value='<?php echo $row['title'];?>';getElementById('url').value='<?php echo $row['url'];?>';getElementById('class').value='<?php echo $row['class'];?>';getElementById('id').value='<?php echo $row['id'];?>';getElementById('group_id').value='1';">Edit</a> | <?php echo"<a class='label label-danger' data-href='sw-mod/menumanager/proses.php?id=".$row['id']."&aksi=delete' data-toggle='modal' data-target='#hapus'><i class='fa fa-trash-o'></i></a></span></div>";
                        menu_showNested($row['id']);
                        echo "</li>\n";
                    }
                echo "</ol>\n\n";
            echo "</div>\n";
        echo "</div>\n\n";
    }?>
</div>

<?php echo'<div class="col-md-4">
				<div class="box info">
					<h2>Info</h2>
					<section>
						<p>Drag the menu list to re-order, and click <b>Update Menu</b> to save the position.</p>
						<p>To add a menu, use the <b>Add Menu</b> form below.</p>
					</section>
				</div>
				<div class="box"><h2>Current Menu Group</h2>
			
					<section>
				<form id="validate" method="post" action="'.$gotoprocess.'">
				<input type="hidden" name="aksi" value="editgroup" readonly>
				<input type="hidden" name="modul" value="menumanager" readonly>
						<span id="edit-group-input">Main Menu</span>
						(ID: <b>';
					if(!empty($_GET['group_id'])){echo $group_id;
			echo'<input type="hidden" name="id" value="'.$group_id.'" readonly>';}
					else {echo'1';
			echo'<input type="hidden" name="id" value="1" readonly>';}
						echo'</b>)
						<div style="margin-top:5px;">';
						if(!empty($_GET['group_id'])){
				$query="SELECT * from menu_group where id='$_GET[group_id]'";
				$result = $connection->query($query);
				$row = $result->fetch_assoc();
				echo'
				<input class="form-control" type="text" name="title" value="'.$row['title'].'" required>';
			} else{
			$query="SELECT * from menu_group where id='1'";
			$result = $connection->query($query);
			$row = $result->fetch_assoc();
			echo'<input class="form-control" type="text" name="title" value="'.$row['title'].'" required>';}?>
			<br>
		<button type="submit" class="btn btn-sm btn-primary">Edit</button>
			</div>
			</form>
	</section>
	</div>
<?php echo'	<div class="box">
		<h2>Add Menu</h2>
		<section>
			<form class="form-bordered" id="form-add-menu" method="post" action="'.$gotoprocess.'">
			<input type="hidden" name="aksi" value="addmenu" readonly>
			<input type="hidden" name="modul" value="menumanager" readonly>';
			if(!empty($_GET['group_id'])){
			echo'<input type="hidden" name="id" value="'.$group_id.'" readonly>';}
			else {
			echo'<input type="hidden" name="id" value="1" readonly>';}
		echo'
				<div class="form-group">
					<label for="menu-title">Title</label>
					<input class="form-control" type="text" name="title" id="menu-title">
				</div>
				<div class="form-group">
					<label for="menu-url">URL</label>
					<input class="form-control" type="text" name="url" id="menu-url">
				</div>
				<div class="form-group">
					<label for="menu-class">Class</label>
					<input class="form-control" type="text" name="class" id="menu-class">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-sm btn-primary">Add Menu</button>
				</div>
			</form>
		</section>
	</div>
	</div>
	</div>
	</div>';?>



<div id="addgroup" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form id="form-validation" method="post" autocomplete="off">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title"><?=_e('Add Menu Group')?></h3>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="modul" value="menumanager">
                        <input type="hidden" name="aksi" value="add">
                        <div class="form-group">
                            <label><?=_e('Title')?></label>
                            <div>
                            <input class="form-control" type="text" name="title" placeholder="<?=_e('Title')?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submitAdd" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> <?=_e('Save')?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- edit form -->
<div id="edit_form" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
 <form id="validate" method="post" action="<?php echo $gotoprocess;?>">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3 class="modal-title">Edit Menu</h3>
            </div>
            <div class="modal-body">
            <input type="hidden" id="id" name="id" value="" readonly>
            <input type="hidden" id="group_id" name="group_id" value="" readonly>
              <input type="hidden" name="modul" value="menumanager" readonly>
               <input type="hidden" name="aksi" value="edit" readonly>
              <div class="form-group">
                <label>Title</label>
                <input id="title" class="form-control" type="text" name="title" value="" required>
              </div>
           
            <div class="form-group">
                <label>URL</label>
                <input id="url" class="form-control" type="text" name="url" value="" required>
              </div>
        
            <div class="form-group">
                <label>Class</label>
                <input id="class" class="form-control" type="text" name="class" value="" required>
          
            </div></div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-primary">
              <i class="fa fa-check"></i> Simpan</button>
            </div>
          </form>
        </div>
      </div></div>
  

<!-- Modal Deleted -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-danger"></i> </i> <?=_e('Deleted')?></h4></div>
<div class="modal-body">
<p>Apakah anda yakin ingin menghapus..?</p>
</div>
<div class="modal-footer">
<a class="btn btn-danger btn-sm" id="btn-ok"><i class="fa fa-trash-o"></i> <?=_e('Delete')?></a>
<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> <?=_e('Cancel')?></button>
</div></div></div></div>


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

        ajaxRequest.open("GET", "sw-mod/menumanager/menuSortableSave.php?jsonstring=" + jsonstring + "&rand=" + Math.random()*9999, true);
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
<?php $breack; }

else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';

}}}

 else {
echo'<div class="not"><i class="fa fa-paperclip"></i><p>Anda tidak memiliki hak akses.!</p></div>';}?>
<?php
}


?>

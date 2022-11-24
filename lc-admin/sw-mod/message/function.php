<?php if(!empty($connection)){
echo'<div class="block full">
<!-- Menu Title -->
<div class="block-title clearfix">
<div class="block-options"><br>
<a href="./?mod='.$mod.'&op=compose" class="btn btn-alt btn-sm btn-block btn-default"><i class="fa fa-pencil"></i> New Message</a>
</div>
</div>
<!-- END Menu Title -->
<!-- Menu Content -->
<ul class="nav nav-pills nav-stacked">
<li>
<a href="./?mod='.$mod.'">
<span class="badge pull-right">'.$j_inbox.'</span>
<i class="fa fa-angle-right fa-fw"></i> <strong>Inbox</strong>
</a></li>
<li>
<a href="./?mod='.$mod.'&op=sent">
<span class="badge pull-right">'.$j_sent.'</span>
<i class="fa fa-angle-right fa-fw"></i> <strong>Sent</strong>
</a>
</li>
<li>
<a href="./?mod='.$mod.'&op=drafts">
<span class="badge pull-right">'.$j_draft.'</span>
<i class="fa fa-angle-right fa-fw"></i> <strong>Drafts</strong>
</a>
</li>
<li>
<a href="./?mod='.$mod.'&op=trash">
<span class="badge pull-right">'.$j_delet.'</span>
<i class="fa fa-angle-right fa-fw"></i> <strong>Trash</strong>
</a>
</li>
</ul>
<!-- END Menu Content -->
</div>';


echo' <!-- Regular Modal 3 -->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>


<ul class="nav nav-tabs nav-tabs-simple" data-toggle="tabs">
    <li class="active"><a href="#modal-template">Template Message</a></li>
    <li><a href="#modal-addtemp" data-toggle="tooltip" title="Settings"><i class="fa fa-cogs"></i> Add Template</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="modal-template">';
    $queryA="SELECT id,name,filename,active FROM message_theme  order by id DESC"; 
$resultA = $connection->query($queryA);
if($resultA->num_rows > 0){
	$no=0;
echo'
<table class="table table-hover" id="data">
    <thead>
        <tr>
        <th class="text-center">No</th>
            <th>Name</th>
            <th>Filename</th>
           <th class="text-center">Satus</th>
             <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>';
while($rA= $resultA->fetch_assoc()){
	$no++;
	if($rA['active']=='1'){
            $active='<a href="'.$gotoprocess.'?id='.$rA['id'].'&aksi=setactive&active=2" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> Active</a>';
        }else{
            $active='<a href="'.$gotoprocess.'?id='.$rA['id'].'&aksi=setactive&active=1" class="btn btn-xs btn-danger"><i class="fa fa-eye-slash"></i> Deactive</a>';
        }

echo'<tr>
   <td style="width:80px;">
<div class="text-center">'.$no.'</div></td>
    <td>'.$rA['name'].'</td>
    <td>'.$rA['filename'].'</td>
    <th class="text-center"><div class="btn-group btn-group-xs">'.$active.'</div></td>
    <th class="text-center"><div class="btn-group btn-group-xs">
   <a href="?mod='.$mod.'&op=edit-theme&id='.$rA['id'].'" class="btn btn-xs btn-default enable-tooltip" title="Edit">
    <i class="fa fa-pencil"></i></a>
   
 <a href="javascript:void(0)" data-href="'.$gotoprocess.'?id='.$rA['id'].'&aksi=delete-theme" data-toggle="modal" data-target="#hapus" class="btn btn-xs btn-danger enable-tooltip" title="Delete">
    <i class="fa fa-trash-o"></i></a>

    <a href="../sw-content/upload/mail/'.$rA['filename'].'" target="_blank" class="btn btn-xs btn-warning enable-tooltip" title="View Demo">
    <i class="fa fa-search-plus"></i></a>

    </div></td>
    </tr>';}
echo'
    </tbody>
</table>';}
echo'
</div>

    <div class="tab-pane" id="modal-addtemp">
<form id="validate" method="post" action="'.$gotoprocess.'" enctype="multipart/form-data">
<input type="hidden" name="modul" value="'.$mod.'" readonly>
<input type="hidden" name="aksi" value="add_theme" readonly>
<div class="form-group">
<label>'._e('Name').'</label>
<input type="text" name="name" class="required form-control" placeholder="Masukkan Nama Template" required>
    </div>
   <hr>
<div class="form-group">
<label>'._e('Upload').'</label>
<div class="input-group">
<span class="input-group-btn">
<span class="btn btn-primary btn-file"><i class="fa   fa-html5"></i> Upload
<input type="file" class="upload" name="filename" accept=".html">
</span></span>
<input type="text" placeholder="Browse file" class="form-control" style="background:#ffffff" readonly>
</div>
<span class="text-danger">Format berkas harus berformat .html</span>
</div>

<div class="form-group">
<label class="switch switch-primary">
 <input type="checkbox" name="active" value="1"><span></span></label>
</div>
<hr>
<button type="submit" class="btn btn-complete"><i class="fa fa-floppy-o"></i> '._e('Save').'</button>


</div>
</form>
</div>
</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<!-- END Regular Modal 3 -->
';
}?>
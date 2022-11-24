 /* Initialize Bootstrap Datatables Integration */
            App.datatables();

            /* Initialize Datatables */
            $('#sw-cms').dataTable({
                "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 1, 3 ] } ],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]]
            });

// main
  $(document).ready(function(){   
    function slideout(){
  setTimeout(function(){
  $("#response").slideUp("slow", function () {
      });
    
}, 2000);}
  
    $("#response").hide();
  $(function() {
  $("#list-main ul").sortable({opacity: 0.8, cursor: 'move', update: function() {
      var order = $(this).sortable("serialize") + '&update=update'; 
      $.post("./sw-mod/slider/drag-slider.php", order, function(theResponse){
        $("#response").html(theResponse);
        $("#response").slideDown('slow');
        slideout();
      });                                
    }                 
    });
  });
});


  /* ------------------- set active ------------ */
$(".setactive").click(function(){
            var id = $(this).attr("data-id");
            var active = $("#set"+id).attr("data-active");
            if(active == "Y"){
            var dataactive = "N";
            }else{
            var dataactive = "Y";
            }
             var modul ='slider';
             var aksi = 'setactive';
             var dataString = 'id='+ id + '&modul='+ modul + '&aksi='+ aksi + '&active='+ dataactive;
            $("#set"+id).html("waiting");
            $.ajax({
                type: "POST",
                url: "./sw-mod/slider/proses.php",
                data: dataString,
                //cache: false,
                success: function(){
                    if(active == "Y"){
                        $("#set"+id).attr("data-active","N");
                        $("#set"+id).attr("class","btn btn-xs btn-danger");
                        $("#set"+id).html("<i class='fa fa-eye-slash'></i> Deactive");
                    }else{
                        $("#set"+id).attr("data-active","Y");
                        $("#set"+id).attr("class","btn btn-xs btn-success");
                        $("#set"+id).html("<i class='fa fa-eye'></i> Active</a>");
                    }
                }
            });
        });

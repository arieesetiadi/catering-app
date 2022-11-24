/* ------------------- set active ------------ */
$(".setactive").click(function(){
            var id = $(this).attr("data-id");
            var active = $("#set"+id).attr("data-active");
            if(active == "Y"){
            var dataactive = "N";
            }else{
            var dataactive = "Y";
            }
             var modul ='city';
             var aksi = 'setactive';
             var dataString = 'id='+ id + '&modul='+ modul + '&aksi='+ aksi + '&active='+ dataactive;
            $("#set"+id).html("waiting");
            $.ajax({
                type: "POST",
                url: "./sw-mod/city/proses.php",
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

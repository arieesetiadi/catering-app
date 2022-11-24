var editor = CodeMirror.fromTextArea(document.getElementById("swcodemirror"), {
  lineNumbers: true,
    mode: "php",
  extraKeys: {
    "Ctrl-J": "toMatchingTag",
    "F11": function(cm) {
      cm.setOption("fullScreen", !cm.getOption("fullScreen"));
    },
    "Esc": function(cm) {
      if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
    },
    "Ctrl-Space": "autocomplete"
  },
  gutters: ["CodeMirror-linenumbers", "breakpoints"],
  styleActiveLine: true,
  autoCloseBrackets: true,
  autoCloseTags: true,
    theme: "github"
});
editor.on("gutterClick", function(cm, n) {
  var info = cm.lineInfo(n);
  cm.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : makeMarker());
});
function makeMarker() {
  var marker = document.createElement("div");
  marker.style.color = "#ff0000";
  marker.innerHTML = "●";
  return marker;
}

var editor = CodeMirror.fromTextArea(document.getElementById("swcodemirror2"), {
  lineNumbers: true,
    mode: "php",
  extraKeys: {
    "Ctrl-J": "toMatchingTag",
    "F11": function(cm) {
      cm.setOption("fullScreen", !cm.getOption("fullScreen"));
    },
    "Esc": function(cm) {
      if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
    },
    "Ctrl-Space": "autocomplete"
  },
  gutters: ["CodeMirror-linenumbers", "breakpoints"],
  styleActiveLine: true,
  autoCloseBrackets: true,
  autoCloseTags: true,
    theme: "github"
});
editor.on("gutterClick", function(cm, n) {
  var info = cm.lineInfo(n);
  cm.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : makeMarker());
});
function makeMarker() {
  var marker = document.createElement("div");
  marker.style.color = "#ff0000";
  marker.innerHTML = "●";
  return marker;
}

var editor = CodeMirror.fromTextArea(document.getElementById("swcodemirror3"), {
  lineNumbers: true,
    mode: "php",
  extraKeys: {
    "Ctrl-J": "toMatchingTag",
    "F11": function(cm) {
      cm.setOption("fullScreen", !cm.getOption("fullScreen"));
    },
    "Esc": function(cm) {
      if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
    },
    "Ctrl-Space": "autocomplete"
  },
  gutters: ["CodeMirror-linenumbers", "breakpoints"],
  styleActiveLine: true,
  autoCloseBrackets: true,
  autoCloseTags: true,
    theme: "github"
});
editor.on("gutterClick", function(cm, n) {
  var info = cm.lineInfo(n);
  cm.setGutterMarker(n, "breakpoints", info.gutterMarkers ? null : makeMarker());
});
function makeMarker() {
  var marker = document.createElement("div");
  marker.style.color = "#ff0000";
  marker.innerHTML = "●";
  return marker;
}



$( function(){
    //sitename
    $("#site_name").on( "click",function(e) {
        e.preventDefault()
        $("#sitename").toggle(true);
        $("#site_name").toggle(false);
    });
    $("#sitename").on("click",function(e) {
        e.stopPropagation();
    });
    $("#site_name").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#site_name"){
            $("#sitename").toggle(false);
            $("#site_name").toggle(true);
        }
    });
    $("#sitenameOK").click(function(){
      var post = $('#text_sitename').val();
      var modul = 'setting';
      var aksi =  'site_name';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_sitename').val(html);
          $('#site_name').html(html);
          $('#sitename').hide();
          $('#site_name').show();
        }
      });
      return false;
    });

    //site url
    $("#site_url").on("click",function(e) {
        e.preventDefault()
        $("#siteurl").toggle(true);
        $("#site_url  ").toggle(false);
    });
    $("#siteurl").on("click",function(e) {
        e.stopPropagation();
    });
    $("#site_url").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#site_url"){
            $("#siteurl").toggle(false);
            $("#site_url").toggle(true);
        }
    });
    $("#siteurlOK").click(function(){
      var post = $('#text_siteurl').val();
      var modul = 'setting';
      var aksi =  'site_url';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_siteurl').val(html);
          $('#site_url').html(html);
          $('#siteurl').hide();
          $('#site_url').show();
        }
      });
      return false;
    });

//sub url
    $("#sub_url").on("click",function(e) {
        e.preventDefault()
        $("#suburl").toggle(true);
        $("#sub_url  ").toggle(false);
    });
    $("#suburl").on("click",function(e) {
        e.stopPropagation();
    });
    $("#sub_url").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#sub_url"){
            $("#suburl").toggle(false);
            $("#sub_url").toggle(true);
        }
    });
    $("#suburlOK").click(function(){
      var post = $('#text_suburl').val();
      var modul = 'setting';
      var aksi =  'sub_url';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_suburl').val(html);
          $('#sub_url').html(html);
          $('#suburl').hide();
          $('#sub_url').show();
        }
      });
      return false;
    });
    
    //site_owner
    $("#site_owner").on("click",function(e) {
        e.preventDefault()
        $("#siteowner").toggle(true);
        $("#site_owner  ").toggle(false);
    });
    $("#siteowner").on("click",function(e) {
        e.stopPropagation();
    });
    $("#site_owner").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#site_owner"){
            $("#siteowner").toggle(false);
            $("#site_owner").toggle(true);
        }
    });
   $("#siteownerOK").click(function(){
      var post = $('#text_siteowner').val();
      var modul = 'setting';
      var aksi =  'site_owner';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_siteowner').val(html);
          $('#site_owner').html(html);
          $('#siteowner').hide();
          $('#site_owner').show();
        }
      });
      return false;
    });

    //site_email
    $("#site_email").on("click",function(e) {
        e.preventDefault()
        $("#siteemail").toggle(true);
        $("#site_email").toggle(false);
    });
    $("#siteemail").on("click",function(e) {
        e.stopPropagation();
    });
    $("#site_email").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#site_email"){
            $("#siteemail").toggle(false);
            $("#site_email").toggle(true);
        }
    });
    $("#siteemailOK").click(function(){
      var post = $('#text_siteemail').val();
      var modul = 'setting';
      var aksi =  'site_email';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_siteemail').val(html);
          $('#site_email').html(html);
          $('#siteemail').hide();
          $('#site_email').show();
        }
      });
      return false;
    });

    //site_phone
    $("#site_phone").on("click",function(e) {
        e.preventDefault()
        $("#sitephone").toggle(true);
        $("#site_phone").toggle(false);
    });
    $("#sitephone").on("click",function(e) {
        e.stopPropagation();
    });
    $("#site_phone").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#site_phone"){
            $("#sitephone").toggle(false);
            $("#site_phone").toggle(true);
        }
    });
    $("#sitephoneOK").click(function(){
      var post = $('#text_sitephone').val();
      var modul = 'setting';
      var aksi =  'site_phone';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_sitephone').val(html);
          $('#site_phone').html(html);
          $('#sitephone').hide();
          $('#site_phone').show();
        }
      });
      return false;
    });

       //site_phone_2
    $("#site_phone_2").on("click",function(e) {
        e.preventDefault()
        $("#sitephone_2").toggle(true);
        $("#site_phone_2").toggle(false);
    });
    $("#sitephone_2").on("click",function(e) {
        e.stopPropagation();
    });
    $("#site_phone_2").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#site_phone_2"){
            $("#sitephone_2").toggle(false);
            $("#site_phone_2").toggle(true);
        }
    });
    $("#sitephone_2OK").click(function(){
      var post = $('#text_sitephone_2').val();
      var modul = 'setting';
      var aksi =  'site_phone_2';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_sitephone_2').val(html);
          $('#site_phone_2').html(html);
          $('#sitephone_2').hide();
          $('#site_phone_2').show();
        }
      });
      return false;
    });
    
    //site_address
    $("#site_address").on("click",function(e) {
        e.preventDefault()
        $("#siteaddress").toggle(true);
        $("#site_address").toggle(false);
    });
    $("#siteaddress").on("click",function(e) {
        e.stopPropagation();
    });
    $("#site_address").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#site_address"){
            $("#siteaddress").toggle(false);
            $("#site_address").toggle(true);
        }
    });
    $("#siteaddressOK").click(function(){
      var post = $('#text_siteaddress').val();
      var modul = 'setting';
      var aksi =  'site_address';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_siteaddress').val(html);
          $('#site_address').html(html);
          $('#siteaddress').hide();
          $('#site_address').show();
        }
      });
      return false;
    });
    //site_description
    $("#site_description").on("click",function(e) {
        e.preventDefault()
        $("#sitedescription").toggle(true);
        $("#site_description").toggle(false);
    });
    $("#sitedescription").on("click",function(e) {
        e.stopPropagation();
    });
    $("#site_description").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#site_description"){
            $("#sitedescription").toggle(false);
            $("#site_description").toggle(true);
        }
    });
    $("#sitedescriptionOK").click(function(){
      var post = $('#text_sitedescription').val();
      var modul = 'setting';
      var aksi =  'site_description';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_sitedescription').val(html);
          $('#site_description').html(html);
          $('#sitedescription').hide();
          $('#site_description').show();
        }
      });
      return false;
    });
    //site_keyword
    $("#site_keyword").on("click",function(e) {
        e.preventDefault()
        $("#sitekeyword").toggle(true);
        $("#site_keyword").toggle(false);
    });
    $("#sitekeyword").on("click",function(e) {
        e.stopPropagation();
    });
    $("#site_keyword").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#site_keyword"){
            $("#sitekeyword").toggle(false);
            $("#site_keyword").toggle(true);
        }
    });
    $("#sitekeywordOK").click(function(){
      var post = $('#text_sitekeyword').val();
      var modul = 'setting';
      var aksi =  'site_keyword';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_sitekeyword').val(html);
          $('#site_keyword').html(html);
          $('#sitekeyword').hide();
          $('#site_keyword').show();
        }
      });
      return false;
    });

    //maintenance_mod
    $("#maintenance_mode").on("click",function(e) {
        e.preventDefault()
        $("#maintenancemode").toggle(true);
        $("#maintenance_mode").toggle(false);
    });
    $("#maintenancemode").on("click",function(e) {
        e.stopPropagation();
    });
    $("#maintenance_mode").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#maintenance_mode"){
            $("#maintenancemode").toggle(false);
            $("#maintenance_mode").toggle(true);
        }
    });
    $("#maintenancemodeOk").click(function(){
      var post = $(this).attr("data-id");
      // alert(post);
      var modul = 'setting';
      var aksi =  'maintenance_mode';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(){
          $('#maintenancemode').hide();
          $('#mmm').html('Waiting <i class="fa fa-spinner fa-spin"></i>');
          window.location.href = "?mod=setting";
          // header('location: ')
          // $('#mmm').val(html);
          // $('#mmm').html(html);
          // $('#maintenancemode').hide();
          // $('#maintenance_mode').show();
        }
      });
      return false;
    });

    //social_fb
    $("#social_fb").on("click",function(e) {
        e.preventDefault()
        $("#socialfb").toggle(true);
        $("#social_fb").toggle(false);
    });
    $("#socialfb").on("click",function(e) {
        e.stopPropagation();
    });
    $("#social_fb").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#social_fb"){
            $("#socialfb").toggle(false);
            $("#social_fb").toggle(true);
        }
    });
    $("#socialfbOK").click(function(){
      var post = $('#text_socialfb').val();
      var modul = 'setting';
      var aksi =  'social_fb';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_socialfb').val(html);
          $('#social_fb').html(html);
          $('#socialfb').hide();
          $('#social_fb').show();
        }
      });
      return false;
    });

    //social_twit
    $("#social_twit").on("click",function(e) {
        e.preventDefault()
        $("#socialtwit").toggle(true);
        $("#social_twit").toggle(false);
    });
    $("#socialtwit").on("click",function(e) {
        e.stopPropagation();
    });
    $("#social_twit").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#social_twit"){
            $("#socialtwit").toggle(false);
            $("#social_twit").toggle(true);
        }
    });
    $("#socialtwitOK").click(function(){
      var post = $('#text_socialtwit').val();
      var modul = 'setting';
      var aksi =  'social_twit';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_socialtwit').val(html);
          $('#social_twit').html(html);
          $('#socialtwit').hide();
          $('#social_twit').show();
        }
      });
      return false;
    });

    //social_google
    $("#social_google").on("click",function(e) {
        e.preventDefault()
        $("#socialgoogle").toggle(true);
        $("#social_google").toggle(false);
    });
    $("#socialgoogle").on("click",function(e) {
        e.stopPropagation();
    });
    $("#social_google").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#social_google"){
            $("#socialgoogle").toggle(false);
            $("#social_google").toggle(true);
        }
    });
    $("#socialgoogleOK").click(function(){
      var post = $('#text_socialgoogle').val();
      var modul = 'setting';
      var aksi =  'social_google';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_socialgoogle').val(html);
          $('#social_google').html(html);
          $('#socialgoogle').hide();
          $('#social_google').show();
        }
      });
      return false;
    });



   //social_instagram
    $("#social_instagram").on("click",function(e) {
        e.preventDefault()
        $("#instagram").toggle(true);
        $("#social_instagram").toggle(false);
    });
    $("#instagram").on("click",function(e) {
        e.stopPropagation();
    });
    $("#social_instagram").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#social_instagram"){
            $("#instagram").toggle(false);
            $("#social_instagram").toggle(true);
        }
    });
    $("#instagramOK").click(function(){
      var post = $('#text_instagram').val();
      var modul = 'setting';
      var aksi =  'social_instagram';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_instagram').val(html);
          $('#social_instagram').html(html);
          $('#instagram').hide();
          $('#social_instagram').show();
        }
      });
      return false;
    });




   //social_line
    $("#social_line").on("click",function(e) {
        e.preventDefault()
        $("#line").toggle(true);
        $("#social_line").toggle(false);
    });
    $("#line").on("click",function(e) {
        e.stopPropagation();
    });
    $("#social_line").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#social_line"){
            $("#line").toggle(false);
            $("#social_line").toggle(true);
        }
    });
    $("#lineOK").click(function(){
      var post = $('#text_line').val();
      var modul = 'setting';
      var aksi =  'social_line';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_line').val(html);
          $('#social_line').html(html);
          $('#line').hide();
          $('#social_line').show();
        }
      });
      return false;
    });


   //social_bbm
    $("#social_bbm").on("click",function(e) {
        e.preventDefault()
        $("#bbm").toggle(true);
        $("#social_bbm").toggle(false);
    });
    $("#bbm").on("click",function(e) {
        e.stopPropagation();
    });
    $("#social_bbm").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#social_bbm"){
            $("#bbm").toggle(false);
            $("#social_bbm").toggle(true);
        }
    });
    $("#bbmOK").click(function(){
      var post = $('#text_bbm').val();
      var modul = 'setting';
      var aksi =  'social_bbm';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_bbm').val(html);
          $('#social_bbm').html(html);
          $('#bbm').hide();
          $('#social_bbm').show();
        }
      });
      return false;
    });



    //social_rss
    $("#social_rss").on("click",function(e) {
        e.preventDefault()
        $("#rss").toggle(true);
        $("#social_rss").toggle(false);
    });
    $("#rss").on("click",function(e) {
        e.stopPropagation();
    });
    $("#social_rss").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#social_rss"){
            $("#rss").toggle(false);
            $("#social_rss").toggle(true);
        }
    });
    $("#rssOK").click(function(){
      var post = $('#text_rss').val();
      var modul = 'setting';
      var aksi =  'social_rss';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_rss').val(html);
          $('#social_rss').html(html);
          $('#rss').hide();
          $('#social_rss').show();
        }
      });
      return false;
    });

    //site_favicon
    $("#site_favicon").on("click",function(e) {
        e.preventDefault()
        $("#sitefavicon").toggle(true);
        $("#site_favicon").toggle(false);
    });
    $("#sitefavicon").on("click",function(e) {
        e.stopPropagation();
    });
    $("#site_favicon").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#site_favicon"){
            $("#sitefavicon").toggle(false);
            $("#site_favicon").toggle(true);
        }
    });

    //id google
    $("#id_googleweb").on( "click",function(e) {
        e.preventDefault()
        $("#idgoogleweb").toggle(true);
        $("#id_googleweb").toggle(false);
    });
    $("#idgoogleweb").on("click",function(e) {
        e.stopPropagation();
    });
    $("#id_googleweb").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#id_googleweb"){
            $("#idgoogleweb").toggle(false);
            $("#id_googleweb").toggle(true);
        }
    });
    $("#idgooglewebOK").click(function(){
      var post = $('#text_idgoogleweb').val();
      var modul = 'setting';
      var aksi =  'id_googleweb';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_idgoogleweb').val(html);
          $('#id_googleweb').html(html);
          $('#idgoogleweb').hide();
          $('#id_googleweb').show();
        }
      });
      return false;
    });
    
   //id google
    $("#id_googlean").on( "click",function(e) {
        e.preventDefault()
        $("#idgooglean").toggle(true);
        $("#id_googlean").toggle(false);
    });
    $("#idgooglean").on("click",function(e) {
        e.stopPropagation();
    });
    $("#id_googlean").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#id_googlean"){
            $("#idgooglean").toggle(false);
            $("#id_googlean").toggle(true);
        }
    });
    $("#idgoogleanOK").click(function(){
      var post = $('#text_idgooglean').val();
      var modul = 'setting';
      var aksi =  'id_googlean';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_idgooglean').val(html);
          $('#id_googlean').html(html);
          $('#idgooglean').hide();
          $('#id_googlean').show();
        }
      });
      return false;
    });
    
     //id alexa
    $("#id_alexa").on( "click",function(e) {
        e.preventDefault()
        $("#idalexa").toggle(true);
        $("#id_alexa").toggle(false);
    });
    $("#idalexa").on("click",function(e) {
        e.stopPropagation();
    });
    $("#id_alexa").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#id_alexa"){
            $("#idalexa").toggle(false);
            $("#id_alexa").toggle(true);
        }
    });
    $("#idalexaOK").click(function(){
      var post = $('#text_idalexa').val();
      var modul = 'setting';
      var aksi =  'id_alexa';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_idalexa').val(html);
          $('#id_alexa').html(html);
          $('#idalexa').hide();
          $('#id_alexa').show();
        }
      });
      return false;
    });

     //id bing
    $("#id_bing").on( "click",function(e) {
        e.preventDefault()
        $("#idbing").toggle(true);
        $("#id_bing").toggle(false);
    });
    $("#idbing").on("click",function(e) {
        e.stopPropagation();
    });
    $("#id_bing").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#id_bing"){
            $("#idbing").toggle(false);
            $("#id_bing").toggle(true);
        }
    });
    $("#idbingOK").click(function(){
      var post = $('#text_idbing').val();
      var modul = 'setting';
      var aksi =  'id_bing';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_idbing').val(html);
          $('#id_bing').html(html);
          $('#idbing').hide();
          $('#id_bing').show();
        }
      });
      return false;
    });

     //id yahoo
    $("#id_yahoo").on( "click",function(e) {
        e.preventDefault()
        $("#idyahoo").toggle(true);
        $("#id_yahoo").toggle(false);
    });
    $("#idyahoo").on("click",function(e) {
        e.stopPropagation();
    });
    $("#id_yahoo").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#id_yahoo"){
            $("#idyahoo").toggle(false);
            $("#id_yahoo").toggle(true);
        }
    });
    $("#idyahooOK").click(function(){
      var post = $('#text_idyahoo').val();
      var modul = 'setting';
      var aksi =  'id_yahoo';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_idyahoo').val(html);
          $('#id_yahoo').html(html);
          $('#idyahoo').hide();
          $('#id_yahoo').show();
        }
      });
      return false;
    });

     //id facebook
    $("#id_facebook").on( "click",function(e) {
        e.preventDefault()
        $("#idfacebook").toggle(true);
        $("#id_facebook").toggle(false);
    });
    $("#idfacebook").on("click",function(e) {
        e.stopPropagation();
    });
    $("#id_facebook").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#id_facebook"){
            $("#idfacebook").toggle(false);
            $("#id_facebook").toggle(true);
        }
    });
    $("#idfacebookOK").click(function(){
      var post = $('#text_idfacebook').val();
      var modul = 'setting';
      var aksi =  'id_facebook';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_idfacebook').val(html);
          $('#id_facebook').html(html);
          $('#idfacebook').hide();
          $('#id_facebook').show();
        }
      });
      return false;
    });

      //id map
    $("#id_map").on( "click",function(e) {
        e.preventDefault()
        $("#idmap").toggle(true);
        $("#id_map").toggle(false);
    });
    $("#idmap").on("click",function(e) {
        e.stopPropagation();
    });
    $("#id_map").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#id_map"){
            $("#idmap").toggle(false);
            $("#id_map").toggle(true);
        }
    });
    $("#idmapOK").click(function(){
      var post = $('#text_idmap').val();
      var modul = 'setting';
      var aksi =  'id_map';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_idmap').val(html);
          $('#id_map').html(html);
          $('#idmap').hide();
          $('#id_map').show();
        }
      });
      return false;
    });
    

    //format_tanggal
    $("#format_tanggal").on("click",function(e) {
        e.preventDefault()
        $("#formattanggal").toggle(true);
        $("#format_tanggal").toggle(false);
    });
    $("#formattanggal").on("click",function(e) {
        e.stopPropagation();
    });
    $("#format_tanggal").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#format_tanggal"){
            $("#formattanggal").toggle(false);
            $("#format_tanggal").toggle(true);
        }
    });
    $("#formattanggalOK").click(function(){
      var post = $('#text_formattanggal').val();
      var modul = 'setting';
      var aksi =  'format_tanggal';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_formattanggal').val(html);
          $('#format_tanggal').html(html);
          $('#formattanggal').hide();
          $('#format_tanggal').show();
        }
      });
      return false;
    });

    //item_artikel
    $("#item_artikel").on("click",function(e) {
        e.preventDefault()
        $("#itemartikel").toggle(true);
        $("#item_artikel").toggle(false);
    });
    $("#itemartikel").on("click",function(e) {
        e.stopPropagation();
    });
    $("#item_artikel").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#item_artikel"){
            $("#itemartikel").toggle(false);
            $("#item_artikel").toggle(true);
        }
    });
    $("#itemartikelOK").click(function(){
      var post = $('#text_itemartikel').val();
      var modul = 'setting';
      var aksi =  'item_artikel';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_itemartikel').val(html);
          $('#item_artikel').html(html);
          $('#itemartikel').hide();
          $('#item_artikel').show();
        }
      });
      return false;
    });

     //item_related_artikel
    $("#item_related_artikel").on("click",function(e) {
        e.preventDefault()
        $("#itemrelatedartikel").toggle(true);
        $("#item_related_artikel").toggle(false);
    });
    $("#itemrelatedartikel").on("click",function(e) {
        e.stopPropagation();
    });
    $("#item_related_artikel").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#item_related_artikel"){
            $("#itemrelatedartikel").toggle(false);
            $("#item_related_artikel").toggle(true);
        }
    });
    $("#itemrelatedartikelOK").click(function(){
      var post = $('#text_itemrelatedartikel').val();
      var modul = 'setting';
      var aksi =  'item_related_artikel';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_itemrelatedartikel').val(html);
          $('#item_related_artikel').html(html);
          $('#itemrelatedartikel').hide();
          $('#item_related_artikel').show();
        }
      });
      return false;
    });

     //item_produk
    $("#item_produk").on("click",function(e) {
        e.preventDefault()
        $("#itemproduk").toggle(true);
        $("#item_produk").toggle(false);
    });
    $("#itemproduk").on("click",function(e) {
        e.stopPropagation();
    });
    $("#item_produk").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#item_produk"){
            $("#itemproduk").toggle(false);
            $("#item_produk").toggle(true);
        }
    });
    $("#itemprodukOK").click(function(){
      var post = $('#text_itemproduk').val();
      var modul = 'setting';
      var aksi =  'item_produk';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_itemproduk').val(html);
          $('#item_produk').html(html);
          $('#itemproduk').hide();
          $('#item_produk').show();
        }
      });
      return false;
    });

     //item_related_produk
    $("#item_related_produk").on("click",function(e) {
        e.preventDefault()
        $("#itemrelatedproduk").toggle(true);
        $("#item_related_produk").toggle(false);
    });
    $("#itemrelatedproduk").on("click",function(e) {
        e.stopPropagation();
    });
    $("#item_related_produk").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#item_related_produk"){
            $("#itemrelatedproduk").toggle(false);
            $("#item_related_produk").toggle(true);
        }
    });
    $("#itemrelatedprodukOK").click(function(){
      var post = $('#text_itemrelatedproduk').val();
      var modul = 'setting';
      var aksi =  'item_related_produk';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_itemrelatedproduk').val(html);
          $('#item_related_produk').html(html);
          $('#itemrelatedproduk').hide();
          $('#item_related_produk').show();
        }
      });
      return false;
    });

     //komentar_mode
    $("#komentar_mode").on("click",function(e) {
        e.preventDefault()
        $("#komentarmode").toggle(true);
        $("#komentar_mode").toggle(false);
    });
    $("#komentarmode").on("click",function(e) {
        e.stopPropagation();
    });
    $("#komentar_mode").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#komentar_mode"){
            $("#komentarmode").toggle(false);
            $("#komentar_mode").toggle(true);
        }
    });
    $("#komentarmodeOK").click(function(){
      var post = $('#text_komentarmode').val();
      var modul = 'setting';
      var aksi =  'komentar_mode';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_komentarmode').val(html);
          $('#komentar_mode').html(html);
          $('#komentarmode').hide();
          $('#komentar_mode').show();
        }
      });
      return false;
    });

      //mail_info
    $("#mail_info").on("click",function(e) {
        e.preventDefault()
        $("#mailinfo").toggle(true);
        $("#mail_info").toggle(false);
    });
    $("#mailinfo").on("click",function(e) {
        e.stopPropagation();
    });
    $("#mail_info").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#mail_info"){
            $("#mailinfo").toggle(false);
            $("#mail_info").toggle(true);
        }
    });
    $("#mailinfoOK").click(function(){
      var post = $('#text_mailinfo').val();
      var modul = 'setting';
      var aksi =  'mail_info';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_mailinfo').val(html);
          $('#mail_info').html(html);
          $('#mailinfo').hide();
          $('#mail_info').show();
        }
      });
      return false;
    });

      //mail_noreply
    $("#mail_noreply").on("click",function(e) {
        e.preventDefault()
        $("#mailnoreply").toggle(true);
        $("#mail_noreply").toggle(false);
    });
    $("#mailnoreply").on("click",function(e) {
        e.stopPropagation();
    });
    $("#mail_noreply").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#mail_noreply"){
            $("#mailnoreply").toggle(false);
            $("#mail_noreply").toggle(true);
        }
    });
    $("#mailnoreplyOK").click(function(){
      var post = $('#text_mailnoreply').val();
      var modul = 'setting';
      var aksi =  'mail_noreply';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_mailnoreply').val(html);
          $('#mail_noreply').html(html);
          $('#mailnoreply').hide();
          $('#mail_noreply').show();
        }
      });
      return false;
    });

      //protocol
    $("#protocol").on("click",function(e) {
        e.preventDefault()
        $("#proto").toggle(true);
        $("#protocol").toggle(false);
    });
    $("#proto").on("click",function(e) {
        e.stopPropagation();
    });
    $("#protocol").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#protocol"){
            $("#proto").toggle(false);
            $("#protocol").toggle(true);
        }
    });
    $("#protoOK").click(function(){
      var post = $('#text_proto').val();
      var modul = 'setting';
      var aksi =  'protocol';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_proto').val(html);
          $('#protocol').html(html);
          $('#proto').hide();
          $('#protocol').show();
        }
      });
      return false;
    });

      //hostname
    $("#hostname").on("click",function(e) {
        e.preventDefault()
        $("#hostn").toggle(true);
        $("#hostname").toggle(false);
    });
    $("#hostn").on("click",function(e) {
        e.stopPropagation();
    });
    $("#hostname").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#hostname"){
            $("#hostn").toggle(false);
            $("#hostname").toggle(true);
        }
    });
    $("#hostnOK").click(function(){
      var post = $('#text_hostn').val();
      var modul = 'setting';
      var aksi =  'hostname';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_hostn').val(html);
          $('#hostname').html(html);
          $('#hostn').hide();
          $('#hostname').show();
        }
      });
      return false;
    });

      //usermail
    $("#usermail").on("click",function(e) {
        e.preventDefault()
        $("#userm").toggle(true);
        $("#usermail").toggle(false);
    });
    $("#userm").on("click",function(e) {
        e.stopPropagation();
    });
    $("#usermail").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#usermail"){
            $("#userm").toggle(false);
            $("#usermail").toggle(true);
        }
    });
    $("#usermOK").click(function(){
      var post = $('#text_userm').val();
      var modul = 'setting';
      var aksi =  'usermail';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_userm').val(html);
          $('#usermail').html(html);
          $('#userm').hide();
          $('#usermail').show();
        }
      });
      return false;
    });

      //passmail
    $("#passmail").on("click",function(e) {
        e.preventDefault()
        $("#passm").toggle(true);
        $("#passmail").toggle(false);
    });
    $("#passm").on("click",function(e) {
        e.stopPropagation();
    });
    $("#passmail").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#passmail"){
            $("#passm").toggle(false);
            $("#passmail").toggle(true);
        }
    });
    $("#passmOK").click(function(){
      var post = $('#text_passm').val();
      var modul = 'setting';
      var aksi =  'passmail';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_passm').val(html);
          $('#passmail').html(html);
          $('#passm').hide();
          $('#passmail').show();
        }
      });
      return false;
    });

      //portmail
    $("#portmail").on("click",function(e) {
        e.preventDefault()
        $("#portm").toggle(true);
        $("#portmail").toggle(false);
    });
    $("#portm").on("click",function(e) {
        e.stopPropagation();
    });
    $("#portmail").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#portmail"){
            $("#portm").toggle(false);
            $("#portmail").toggle(true);
        }
    });
    $("#portmOK").click(function(){
      var post = $('#text_portm').val();
      var modul = 'setting';
      var aksi =  'portmail';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_portm').val(html);
          $('#portmail').html(html);
          $('#portm').hide();
          $('#portmail').show();
        }
      });
      return false;
    });

         //logo_size
    $("#logo_size").on("click",function(e) {
        e.preventDefault()
        $("#logosize").toggle(true);
        $("#logo_size").toggle(false);
    });
    $("#logosize").on("click",function(e) {
        e.stopPropagation();
    });
    $("#logo_size").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#logo_size"){
            $("#logosize").toggle(false);
            $("#logo_size").toggle(true);
        }
    });
    $("#logosizeOK").click(function(){
      var post = $('#text_logosize').val();
      var modul = 'setting';
      var aksi =  'logo_size';
      var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
      $.ajax({
        type: "POST",
        url: "sw-mod/setting/proses.php",
        data: dataString,
        cache: false,
        success: function(html){
          $('#text_logosize').val(html);
          $('#logo_size').html(html);
          $('#logosize').hide();
          $('#logo_size').show();
        }
      });
      return false;
    });

    
    // $('#ficon').submit(function(e){
    //   // var post = $('#text_sitefavicon').val();
    //   // var modul = 'setting';
    //   // var aksi =  'site_favicon';
    //   // var data = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
    //   $.ajax({
    //     url: "sw-mod/setting/proses.php",
    //     type: "POST",
    //     data: $(this).serialize(),
    //     success: function(html){
    //       $('#text_sitefavicon').val(html);
    //       $('#site_favicon').html(html);
    //       $('#sitefavicon').hide();
    //       $('#site_favicon').show();
    //     }
    //   });
    //   return false;
    // });
    // $('#get_file').Click(function(){
    //     $.ajax({
    //         url: "sw-mod/profile/proses.php",
    //         type: "post",
    //         dataType: 'json',
    //         processData: false,
    //         contentType: false,
    //         data: {file: $(#my_cover).val()},
    //         success: function(text) {
    //             if(text == "success") {
    //                 alert("Your image was uploaded successfully");
    //             }
    //         },
    //         error: function() {
    //             alert("An error occured, please try again.");
    //         }
    //     });
    // })

    // document.getElementById('get_file').onclick = function() {
    //     document.getElementById('my_cover').click();
});



var ReadyProfile = function() {

    return {
        init: function() {
            /* Example effect of an update showing up in Newsfeed */
            var exampleUpdate = $('#newsfeed-update-example');

            setTimeout(function(){
                exampleUpdate.removeClass('display-none').find('> a').addClass('animation-fadeIn');
                exampleUpdate.find('> div').addClass('animation-pullDown');
            }, 1500);

            /*
             * With Gmaps.js, Check out examples and documentation at http://hpneo.github.io/gmaps/examples.html
             */

            // Set default height to Google Maps Container
            $('.gmap').css('height', '200px');

            // Initialize map with marker
            new GMaps({
                div: '#gmap-checkin',
                lat: -33.863,
                lng: 151.217,
                zoom: 15,
                disableDefaultUI: true,
                scrollwheel: false
            }).addMarkers([
                {lat: -33.865, lng: 151.215, title: 'Marker #2', animation: google.maps.Animation.DROP, infoWindow: {content: '<strong>Cafe-Bar: Example Address</strong>'}}
            ]);
        }
    };
}();

$( function(){
    //avatar
    $("#avatar").on( "click",function(e) {
        e.preventDefault()
        $("#new_avatar").toggle(true);
        $("#avatar").toggle(false);
    });
    $("#new_avatar").on("click",function(e) {
        e.stopPropagation();
    });
    $("#avatar").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#avatar"){
            $("#new_avatar").toggle(false);
            $("#avatar").toggle(true);
        }
    });

    //name
    $("#name").on("click",function(e) {
        e.preventDefault()
        $("#new_name").toggle(true);
        $("#name").toggle(false);
    });
    $("#new_name").on("click",function(e) {
        e.stopPropagation();
    });
    $("#name").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#name"){
            $("#new_name").toggle(false);
            $("#name").toggle(true);
        }
    });
    $("#submitname").click(function(){
        var post = $('#nametxt').val();
        var modul = 'profile';
        var aksi =  'fullname';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#nametxt').val(html);
                $('#name').html(html);
                $('#new_name').hide();
                $('#name').show();
            }
        });
        return false;
    });
    //gender
    $("#gender").on("click",function(e) {
        e.preventDefault()
        $("#new_gender").toggle(true);
        $("#gender").toggle(false);
    });
    $("#new_gender").on("click",function(e) {
        e.stopPropagation();
    });
    $("#gender").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#gender"){
            $("#new_gender").toggle(false);
            $("#gender").toggle(true);
        }
    });
    $("#submitgender").click(function(){
        var post = $('input[type="radio"]:checked').val();
        var modul = 'profile';
        var aksi =  'gender';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#gendertxt').val(html);
                $('#gender').html(html);
                $('#new_gender').hide();
                $('#gender').show();
            }
        });
        return false;
    });

      //birthday
    $("#birthday").on("click",function(e) {
        e.preventDefault()
        $("#new_birthday").toggle(true);
        $("#birthday").toggle(false);
    });
    $("#new_birthday").on("click",function(e) {
        e.stopPropagation();
    });
    $("#birthday").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#birthday"){
            $("#new_birthday").toggle(false);
            $("#birthday").toggle(true);
        }
    });
    $("#submitbirthday").click(function(){
        var post = $('#birthdaytxt').val();
        var modul = 'profile';
        var aksi =  'birthday';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#birthdaytxt').val(html);
                $('#birthday').html(html);
                $('#new_birthday').hide();
                $('#birthday').show();
            }
        });
        return false;
    });

    //phone
    $("#phone").on("click",function(e) {
        e.preventDefault()
        $("#new_phone").toggle(true);
        $("#phone").toggle(false);
    });
    $("#new_phone").on("click",function(e) {
        e.stopPropagation();
    });
    $("#phone").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#phone"){
            $("#new_phone").toggle(false);
            $("#phone").toggle(true);
        }
    });
    $("#submitphone").click(function(){
        var post = $('#phonetxt').val();
        var modul = 'profile';
        var aksi =  'phone';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#phonetxt').val(html);
                $('#phone').html(html);
                $('#new_phone').hide();
                $('#phone').show();
            }
        });
        return false;
    });

    //email
    $("#email").on("click",function(e) {
        e.preventDefault()
        $("#new_email").toggle(true);
        $("#email").toggle(false);
    });
    $("#new_email").on("click",function(e) {
        e.stopPropagation();
    });
    $("#email").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#email"){
            $("#new_email").toggle(false);
            $("#email").toggle(true);
        }
    });
    $("#submitemail").click(function(){
        var post = $('#emailtxt').val();
        var modul = 'profile';
        var aksi =  'email';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#emailtxt').val(html);
                $('#email').html(html);
                $('#new_email').hide();
                $('#email').show();
            }
        });
        return false;
    });

    //facebook
    $("#facebook").on("click",function(e) {
        e.preventDefault()
        $("#new_facebook").toggle(true);
        $("#facebook").toggle(false);
    });
    $("#new_facebook").on("click",function(e) {
        e.stopPropagation();
    });
    $("#facebook").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#facebook"){
            $("#new_facebook").toggle(false);
            $("#facebook").toggle(true);
        }
    });
    $("#submitfacebook").click(function(){
        var post = $('#facebooktxt').val();
        var modul = 'profile';
        var aksi =  'facebook';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#facebooktxt').val(html);
                $('#facebook').html(html);
                $('#new_facebook').hide();
                $('#facebook').show();
            }
        });
        return false;
    });

    //twitter
    $("#twitter").on("click",function(e) {
        e.preventDefault()
        $("#new_twitter").toggle(true);
        $("#twitter").toggle(false);
    });
    $("#new_twitter").on("click",function(e) {
        e.stopPropagation();
    });
    $("#twitter").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#twitter"){
            $("#new_twitter").toggle(false);
            $("#twitter").toggle(true);
        }
    });
    $("#submittwitter").click(function(){
        var post = $('#twittertxt').val();
        var modul = 'profile';
        var aksi =  'twitter';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#twittertxt').val(html);
                $('#twitter').html(html);
                $('#new_twitter').hide();
                $('#twitter').show();
            }
        });
        return false;
    });

    //website
    $("#website").on("click",function(e) {
        e.preventDefault()
        $("#new_website").toggle(true);
        $("#website").toggle(false);
    });
    $("#new_website").on("click",function(e) {
        e.stopPropagation();
    });
    $("#website").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#website"){
            $("#new_website").toggle(false);
            $("#website").toggle(true);
        }
    });
    $("#submitwebsite").click(function(){
        var post = $('#websitetxt').val();
        var modul = 'profile';
        var aksi =  'website';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#websitetxt').val(html);
                $('#website').html(html);
                $('#new_website').hide();
                $('#website').show();
            }
        });
        return false;
    });

    // about
    $("#job").on("click",function(e) {
        e.preventDefault()
        $("#new_job").toggle(true);
        $("#job").toggle(false);
    });
    $("#new_job").on("click",function(e) {
        e.stopPropagation();
    });
    $("#job").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#job"){
            $("#new_job").toggle(false);
            $("#job").toggle(true);
        }
    });
    $("#submitjob").click(function(){
        var post = $('#jobtxt').val();
        var modul = 'profile';
        var aksi =  'job';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#jobtxt').val(html);
                $('#job').html(html);
                $('#new_job').hide();
                $('#job').show();
            }
        });
        return false;
    });

    // skills
    $("#skills").on("click",function(e) {
        e.preventDefault()
        $("#new_skills").toggle(true);
        $("#skills").toggle(false);
    });
    $("#new_skills").on("click",function(e) {
        e.stopPropagation();
    });
    $("#skills").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#skills"){
            $("#new_skills").toggle(false);
            $("#skills").toggle(true);
        }
    });
    $("#submitskills").click(function(){
        var post = $('#skillstxt').val();
        var modul = 'profile';
        var aksi =  'skills';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#skillstxt').val(html);
                $('#skills').html(html);
                $('#new_skills').hide();
                $('#skills').show();
            }
        });
        return false;
    });

    // about
    $("#description").on("click",function(e) {
        e.preventDefault()
        $("#new_description").toggle(true);
        $("#description").toggle(false);
    });
    $("#new_description").on("click",function(e) {
        e.stopPropagation();
    });
    $("#description").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#description"){
            $("#new_description").toggle(false);
            $("#description").toggle(true);
        }
    });
    $("#submitedescription").click(function(){
        var post = $('#descriptiontxt').val();
        var modul = 'profile';
        var aksi =  'about';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#descriptiontxt').val(html);
                $('#description').html(html);
                $('#new_description').hide();
                $('#description').show();
            }
        });
        return false;
    });

    //phone
    $("#phone").on("click",function(e) {
        e.preventDefault()
        $("#new_phone").toggle(true);
        $("#phone").toggle(false);
    });
    $("#new_phone").on("click",function(e) {
        e.stopPropagation();
    });
    $("#phone").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#phone"){
            $("#new_phone").toggle(false);
            $("#phone").toggle(true);
        }
    });
    $("#submitphone").click(function(){
        var post = $('#phonetxt').val();
        var modul = 'profile';
        var aksi =  'phone';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#phonetxt').val(html);
                $('#phone').html(html);
                $('#new_phone').hide();
                $('#phone').show();
            }
        });
        return false;
    });

    //email
    $("#email").on("click",function(e) {
        e.preventDefault()
        $("#new_email").toggle(true);
        $("#email").toggle(false);
    });
    $("#new_email").on("click",function(e) {
        e.stopPropagation();
    });
    $("#email").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#email"){
            $("#new_email").toggle(false);
            $("#email").toggle(true);
        }
    });
    $("#submitemail").click(function(){
        var post = $('#emailtxt').val();
        var modul = 'profile';
        var aksi =  'email';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#emailtxt').val(html);
                $('#email').html(html);
                $('#new_email').hide();
                $('#email').show();
            }
        });
        return false;
    });

    //facebook
    $("#facebook").on("click",function(e) {
        e.preventDefault()
        $("#new_facebook").toggle(true);
        $("#facebook").toggle(false);
    });
    $("#new_facebook").on("click",function(e) {
        e.stopPropagation();
    });
    $("#facebook").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#facebook"){
            $("#new_facebook").toggle(false);
            $("#facebook").toggle(true);
        }
    });
    $("#submitfacebook").click(function(){
        var post = $('#facebooktxt').val();
        var modul = 'profile';
        var aksi =  'facebook';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#facebooktxt').val(html);
                $('#facebook').html(html);
                $('#new_facebook').hide();
                $('#facebook').show();
            }
        });
        return false;
    });


    //twitter
    $("#twitter").on("click",function(e) {
        e.preventDefault()
        $("#new_twitter").toggle(true);
        $("#twitter").toggle(false);
    });
    $("#new_twitter").on("click",function(e) {
        e.stopPropagation();
    });
    $("#twitter").on("click",function(e) {
        e.stopPropagation();
    });
    $(document).on("click",function(e) {
        if (e.target.id!="#twitter"){
            $("#new_twitter").toggle(false);
            $("#twitter").toggle(true);
        }
    });
    $("#submittwitter").click(function(){
        var post = $('#twittertxt').val();
        var modul = 'profile';
        var aksi =  'twitter';
        var dataString = 'post='+ post + '&modul='+ modul + '&aksi='+ aksi;
        $.ajax({
            type: "POST",
            url: "sw-mod/profile/proses.php",
            data: dataString,
            cache: false,
            success: function(html){
                $('#twittertxt').val(html);
                $('#twitter').html(html);
                $('#new_twitter').hide();
                $('#twitter').show();
            }
        });
        return false;
    });

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


$(document).ready(function(){

//how much items per page to show
var show_per_page = 5;
//getting the amount of elements inside content div
var number_of_items = $('.content').children().size();
//calculate the number of pages we are going to have
var number_of_pages = Math.ceil(number_of_items/show_per_page);

//set the value of our hidden input fields
$('.current_page').val(0);
$('.show_per_page').val(show_per_page);

var navigation_html = '<ul class="pagination">';
// previous
navigation_html += '<li>';
navigation_html += '<a href="javascript:void(0)"><i class="fa fa-angle-left"></i></a>';
navigation_html += '</li>';

var current_link = 0;
while(number_of_pages > current_link){
navigation_html += '<li class="page_link" id="id' + current_link +'">';
navigation_html += '<a href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';
current_link++;
navigation_html += '</li>';
}

// next
navigation_html += '<li>';
navigation_html += '<a href="javascript:void(0)"><i class="fa fa-angle-right">';
navigation_html += '</li>';
navigation_html += '</ul>';

$('.page_navigation').html(navigation_html);

//add active class to the first page link
$('.page_navigation .page_link:first').addClass('active');

//hide all the elements inside content div
$('.content').children().css('display', 'none');

//and show the first n (show_per_page) elements
$('.content').children().slice(0, show_per_page).css('display', 'block');
});

function previous(){

new_page = parseInt($('.current_page').val()) - 1;
//if there is an item before the current active link run the function
if($('.active').prev('.page_link').length==true){
go_to_page(new_page);
}
}

function next(){
new_page = parseInt($('.current_page').val()) + 1;
//if there is an item after the current active link run the function
if($('.active').next('.page_link').length==true){
go_to_page(new_page);
}
}

function go_to_page(page_num){
//get the number of items shown per page
var show_per_page = parseInt($('.show_per_page').val());

//get the element number where to start the slice from
start_from = page_num * show_per_page;

//get the element number where to end the slice
end_on = start_from + show_per_page;

activate_id = page_num;
var get_box = document.getElementById("id"+page_num);
//hide all children elements of content div, get specific items and show them
$('.content').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');

/*get the page link that has longdesc attribute of the current page and add active class to it
and remove that class from previously active page link*/
$(".page_navigation").find('li.active').removeClass("active");
$(get_box).addClass("active");


//update the current page input field
$('.current_page').val(page_num);
}


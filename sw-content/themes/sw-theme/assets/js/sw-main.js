"use strict";

$(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        $(".navbar-me").addClass("fixed-me");
    } else {
        $(".navbar-me").removeClass("fixed-me");
    }
});

$(".btn-loading").on("click", function () {
    var $this = $(this);
    $this.button("loading");
    setTimeout(function () {
        $this.button("reset");
    }, 2000);
});

// Tooltips-------------------------------------------------
$("body").tooltip({
    selector: "a[data-toggle=tooltip]",
});

/*----- blog Slider -----*/
$(".blog-slider").owlCarousel({
    autoplay: true,
    loop: true,
    autoPlay: 6000,
    nav: false,
    margin: 20,
    lazyLoad: true,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    dots: true,
    responsive: {
        0: { items: 1 },
        480: { items: 2 },
        750: { items: 3 },
        950: { items: 3 },
        1170: { items: 3 },
    },
});

/*----- Brand Slider -----*/
$(".powered-slider").owlCarousel({
    autoplay: true,
    loop: true,
    autoPlay: 2000,
    nav: false,
    margin: 30,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    dots: true,
    responsive: {
        0: { items: 1 },
        480: { items: 2 },
        750: { items: 4 },
        950: { items: 5 },
        1170: { items: 6 },
    },
});

$.fn.stars = function () {
    return $(this).each(function () {
        // Get the value
        var val = parseFloat($(this).html());
        // Make sure that the value is in 0 - 5 range, multiply to get width
        var size = Math.max(0, Math.min(5, val)) * 10;
        // Create stars holder
        var $span = $("<span />").width(size);
        // Replace the numerical value with stars
        $(this).html($span);
    });
};

$(function () {
    $("span.stars").stars();
});

// BUTTON UP =============================================
if ($("#back-to-top").length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $("#back-to-top").addClass("show");
            } else {
                $("#back-to-top").removeClass("show");
            }
        };
    backToTop();
    $(window).on("scroll", function () {
        backToTop();
    });
    $("#back-to-top").on("click", function (e) {
        e.preventDefault();
        $("html,body").animate(
            {
                scrollTop: 0,
            },
            700
        );
    });
}

/* ------------------- Subrcibe ------------------ */

function sendSubclribe() {
    var valid;
    valid = validateSubclribe();
    if (valid) {
        jQuery.ajax({
            url: "action-subcribe",
            data: "subcribe_email=" + $("#subcribe_email").val(),
            type: "POST",
            success: function (data) {
                // $("#mail-status").html(data);
                alert(data);
                $("#subcribe").trigger("reset");
            },
            error: function () {},
        });
    }
}

function validateSubclribe() {
    var valid = true;

    if (!$("#subcribe_email").val()) {
        alert("Alamat Email tidak diketahui!!");
        valid = false;
    }

    // if (
    //     !$("#subcribe_email")
    //         .val()
    //         .match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)
    // ) {
    //     //$("#subcribe_email-info").html("Lengkapi data");
    //     alert("Alamat Email tidak diketahui!!");
    //     valid = false;
    // }
    return valid;
}

/* --------------------- Reservation -----------------*/
function sendReservation() {
    var valid;
    valid = validateReservation();
    if (valid) {
        jQuery.ajax({
            url: "action-reservation",
            data:
                "msg_name=" +
                $("#msg_name").val() +
                "&msg_email=" +
                $("#msg_email").val() +
                "&msg_phone=" +
                $("#msg_phone").val() +
                "&msg_quantity=" +
                $("#msg_quantity").val() +
                "&msg_date=" +
                $("#msg_date").val() +
                "&msg_time=" +
                $("#msg_time").val() +
                "&msg_content=" +
                $("#msg_content").val(),
            type: "POST",
            success: function (data) {
                //alert(data);
                $("#modal-alert").modal("show");
                $("#info-alert").html(data);
                $("#info-alert").show();
                $("#sw-reservation").trigger("reset");
            },
            error: function () {
                //alert('Data tidak boleh kosong');
            },
        });
    }
}

function validateReservation() {
    var valid = true;

    if (!$("#msg_name").val()) {
        //$("#msg_name-info").html("Required");
        $("#msg_name").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }
    if (!$("#msg_email").val()) {
        // $("#msg_email-info").html("Required");
        $("#msg_email").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }

    // if (
    //     !$("#msg_email")
    //         .val()
    //         .match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)
    // ) {
    //     //$("#msg_email-info").html("Email salah");
    //     $("#msg_email").css("background-color", "rgba(212, 43, 43, 0.07)");
    //     valid = false;
    // }

    if (!$("#msg_phone").val()) {
        //$("#msg_subject-info").html("Required");
        $("#msg_phone").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }

    if (!$("#msg_quantity").val()) {
        //$("#msg_content-info").html("Required");
        $("#msg_quantity").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }

    if (!$("#msg_date").val()) {
        //$("#msg_content-info").html("Required");
        $("#msg_date").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }

    if (!$("#msg_time").val()) {
        //$("#msg_content-info").html("Required");
        $("#msg_time").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }

    if (!$("#msg_content").val()) {
        //$("#msg_content-info").html("Required");
        $("#msg_content").css("background-color", "rgba(212, 43, 43, 0.07)");
        alert("Data tidak boleh kosong");
        valid = false;
    }

    return valid;
}

/* --------------------- ORDER -----------------*/
function sendOrder(baseUrl) {
    let valid = validateOrder();
    if (valid) {
        jQuery.ajax({
            url: baseUrl + "product/action-order",
            data:
                "order_name=" +
                $("#order_name").val() +
                "&order_phone=" +
                $("#order_phone").val() +
                "&order_city=" +
                $("#order_city").val() +
                "&order_address=" +
                $("#order_address").val() +
                "&order_messages=" +
                $("#order_messages").val() +
                "&order_time=" +
                $("#order_time").val() +
                "&order_date=" +
                $("#order_date").val(),
            type: "POST",
            success: function (data) {
                // alert(data);
                $("#modal-alert").modal("show");
                $("#info-alert").html(data);
                $("#info-alert").show();
                $("#sw-reservation").trigger("reset");

                document.addEventListener("click", function () {
                    if (!$("#modal-alert").hasClass("in")) {
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                        window.location = window.location.href;
                    }
                });
            },
            error: function () {
                alert("Gagal | Data tidak boleh kosong");
            },
        });
    }
}

function validateOrder() {
    var valid = true;

    if (!$("#order_name").val()) {
        //$("#msg_name-info").html("Required");
        $("#order_name").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }

    if (
        !$("#order_phone")
            .val()
            .match(/^[0-9]+$/)
    ) {
        // $("#msg_email-info").html("Required");
        $("#order_phone").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }

    if (!$("#order_city").val()) {
        //$("#msg_subject-info").html("Required");
        $("#order_city").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }

    if (!$("#order_address").val()) {
        //$("#msg_subject-info").html("Required");
        $("#order_address").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }

    if (!$("#order_date").val()) {
        //$("#msg_content-info").html("Required");
        $("#order_date").css("background-color", "rgba(212, 43, 43, 0.10)");
        valid = false;
    }

    if (!$("#order_time").val()) {
        //$("#msg_content-info").html("Required");
        $("#order_price").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }

    if (!$("#order_messages").val()) {
        //$("#msg_content-info").html("Required");
        $("#order_messages").css("background-color", "rgba(212, 43, 43, 0.07)");
        valid = false;
    }

    return valid;
}

/* --------------------- Ulasan -----------------*/
$(document).on("click", "#sendulasan", function (e) {
    var valid;
    valid = validateUlasan();
    if (valid) {
        var data = $("#form-ulasan").serialize();
        //$("#result_order").show();
        $.ajax({
            data: data,
            type: "post",
            url: "../product/action-ulasan",
            cache: false,
            success: function (data) {
                alert(data);
            },
        });
    }
});

function validateUlasan() {
    var valid = true;
    if (!$("#review_name").val()) {
        $("#review_name-info").html("Lengkapi data");
        $("#review_name").css("background-color", "#ffc9b8");
        valid = false;
    }
    if (!$("#review_email").val()) {
        $("#review_email-info").html("Lengkapi data");
        $("#review_email").css("background-color", "#ffc9b8");
        valid = false;
    }

    // if (
    //     !$("#review_email")
    //         .val()
    //         .match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)
    // ) {
    //     $("#review_email-info").html("Email anda salah");
    //     $("#review_email").css("background-color", "#ffc9b8");
    //     valid = false;
    // }

    if (!$("#review_message").val()) {
        $("#review_message-info").html("Lengkapi data");
        $("#review_message").css("background-color", "#ffc9b8");
        valid = false;
    }

    if (!$("#product_id").val()) {
        //$("#msg_content-info").html("Lengkapi data");
        valid = false;
    }

    return valid;
}

/* --------------------- Contact -----------------*/
function sendContact() {
    var valid;
    valid = validateContact();
    if (valid) {
        jQuery.ajax({
            url: "action-contact",
            data: "msg_name=" + $("#msg_name").val() + "&msg_subject=" + $("#msg_subject").val() + "&msg_email=" + $("#msg_email").val() + "&msg_content=" + $(msg_content).val(),
            type: "POST",
            success: function (data) {
                alert(data);
                $("#sw-contact").trigger("reset");
                $("#msg_name-info").html("");
                $("#msg_email-info").html("");
                $("#msg_subject-info").html("");
                $("#msg_content-info").html("");
            },
            error: function () {},
        });
    }
}

function validateContact() {
    var valid = true;

    if (!$("#msg_name").val()) {
        //$("#msg_name-info").html("Required");
        $("#msg_name").css("background-color", "#ffc9b8");
        valid = false;
    }
    if (!$("#msg_email").val()) {
        //$("#msg_email-info").html("Required");
        $("#msg_email").css("background-color", "#ffc9b8");
        valid = false;
    }

    // if (
    //     !$("#msg_email")
    //         .val()
    //         .match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)
    // ) {
    //     //$("#msg_email-info").html("Email salah");
    //     $("#msg_email").css("background-color", "#ffc9b8");
    //     valid = false;
    // }

    if (!$("#msg_subject").val()) {
        //$("#msg_subject-info").html("Required");
        $("#msg_subject").css("background-color", "#ffc9b8");
        valid = false;
    }
    if (!$("#msg_content").val()) {
        //$("#msg_content-info").html("Required");
        $("#msg_content").css("background-color", "#ffc9b8");
        valid = false;
    }

    return valid;
}

/* VALIDATION --------------------------------
$(document).ready(function() {
    $(".validate").validate();
});
*/

/* =============  Fomat Uang ==================== */

function formatAngka(angka) {
    if (typeof angka != "string") angka = angka.toString();
    var reg = new RegExp("([0-9]+)([0-9]{3})");
    while (reg.test(angka)) angka = angka.replace(reg, "$1.$2");
    return angka;
}

/* =============  Menghitung Biaya Order ==================== */

//$(document).ready(function() {
//$("#ongkir").on("change", function() {
function TotalOrder() {
    var price = parseInt($("#order_price").val());
    var quantity = parseInt($(".quantity").val());
    //var ongkir =parseInt($('#ongkir').val());

    //$("#ongkir_price").html(ongkir);
    $(".quantity_info").html(quantity);
    $(".price_info").html(formatAngka(price));
    var total_bayar = price * quantity;
    $("#Tbayar").html(formatAngka(total_bayar));
}
//});

/* =============================================================== */

$(document).ready(function () {
    $("img").error(function () {
        //$(this).hide();
        // $(this).attr('src', 'https://s14.postimg.org/8jky0uckh/Profile.jpg');
    });
});
// Replace ADD off click right
$("img").bind("contextmenu", function (e) {
    // return false;
});

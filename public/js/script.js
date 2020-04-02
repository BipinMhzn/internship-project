if(sessionStorage.getItem("sidebar-toggle-collapsed") == 1){
    $('.app-wrapper').addClass('collapse-sidebar');
}

$('document').ready(function () {
    $('.nav-toggle').click(function (event) {
        if (sessionStorage.getItem("sidebar-toggle-collapsed") == 0) {
            sessionStorage.setItem('sidebar-toggle-collapsed', '1');
            $('.app-wrapper').addClass('collapse-sidebar');
        } else {
            sessionStorage.setItem('sidebar-toggle-collapsed', '0');
            $('.app-wrapper').removeClass('collapse-sidebar');
        }
    });

    resizeNav();
});

$(window).resize(function () {
    resizeNav();
});

function resizeNav() {
    if ($('.app-wrapper').width() < 1000) {
        $('.app-wrapper').addClass('collapse-sidebar');
    }
}

$(document).ready(function ($) {
    $(".row-clickable").click(function () {
        window.document.location = $(this).data("href");
    });

    setTimeout(function(){
        $('.loader').fadeOut(100);
    }, 500);
});

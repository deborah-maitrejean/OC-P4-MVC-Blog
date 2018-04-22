window.onload=function(){
    //SCRIPT BARRE NAVIGATION SCROLL
    if ($(window).width() > 992){
        $(window).on('scroll', function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 200) {
                $(".navbar ").addClass("navbar-fixed-top");
            }
            else {
                $(".navbar").removeClass("navbar-fixed-top");
            }
        });
    }
};
window.onload=function(){
    //SCRIPT BARRE NAVIGATION SCROLL
        $(window).on('scroll', function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 200) {
                $(".navbar ").addClass("navbar-fixed-top");
            }
            else {
                $(".navbar").removeClass("navbar-fixed-top");
            }
        });
};
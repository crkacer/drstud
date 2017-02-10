$(document).ready(function () {
    if (window.screen.width <= 768) {
        $("#mobileMenuLogo").show();
    }
    
    $(".hamburger").click(function () {
        $(".mobileMenu").slideToggle("slow", function () {
            $(".hamburger").hide();
            $(".cross").show();
        });
    });

    $(".cross").click(function () {
        $(".mobileMenu").slideToggle("slow", function () {
            $(".cross").hide();
            $(".hamburger").show();
        });
    });


});
$(document).ready(function() {
    $(".navShowHide").click(function() {
        var main = $("#mainSectionContainer");
        var nav = $("#sideNavigationBar");

        if(main.hasClass("leftPadding")) {
            nav.hide();
            // nav.slideUp(500);
            
        } else {
            nav.show();
            // nav.slideDown(500);
        }
        main.toggleClass("leftPadding");
    });
});

function notSignIn() {
    alert("Action denied, Please Sign In"); 
    // window.location("signin.php");
}
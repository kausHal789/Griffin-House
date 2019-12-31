$(document).ready(function() {
    $(".navShowHide").click(function() {
        var main = $("#mainSectionContainer");
        var nav = $("#sideNavigationBar");

        if(main.hasClass("leftPadding")) {
            nav.hide();
        } else {
            nav.show();
        }
        main.toggleClass("leftPadding");
    });
});

function notSignIn() {
    alert("Action denied, Please Sign In"); 
}
function subscribe(userTo, userFrom, btn) {
    // userFrom is subscriber
    // userTo is Video Owner

    console.log(userTo);
    console.log(userFrom);
    console.log(btn);

    if(userFrom == userTo) {
        alert("You can't Subscribe youself");
        return;
    }

    $.post("ajax/subscribe.php", {userTo: userTo, userFrom: userFrom})
    .done(function (data) {
        if(data != null) {
            $(btn).toggleClass("subscribe unsubscribe");
            var buttonText = $(btn).hasClass("subscribe") ? "SUBSCRIBE" : "SUBSCRIBED";

            $(btn).text(buttonText + " " + data);
        } else {
            // Something went wrong
        } 
    });
}
function likeVideo(btn, videoId) {
    $.post("ajax/likeVideo.php", {videoId: videoId})
    .done(function (data) {
        var likeButton = $(btn);
        var dislikeButton = $(btn).siblings(".dislikeButton");

        likeButton.addClass("active");
        dislikeButton.removeClass("active");

        var result = JSON.parse(data);

        updateLikes($(likeButton).find(".text"), result.likes);
        updateLikes($(dislikeButton).find(".text"), result.dislikes);
               
        if(result.likes < 0) {
            likeButton.removeClass("active");
            likeButton.find('img:first').attr('src', "assets/image/icon/thumb-up.png");
        } else {
            likeButton.find('img:first').attr('src', "assets/image/icon/thumb-up-active.png");
        }
        dislikeButton.find('img:first').attr('src', "assets/image/icon/thumb-down.png");
    });
}

function updateLikes(ele, num) {
    var likeCountVal = ele.text() || 0; 
    ele.text(parseInt(likeCountVal) + parseInt(num));
}

function dislikeVideo(btn, videoId) {
    // alert("like");
    $.post("ajax/dislikeVideo.php", {videoId: videoId})
    .done(function (data) {
        // alert(data);      

        var dislikeButton = $(btn);
        var likeButton = $(btn).siblings(".likeButton");

        dislikeButton.addClass("active");
        likeButton.removeClass("active");

        var result = JSON.parse(data);

        updateDislikes($(dislikeButton).find(".text"), result.dislikes);
        updateDislikes($(likeButton).find(".text"), result.likes);
               
        if(result.dislikes < 0) {
            dislikeButton.removeClass("active");
            dislikeButton.find('img:first').attr('src', "assets/image/icon/thumb-down.png");
        } else {
            dislikeButton.find('img:first').attr('src', "assets/image/icon/thumb-down-active.png");
        }
        likeButton.find('img:first').attr('src', "assets/image/icon/thumb-up.png");
    });
}

function updateDislikes(ele, num) {
    var dislikeCountVal = ele.text() || 0; // If element have no text then return 0
    ele.text(parseInt(dislikeCountVal) + parseInt(num));
}

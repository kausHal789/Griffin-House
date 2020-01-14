function postComment(btn, postBy, videoId, response, containerClass) {
    // response means reply to comments

    var textarea = $(btn).siblings("textarea");
    var commentText = textarea.val();
    textarea.val("");
    // console.log(containerClass);


    if(commentText) {
        $.post("ajax/postComment.php", {commentText: commentText, postBy: postBy, videoId: videoId, responseTo: response})
        .done(function (comment) {

            $.post("ajax/totalComments.php", {videoId: videoId})
            .done(function (totalComments) {
                console.log(totalComments);
                $('.totalComments').text(totalComments + 'Comments');
            });

            // console.log(comment);

            if(!comment){
                $("." + containerClass).prepend(comment);           
            } else {
                if(containerClass === 'repliesSection') {          
                    $(btn).parent().siblings("." + containerClass).append(comment);
                } else if (containerClass === 'comments') {
                    $("." + containerClass).prepend(comment);           
                }
            } 
           
        });
    } else {
        // Empty 
    }
}

function toggleReplyButton(btn) {
    var parent = $(btn).closest(".commentContainer");
    var commentForm = parent.find(".commentForm").first();
    commentForm.toggleClass("hidden");
}

function likeComment(btn, commentId, videoId) {
    $.post("ajax/likeComment.php", {videoId: videoId, commentId: commentId})
    .done(function (data) {
        var likeButton = $(btn);
        var dislikeButton = $(btn).siblings(".dislikeButton");

        likeButton.addClass("active");
        dislikeButton.removeClass("active");

        var likeCount = $(btn).siblings(".likesCount");
        updateLikes(likeCount,data);
               
        if(data < 0) {
            likeButton.removeClass("active");
            likeButton.find('img:first').attr('src', "assets/image/icon/thumb-up.png");
        } else {
            likeButton.find('img:first').attr('src', "assets/image/icon/thumb-up-active.png");
        }
        dislikeButton.find('img:first').attr('src', "assets/image/icon/thumb-down.png");
    });
}

function dislikeComment(btn, commentId, videoId) {
    $.post("ajax/dislikeComment.php", {videoId: videoId, commentId: commentId})
    .done(function (data) {
        var dislikeButton = $(btn);
        var likeButton = $(btn).siblings(".likeButton");

        dislikeButton.addClass("active");
        likeButton.removeClass("active");

        var likeCount = $(btn).siblings(".likesCount");
        updateLikes(likeCount,data);
               
        if(data > 0) {
            dislikeButton.removeClass("active");
            dislikeButton.find('img:first').attr('src', "assets/image/icon/thumb-down.png");
        } else {
            dislikeButton.find('img:first').attr('src', "assets/image/icon/thumb-down-active.png");
        }
        likeButton.find('img:first').attr('src', "assets/image/icon/thumb-up.png");
    });
}

function updateLikes(ele, num) {
    var likeCountVal = ele.text() || 0; // If element have no text then return 0
    ele.text(parseInt(likeCountVal) + parseInt(num));
}

function getReplies(commentId, btn, videoId) {
    $.post("ajax/commentReply.php", {commentId: commentId, videoId: videoId})
    .done(function (commentsData) {
        // alert(commentsData);
        var replies = $("<div>").addClass('repliesSection');
        replies.append(commentsData);
        $(btn).replaceWith(replies);

    })
}

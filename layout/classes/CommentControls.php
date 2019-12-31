<?php
require_once("ButtonProvider.php"); 

class CommentControls {
    private $cn, $comment, $loggedInUser;  // comment class Object

    public function __construct($cn, $comment, $loggedInUser) {
        $this->cn = $cn;
        $this->comment = $comment;
        $this->loggedInUser = $loggedInUser;
    }

    public function create() {
        $replyButton = $this->replyButton();
        $replySection = $this->replySection();
        $likesCount = $this->likesCount();
        $likeButton = $this->likeButton();
        $dislikeButton = $this->dislikeButton();
        return "<div class='controls'>
                $likeButton
                $likesCount
                $dislikeButton                
                $replyButton
            </div>
            $replySection";
    }

    private function replyButton(){
        $text = "REPLY";
        $action = "toggleReplyButton(this)";

        return ButtonProvider::button(null, $action, null, $text);
    }

    private function likesCount(){
        $text = $this->comment->getLikes();

        if($text == 0)
            $text = "";
        return "<span class='likesCount'>$text</span>";
    }

    private function replySection(){
        $postedBy = $this->loggedInUser->getUsername();
        $videoId = $this->comment->getVideoId();
        $commentId = $this->comment->getId();

        $profileButton = ButtonProvider::userProfileButton($this->cn, $postedBy);

        $cancelButtonAction = "toggleReplyButton(this)";
        $cancelButton = ButtonProvider::button("cancelComment btn", $cancelButtonAction, null, "Cancel");

        $postButtonAction = "postComment(this, \"$postedBy\", $videoId, $commentId, \"repliesSection\")";
        $postButton = ButtonProvider::button("replyComment btn btn-primary", $postButtonAction, null, "Reply");

        return "<div class='commentForm hidden'>
                    $profileButton
                    <textarea class='commentBody' placeholder='Add Public comment'></textarea>
                    $cancelButton
                    $postButton
                </div>";
    }

    private function likeButton() {
        $commentId = $this->comment->getId();
        $videoId = $this->comment->getVideoId();

        $class = "likeButton";
        $action = "likeComment(this, $commentId, $videoId)";
        
        // Button image change is already liked
        $btnPath = ($this->comment->wasLiked()) ? "assets/image/icon/thumb-up-active.png" : "assets/image/icon/thumb-up.png";

        return ButtonProvider::button($class, $action, $btnPath, "");
    }

    private function dislikeButton() {
        $text = $this->comment->getDislikes();
        $commentId = $this->comment->getId();
        $videoId = $this->comment->getVideoId();

        $class = "dislikeButton";
        $action = "dislikeComment(this, $commentId, $videoId)";
        // Button image change is already liked
        $btnPath = ($this->comment->wasDisliked()) ? "assets/image/icon/thumb-down-active.png" : "assets/image/icon/thumb-down.png";
                
        return ButtonProvider::button($class, $action, $btnPath, "");
    }
}
?>
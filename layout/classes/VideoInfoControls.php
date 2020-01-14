<?php
require_once("./layout/classes/ButtonProvider.php"); 


class VideoInfoControls {
    private $video, $user;  // Video class Object

    public function __construct($video, $user) {
        $this->video = $video;
        $this->user = $user;
    }

    public function create() {
        $likeButton = $this->likeButton();
        $dislikeButton = $this->dislikeButton();
        return "<div class='controls'>
                $likeButton
                $dislikeButton
            </div>";
    }

    private function likeButton() {
        $text = $this->video->getLikes();
        $videoId = $this->video->getId();

        $class = "likeButton";
        $action = "likeVideo(this, $videoId)";
        
        // Button image change is already liked
        $btnPath = ($this->video->wasLiked()) ? "assets/image/icon/thumb-up-active.png" : "assets/image/icon/thumb-up.png";

        return ButtonProvider::button($class, $action, $btnPath, $text);
    }

    private function dislikeButton() {
        $text = $this->video->getDislikes();
        $videoId = $this->video->getId();

        $class = "dislikeButton";
        $action = "dislikeVideo(this, $videoId)";
        // Button image change is already liked
        $btnPath = ($this->video->wasDisliked()) ? "assets/image/icon/thumb-down-active.png" : "assets/image/icon/thumb-down.png";
                
        return ButtonProvider::button($class, $action, $btnPath, $text);
    }
}
?>
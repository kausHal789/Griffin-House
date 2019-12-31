<?php
require_once("User.php");

class CommentSection {

    private $cn, $video, $loggedInUser;  
    // video's Object
    // loggedinUser's Object

    public function __construct($cn, $video, $user) {
        $this->cn = $cn;
        $this->video = $video;
        $this->loggedInUser = $user;
    }

    public function create() {
        return $this->commentSection();
    }

    private function commentSection() {
        $totalComments = $this->video->getTotalComments();
        $postedBy = $this->loggedInUser->getUsername();
        $videoId = $this->video->getId();

        $commentButton = "";
        $profileButton = "";
        $textArea = "";
        if(User::userLoggedIn()) {
            $profileButton = ButtonProvider::userProfileButton($this->cn, $postedBy);
            $action = "postComment(this, \"$postedBy\", $videoId, null, \"comments\")";
            $commentButton = ButtonProvider::button("postComment btn btn-primary", $action, null, "COMMENT");
            $textArea = "<textarea class='commentBody' placeholder='Add Public comment'></textarea>";
        }

        // html text form for comment
        $comments = $this->video->getComments();
        $commentsItems = "";
        foreach ($comments as $comment) {
            $commentsItems .= $comment->create();
        }

        return "<div class='commentSection'>
                
                <div class='header'>
                    <span class='totalComments'>$totalComments Comments</span>
                    <div class='commentForm'>
                        $profileButton
                        $textArea 
                        $commentButton
                    </div>
                </div>

                <div class='comments'>
                    $commentsItems
                </div>
            </div>";
    }
}

?>
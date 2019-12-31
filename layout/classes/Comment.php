<?php
require_once("ButtonProvider.php");
require_once("CommentControls.php");

class Comment {

    private $cn, $sqlData, $loggedinUser, $videoId;

    public function __construct($cn, $input, $loggedinUser, $videoId) {
        $this->cn = $cn;

        if(! is_array($input)) {
            $query = $this->cn->prepare("SELECT * FROM comments WHERE id=:id");
            $query->bindParam(":id", $input);
            $query->execute();

            $input = $query->fetch(PDO::FETCH_ASSOC);
        }
        $this->sqlData = $input;
        $this->loggedinUser = $loggedinUser;
        $this->videoId = $videoId;
    }

    public function create() {
        $id = $this->getId();
        $videoId = $this->getVideoId();
        $body = $this->sqlData['body'];
        $postedBy = $this->sqlData['posted_by'];
        $profileButton = ButtonProvider::userProfileButton($this->cn, $postedBy);
        $time = $this->getTimestamp($this->sqlData['created_at']); // get time from database

        $commentControlObj = new CommentControls($this->cn, $this, $this->loggedinUser);
        $commentControls = $commentControlObj->create();

        $numResponses = $this->getNumberOfReplies();
        $viewRepliesText = ($numResponses > 0) ? 
            "<span class='repliesSection viewReplies' onclick='getReplies($id, this, $videoId)'>View all $numResponses replies</span>" : 
            "<div class='repliesSection'></div>";

        return "<div class='commentContainer'>
        
            <div class='comment'>
                $profileButton            
                <div class='mainCommentContainer'>

                    <div class='commentHeader'>
                        <a href='profile.php?user=$postedBy'>
                            <span class='username'>$postedBy</span>
                        </a>
                        <span class='time text-black-50'>$time</span>
                    </div>
                    <div class='commentBody'>
                        $body
                    </div>
                </div>
            </div>
            $commentControls
            $viewRepliesText
            </div>";
    }

    private function getTimestamp($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    private function getNumberOfReplies() {
        $query = $this->cn->prepare("SELECT count(*) as 'count' FROM comments 
            WHERE response_to=:responseTo");
        $query->bindParam(":responseTo", $responseTo);
        
        $responseTo = $this->getId();
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function getId() {
        return $this->sqlData['id'];
    }

    public function getVideoId() {
        return $this->videoId;
    }

    public function getLikes() {
        $query = $this->cn->prepare("SELECT count(*) as 'count' FROM likes WHERE commentid=:commentid");
        $query->bindParam(":commentid", $commentId);
        $commentId = $this->getId();
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['count'] - $this->getDislikes();
    }

    public function getDislikes() {
        $query = $this->cn->prepare("SELECT count(*) as 'count' FROM dislikes WHERE commentid=:commentid");
        $query->bindParam(":commentid", $commentId);
        $commentId = $this->getId();
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }

    public function like() {
        $commentId = $this->getId();        
        $username = $this->loggedinUser->getUsername();

        if($this->wasLiked()) {
            // already like

            $query = $this->cn->prepare("DELETE FROM likes WHERE username=:username AND commentid=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $commentId);
            $query->execute();
                   
            return -1;
            // "remove like";
        } else {
            // not like

            // Remove dislike from dislike table
            $query = $this->cn->prepare("DELETE FROM dislikes WHERE username=:username AND commentid=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $commentId);
            $query->execute();
            $count = $query->rowCount();

            $query = $this->cn->prepare("INSERT INTO likes (username, commentid) VALUES (:username, :commentId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $commentId);
            $query->execute();

            return $count + 1;
            // "like insert";
        }
    }

    public function wasLiked() {
        $commentId = $this->getId();
        $query = $this->cn->prepare("SELECT * FROM likes 
            WHERE username=:username AND commentid=:commentId");
        $query->bindParam(":username", $username);
        $query->bindParam(":commentId", $commentId);
        $username = $this->loggedinUser->getUsername();

        $query->execute(); 

        return $query->rowCount() > 0;
    }

    public function dislike() {
        $commentId = $this->getId();
        $username = $this->loggedinUser->getUsername();

        if($this->wasDisliked()) {
            // already dislike

            $query = $this->cn->prepare("DELETE FROM dislikes WHERE username=:username AND commentid=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $commentId);
            $query->execute();
    
            return 1;
            // echo "remove dislike";
        } else {
            // not dislike

            // Remove like from like table
            $query = $this->cn->prepare("DELETE FROM likes WHERE username=:username AND commentid=:commentId");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $commentId);
            $query->execute();
            $count = $query->rowCount();

            $query = $this->cn->prepare("INSERT INTO dislikes (username, commentid) VALUES (:username, :commentId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":commentId", $commentId);
            $query->execute();

            return -1 - $count;
            // echo "dislike insert";
        }
    }

    public function wasDisliked() {
        $commentId = $this->getId();
        $query = $this->cn->prepare("SELECT * FROM dislikes 
            WHERE username=:username AND commentid=:commentId");
        $query->bindParam(":username", $username);
        $query->bindParam(":commentId", $commentId);
        $username = $this->loggedinUser->getUsername();
        $query->execute();

        return $query->rowCount() > 0;
    }

    public function getReplies() {
        $query = $this->cn->prepare("SELECT * FROM comments 
            WHERE response_to=:commentId ORDER BY created_at DESC");
        $query->bindParam(":commentId", $commentId);
        $commentId = $this->getId();
        $query->execute();
        
        $videoId = $this->getVideoId();
        $comments = "";
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment($this->cn, $row, $this->loggedinUser, $videoId);
            $comments .= $comment->create();    // Set comment in formate
        }
        return $comments;
    }
    
}
?>
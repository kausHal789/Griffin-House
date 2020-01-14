<?php
require_once("Comment.php");


class Video {
    private $cn, $sqlData, $userData;

    // Input is a video id or a video's sqldata
    // It will be use in VideoGrid class
    public function __construct($cn, $input, $user) {
        $this->cn = $cn;
        $this->userData = $user;

        if(is_array($input)) {
            $this->sqlData = $input;
        } else {
            $query = $this->cn->prepare("SELECT * FROM videos WHERE id=:id");
            $query->bindParam(":id", $input);
            $query->execute();
    
            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }

    }

    public function incrementViews() {
        $query = $this->cn->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
        $query->bindParam(":id", $video_id);
        $video_id = $this->getId();
        $query->execute();

        $this->sqlData['views'] += 1;
    }

    public function like() {
        $videoId = $this->getId();        
        $username = $this->userData->getUsername();

        if($this->wasLiked()) {
            // already like

            $query = $this->cn->prepare("DELETE FROM likes WHERE username=:username AND videoid=:videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);
            $query->execute();
            
            $result = array(
                'likes' => -1,
                'dislikes' => 0
            );

            return json_encode($result);
            // echo "remove like";
        } else {
            // not like

            // Remove dislike from dislike table
            $query = $this->cn->prepare("DELETE FROM dislikes WHERE username=:username AND videoid=:videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);
            $query->execute();
            $count = $query->rowCount();

            $query = $this->cn->prepare("INSERT INTO likes (username, videoid) VALUES (:username, :videoId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);
            $query->execute();

            $result = array(
                'likes' => 1,
                'dislikes' => 0 - $count
            );

            return json_encode($result);
            // echo "like insert";
        }
    }

    public function wasLiked() {
        $videoId = $this->getId();
        $query = $this->cn->prepare("SELECT * FROM likes WHERE username=:username AND videoid=:videoId");
        $query->bindParam(":username", $username);
        $query->bindParam(":videoId", $videoId);
        $username = $this->userData->getUsername();

        $query->execute(); 

        return $query->rowCount() > 0;
    }

    public function dislike() {
        $videoId = $this->getId();
        $username = $this->userData->getUsername();

        if($this->wasDisliked()) {
            // already dislike

            $query = $this->cn->prepare("DELETE FROM dislikes WHERE username=:username AND videoid=:videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);
            $query->execute();
    
            $result = array(
                'dislikes' => -1,
                'likes' => 0
            );

            return json_encode($result);
            // echo "remove dislike";
        } else {
            // not dislike

            // Remove like from like table
            $query = $this->cn->prepare("DELETE FROM likes WHERE username=:username AND videoid=:videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);
            $query->execute();
            $count = $query->rowCount();

            $query = $this->cn->prepare("INSERT INTO dislikes (username, videoid) VALUES (:username, :videoId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);
            $query->execute();

            $result = array(
                'dislikes' => 1,
                'likes' => 0 - $count
            );

            return json_encode($result);
            // echo "dislike insert";
        }
    }

    public function wasDisliked() {
        $videoId = $this->getId();
        $query = $this->cn->prepare("SELECT * FROM dislikes WHERE username=:username AND videoid=:videoId");
        $query->bindParam(":username", $username);
        $query->bindParam(":videoId", $videoId);
        $username = $this->userData->getUsername();
        $query->execute();

        return $query->rowCount() > 0;
    }

    public function getId() {
        return $this->sqlData['id'];
    }

    public function getUsername() {
        return $this->sqlData['username'];
    }
    
    public function getTitle() {
        return $this->sqlData['title'];
    }
    
    public function getDescription() {
        return $this->sqlData['description'];
    }
    
    public function getUrl() {
        return $this->sqlData['url'];
    }

    public function getCategory() {
        return $this->sqlData['category'];
    }

    public function getPrivacy() {
        return $this->sqlData['privacy'];
    }

    public function getUploadDate() {
        return date("M j, Y", strtotime($this->sqlData['created_at']));
        // return $this->sqlData['created_at'];
    }

    public function getTimeStamp() {
        return date("M jS, Y", strtotime($this->sqlData['created_at']));
    }

    public function getViews() {
        return $this->sqlData['views'];
    }

    public function getDuration() {
        return $this->sqlData['duration'];
    }

    public function getLikes() {
        $query = $this->cn->prepare("SELECT count(*) as 'count' FROM likes 
                WHERE videoid=:videoid");
        $query->bindParam(":videoid", $videoId);
        $videoId = $this->getId();
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data['count'];
    }

    public function getDislikes() {
        $query = $this->cn->prepare("SELECT count(*) as 'count' FROM dislikes 
                WHERE videoid=:videoid");
        $query->bindParam(":videoid", $videoId);
        $videoId = $this->getId();
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data['count'];
    }

    public function getTotalComments() {
        $query = $this->cn->prepare("SELECT * FROM comments WHERE video_id=:videoId");
        $query->bindParam(":videoId", $videoId);
        $videoId = $this->getId();
        $query->execute();

        return $query->rowCount();
    }

    public function getComments() {
        $query = $this->cn->prepare("SELECT * FROM comments 
            WHERE video_id=:videoId AND response_to=0 ORDER BY created_at DESC");
        $query->bindParam(":videoId", $videoId);
        $videoId = $this->getId();
        $query->execute();

        $comments = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment($this->cn, $row, $this->userData, $videoId);
            // Set a formate for new comment
            array_push($comments, $comment);
        }
        return $comments;
    }

    public function getThumbnail() {
        $query = $this->cn->prepare("SELECT url FROM thumbnails WHERE selected=1 AND video_id=:videoId");
        $query->bindParam(":videoId", $videoId);

        $videoId = $this->getId();
        $query->execute();
        return $query->fetchColumn();
    }
}
?>
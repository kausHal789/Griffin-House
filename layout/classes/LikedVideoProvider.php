<?php

class LikedVideoProvider {
    private $cn, $loggedinUser;

    public function __construct($cn, $loggedinUser) {
        $this->cn = $cn;
        $this->loggedinUser = $loggedinUser;
    }

    public function getVideos() {
        $videos = array();
        $query = $this->cn->prepare("SELECT videoid FROM likes 
            WHERE username=:username AND commentid=0");

        $query->bindParam(":username", $username);
        $username = $this->loggedinUser->getUsername();
        $query->execute();
                              
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->cn, $row['videoid'], $this->loggedinUser);
            array_push($videos, $video);
        } 
        return $videos;
    }
}
?>
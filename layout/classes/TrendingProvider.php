<?php

class TrendingProvider {
    private $cn, $loggedinUser;

    public function __construct($cn, $loggedinUser) {
        $this->cn = $cn;
        $this->loggedinUser = $loggedinUser;
    }

    public function getVideos() {
        $videos = array();
        $query = $this->cn->prepare("SELECT * FROM videos 
            WHERE created_at >= now() - INTERVAL 7 DAY ORDER BY views DESC LIMIT 15");
        $query->execute();
                              
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->cn, $row, $this->loggedinUser);
            array_push($videos, $video);
        } 
        return $videos;
    }
}
?>
<?php
require_once("Video.php");

class SearchResultProvider {
    private $cn, $loggedinUser;

    public function __construct($cn, $loggedinUser) {
        $this->cn = $cn;
        $this->loggedinUser = $loggedinUser;
    }

    public function getVideos($trem, $orderBy) {
        $query = $this->cn->prepare("SELECT * FROM videos 
        WHERE title LIKE CONCAT('%', :term, '%') OR username LIKE CONCAT('%', :term, '%') 
        ORDER BY $orderBy DESC");

        $query->bindParam(":term", $trem);
        $query->execute();
        $videos = array();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->cn, $row, $this->loggedinUser);
            array_push($videos, $video);
        }
        return $videos;
    }
}
?>
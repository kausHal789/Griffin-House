<?php

class SelectThumbnail {

    private $cn, $video;

    public function __construct($cn, $video) {
        $this->video = $video;
        $this->cn = $cn;
    }

    public function create() {
        $thumbnails = $this->getThubmnails();
        $html = "";
        foreach ($thumbnails as $data) {
            $html .= $this->createThumbnailItem($data);
        }

        return "<div class='thumbnailItemsContainer'>
                    $html
               </div>";
    }

    private function getThubmnails() {
        $data = array();
        $query = $this->cn->prepare("SELECT * FROM thumbnails WHERE video_id=:videoId");
        $query->bindParam(":videoId", $videoId);
        $videoId = $this->video->getId();
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    private function createThumbnailItem($data) {
        $id = $data['id'];
        $videoId = $data['video_id'];
        $url = $data['url'];
        $selected = $data['selected'] == 1 ? "selected" : "";

        return "<div class='thumbnailItem $selected' onclick='setNewThumbnail($id, $videoId, this)'>
                <img src='$url' alt=''>
            </div>";
    }

}

?>
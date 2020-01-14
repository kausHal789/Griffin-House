<?php

class VideoGrid {

    private $cn, $loggedinUser;
    private $largeMode = false;
    private $gridClass = "videoGrid";

    public function __construct($cn, $loggedinUser) {
        $this->cn = $cn;
        $this->loggedinUser = $loggedinUser;  // object
    }   

    public function create($videos, $title, $showFilter) {
        // videos is video from search
        // title is a title of set of videos, means header
        // showFilter is a filter by

        if($videos == null) {
            // no video pass select random
            $videoItem = $this->generateItems();
        } else {
            // echo "hello";
            $videoItem = $this->generateItemsFromVideos($videos);
        }

        $header = ($title != null) ? $this->gridHeader($title, $showFilter) : "";

        return "$header
            <div class='$this->gridClass'>
                $videoItem
            </div>";
    }

    private function generateItems(){
        $query = $this->cn->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 15");
        $query->execute();

        $htmlElement = "";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->cn, $row, $this->loggedinUser);
            $videoItem = new VideoGridItem($video, true);
            $htmlElement .= $videoItem->create();
        }
        return $htmlElement;
    }

    private function generateItemsFromVideos($videos) {
        $htmlElement = "";

        foreach ($videos as $video) {
            $item = new VideoGridItem($video, true);
            $htmlElement .= $item->create();
        }

        return $htmlElement;
    }

    private function gridHeader($title, $showFilter) {
        $filter = "";

        if($showFilter) {
            $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $urlArray = parse_url($link); // parse string into array
            parse_str($urlArray['query'], $param);    
            unset($param['orderBy']);
            $newQuery = http_build_query($param);
            $newURL = basename($_SERVER['PHP_SELF']) . "?" . $newQuery;
            // var_dump($newURL);
            $filter = "<div class='right'>
                    <span class=''>Order By:</span>
                    <a href='$newURL&order_by=time'>Time</a>
                    <a href='$newURL&order_by=views'>Most viewed</a>

                </div>";
        }
        return "<div class='videoGridHeader'>
                <div class='left'>
                    $title
                </div>
                $filter
            </div>";
        return "";
    }

    public function createLarge($videos, $title, $showFilter) {
        $this->gridClass .= " large";
        $this->largeMode = true;
        return $this->create($videos, $title, $showFilter);
    }
}
?>
<?php

class VideoGridItem {

    // video object
    private $video, $largeMode;
    
    public function __construct($video, $largeMode){
        $this->video = $video;
        $this->largeMode = $largeMode;
    }

    public function create() {
        
        $thumbnail = $this->createThumbnail();
        $details = $this->createDetails();
    
        $url = "watch.php?v=" . $this->video->getId();
        
        return "<a href='$url'>
                <div class='videoGridItem'>
                    $thumbnail
                    $details
                </div>
            </a>";
    } 

    private function createThumbnail(){
        
        $thumbnail = $this->video->getThumbnail();
        $duration = $this->video->getDuration();
        return "<div class='thumbnail'>
                <img src='$thumbnail'>
                <div class='duration'>
                    <span>$duration</span>
                </div>
            </div>";
    }

    private function createDetails() {
        $title = $this->video->getTitle();
        $username = $this->video->getUsername();
        $views = $this->video->getViews();
        $uploadDate = $this->video->getTimeStamp(); // uploaded date
        
        $description = $this->trimDescription();

        return "<div class='details text-black-50'>
                <h4 class='title'>$title</h4>
                <span class='username'>$username</span>
                $description
                <div class='stats'>
                    <span class='views'>$views views · </span>
                    <span class='time'>$uploadDate</span>
                </div>
            </div>";
    }

    private function trimDescription() {
        if(! $this->largeMode) {
            return "";
        } else {
            $description = $this->video->getDescription();
            $description = strlen($description > 350) ? substr($description, 0, 347) . "..." : $description;
            return "<span class='description'>
                    $description
                </span>"; 
        }
    }

}

?>
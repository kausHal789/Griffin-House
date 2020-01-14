<?php
class VideoPlayer {
    
    private $video;  // Video class Object

    public function __construct($video) {
        $this->video = $video;
    }

    public function create($autoPlay) {
        if($autoPlay) {
            $autoPlay = "autoplay";
        } else {
            $autoPlay = "";
        }

        $videoPath = $this->video->getUrl();

        return "<video class='w-100 videoPlayer' controls $autoPlay>
                    <source src='$videoPath' type='video/mp4'>
                    Your Browser does not support this video
                </video>";
    }

}
?>
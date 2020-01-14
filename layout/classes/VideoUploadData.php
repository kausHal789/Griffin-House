<?php
class VideoUploadData {
    public $videoData, $title, $description, $category, $privacy, $username;
    
    public  function __construct($videoData, $title, $description, $category, $privacy, $username) {
        $this->videoData = $videoData;
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->privacy = $privacy;
        $this->username = $username;
    }

    // public function getTitle() {
    //     var_dump($this->videoData);
    // }
}
?>
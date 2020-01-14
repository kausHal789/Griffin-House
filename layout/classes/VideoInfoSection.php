<?php
require_once("./layout/classes/VideoInfoControls.php"); 


class VideoInfoSection {

    private $cn, $video, $user;  // Video class Object

    public function __construct($cn, $video, $user) {
        $this->cn = $cn;
        $this->video = $video;
        $this->user = $user;
    }

    public function create() {
        return $this->createPrimaryInfo(). $this->createSecondaryInfo();
    }

    private function createPrimaryInfo() {
        $title = $this->video->getTitle();
        $views = $this->video->getViews();

        $videoInfoControls = new VideoInfoControls($this->video, $this->user);
        $buttons = $videoInfoControls->create();

        return "<div class='w-100'>
                <p class='h4 d-block font-weight-normal'>$title</p>

                <div class='bottomSection d-flex text-black-50'>
                    <span class='views'>$views views</span>
                    $buttons
                </div>

            </div>";
    }

    private function createSecondaryInfo() {
        $description = $this->video->getDescription();
        $uploadDate = $this->video->getUploadDate();
        $username = $this->video->getUsername(); // uploaded by username
        $profileButton = ButtonProvider::userProfileButton($this->cn, $username);

        if($username == $this->user->getUsername()) {
            $button = ButtonProvider::editVideoButton($this->video->getId());
        } else {
            $userObj = new User($this->cn, $username);
            $button = ButtonProvider::subscribeButton($this->cn, $userObj, $this->user);
        }

        return "<div class='secondaryInfo'>
                <div class='top'>
                    $profileButton
                    <div class='uploadInfo'>
                        <span class='owner'><a href='profile.php?user=$username'>$username</a></span>
                        <span class='publishDate'>Published on $uploadDate</span>
                        </div>
                    <span>$button</span>
                </div>
                <div class='descriptionContainer'><p>$description</p></div>
            </div>";
    }


}
?>
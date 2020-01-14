<?php
require_once("Profile.php");
require_once("ButtonProvider.php");

class ProfileProvider {
    private $cn, $loggedinUser, $profileData;

    public function __construct($cn, $loggedinUser, $profileUsername) {
        $this->cn = $cn;
        $this->loggedinUser = $loggedinUser;
        $this->profileData = new Profile($cn, $profileUsername);
    }


    public function create() {
        if(! $this->profileData->userExists()) {
            return "Not okay";
        }

        $coverPhoto = $this->coverPhotoSection();
        $header = $this->headerSection();
        $tab = $this->tabSection();
        $content = $this->contentSection();

        return "<div class='profileContainer'>
                    $coverPhoto
                    $header
                    $tab
                    $content
                </div>";
    }

    public function coverPhotoSection() {
        $coverPhoto = $this->profileData->getCoverPhoto();
        $name = $this->profileData->getFullProfileName();
    
        return "<div class='coverPhotoContainer'>
            <img src='$coverPhoto' class='coverPhoto'>
            <div class='channelName'>$name</div>
        </div>";
    }

    public function headerSection() {
        $profile = $this->profileData->getProfileImage();
        $name = $this->profileData->getFullProfileName();
        $subs = $this->profileData->getProfileSubscribers();
        $subscribersButton = $this->subscribersButton();

        return "<div class='profileHeader'>
            <div class='userInfoContainer'>
                <img src='$profile' alt='' class='profileImage'>
                <div class='userInfo'>
                    <span class='title'>$name</span>
                    <span class='subscribers'>$subs subscribers</span>
                </div>
            </div>
            <div class='buttonContainer'>
                $subscribersButton
            </div>
        </div>";

    }

    public function tabSection() {
        return "<ul class='nav nav-tabs' id='myTab' role='tablist'>
            <li class='nav-item'>
            <a class='nav-link active' id='videos-tab' data-toggle='tab' href='#videos' role='tab' aria-controls='videos' aria-selected='true'>VIDEOS</a>
            </li>
            <li class='nav-item'>
            <a class='nav-link' id='about-tab' data-toggle='tab' href='#about' role='tab' aria-controls='about' aria-selected='false'>ABOUT</a>
            </li>
        </ul>";
    }

    public function contentSection() {
        $videos = $this->profileData->getVideos(); 

        if(sizeof($videos) > 0) {
            $videoGrid = new VideoGrid($this->cn, $this->loggedinUser);
            $videoGridHtml = $videoGrid->create($videos, null, false);
        } else{
            $videoGridHtml  ="<span>This user has no videos</span>";
        } 

        $detailSection = $this->aboutSection();
        
        return "<div class='tab-content channelContent' id='myTabContent'>
            <div class='tab-pane fade show active' id='videos' role='tabpanel' aria-labelledby='videos-tab'>
                $videoGridHtml
            </div>
            <div class='tab-pane fade' id='about' role='tabpanel' aria-labelledby='about-tab'>
                $detailSection
            </div>
        </div>";
    }

    private function subscribersButton() {
        if($this->loggedinUser->getUsername() === $this->profileData->getProfileUsername()) {
            $button = "";
        } else {
            $userObj = $this->profileData->getUserObj();
            return ButtonProvider::subscribeButton($this->cn, $userObj, $this->loggedinUser);
        }
    }

    private function aboutSection() {

        $html = "<div class='section'>
            <div class='title'>
                <span>Details</span>
            </div>
            <div class='values'>";
    
        $details = $this->profileData->getAboutDetails();
        foreach ($details as $key => $value) {
            if($key === "Joined Griffin House on") {
                $html .= "<span>$key $value</span>";
            } else {
                $html .= "<span>$key: $value</span>";
            }
        }
 
        $html .= "</div></div>";
        return $html;
    }

}

?>
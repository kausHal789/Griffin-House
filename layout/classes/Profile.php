<?php
class Profile {

    private $cn, $profileUsernameObj;

    public function __construct($cn, $profileUsername) {
        $this->cn = $cn;
        $this->profileUsernameObj = new User($cn, $profileUsername);
    }

    public function getUserObj() {
        return $this->profileUsernameObj;
    }

    public function getProfileUsername() {
        return $this->profileUsernameObj->getUsername();
    }

    public function userExists() {
        // $username = $this->getProfileUsername();
        $query = $this->cn->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam(":username", $username);
        $username = $this->getProfileUsername();
        $query->execute();

        return $query->rowCount() != 0;
    }

    public function getFullProfileName() {
        return $this->profileUsernameObj->getName();
    }

    public function getCoverPhoto() {
        return "storage/public/cover photo/cover.jpg";
    }

    public function getProfileImage() {
        return $this->profileUsernameObj->getProfileImage();
    }

    public function getProfileSubscribers() {
        return $this->profileUsernameObj->getSubscribers();
    }

    public function getVideos() {
        // $username = $this->getProfileUsername();
        $videos = array();
        $query = $this->cn->prepare("SELECT * FROM videos WHERE username=:username");
        $query->bindParam(":username", $username);
        $username = $this->getProfileUsername();
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->cn, $row, $this->getProfileUsername());
            array_push($videos, $video);
        }
        return $videos;
    }

    public function getAboutDetails() {
        return array(
            'Name' => $this->getFullProfileName(),
            'Username' => $this->profileUsernameObj->getUsername(),
            'Subscribers' => $this->profileUsernameObj->getSubscribers(), 
            'Total views' => $this->profileUsernameObj->getTotalViews(),
            'Joined Griffin House on' => $this->profileUsernameObj->getJoinData()
        );
    }

}
?>
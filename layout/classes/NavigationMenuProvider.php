<?php

class NavigationMenuProvider {

    private $cn, $loggedinUser;

    public function __construct($cn, $loggedinUser) {
        $this->cn = $cn;
        $this->loggedinUser = $loggedinUser;
    }

    public function create() {
        $htmlMenu = "";
        if(User::userLoggedIn()) {
            $username = $this->loggedinUser->getUsername();
            $htmlMenu .= $this->navItem("Profile", "assets/image/profile image/default.png", "profile.php?user=$username");
        }

        $htmlMenu .= $this->navItem("Home", "assets/image/icon/home.png", "index.php");
        $htmlMenu .= $this->navItem("Trending", "assets/image/icon/trending.png", "trending.php");
        $htmlMenu .= $this->navItem("Subscriptions", "assets/image/icon/subscriptions.png", "subscriptions.php");
        $htmlMenu .= $this->navItem("Likes", "assets/image/icon/thumb-up.png", "likedVideo.php");
        
        if(User::userLoggedIn()) {
            $htmlMenu .= $this->navItem("Settings", "assets/image/icon/settings.png", "settings.php");
            $htmlMenu .= $this->navItem("Log out", "assets/image/icon/logout.png", "logout.php");
            $subs = $this->subscriptionsSection();
        }

        $subs = isset($subs) ? $subs : "";

        // subscriptions menu
        return "<div class='navigationMenu'>
                $htmlMenu
                $subs
            </div>";
    }

    private function navItem($text, $icon, $link) {
        return "<div class='navigationItem'>
            <a href='$link'>
                <img src='$icon'>
                <span>$text</span>
            </a>
        </div>";
    }

    private function subscriptionsSection(){
        $subscription = $this->loggedinUser->getSubscription();
        $html = "<span class='heading'>
        Subscriptions
        </span>";
        foreach($subscription as $sub) {
            $username = $sub->getUsername();
            $html .= $this->navItem($username, $sub->getProfileImage(), "profile.php?user=$username");
        }
        return $html;
    }

}
?>
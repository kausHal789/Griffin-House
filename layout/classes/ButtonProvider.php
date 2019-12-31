<?php
class ButtonProvider {
    public static $signInFunction = "notSignIn()";

    public static function createLink($link) {
        // Function return bool
        return User::userLoggedIn() ? $link : ButtonProvider::$signInFunction;
    }

    public static function button($class, $action, $image, $text) {
        $image = ($image == null) ? "" : "<img src='$image'>";

        // change action if needed
        $action = ButtonProvider::createLink($action);

        return "<button class='$class' onclick='$action'>
                $image
                <span class='text'>$text</span>
        </button>";
    }

    public static function hyperlinkButton($class, $href, $image, $text) {
        $image = ($image == null) ? "" : "<img src='$image'>";

        return "<a href='$href'>
                <button class='$class'>
                    $image
                    <span class='text'>$text</span>
                </button>
            </a>";
    }

    public static function userProfileButton($cn, $username) {
        $user = new User($cn, $username);
        $profile = $user->getProfileImage();
        $link = "profile.php?user=$username";

        return "<a href='$link'>
                <img src='$profile' class='profileImage'>
            </a>";
    }

    public static function editVideoButton($videoId) {
        $class = "edit button";
        $href = "editVideo.php?v=$videoId";
        $image = null;
        $text = "Edit Video";
        $button = ButtonProvider::hyperlinkButton($class, $href, $image, $text);
        return "<div class='editButtonContainer'>
                $button
            </div>";
    }

    public static function subscribeButton($cn, $userObj, $loginUserObj) {
        // user is a owner of video
        // loginuser is a viewer

        $userTo = $userObj->getUsername();
        $loginUser = $loginUserObj->getUsername();
        $isSubscribed = $loginUserObj->isSubscribedTo($userTo);
        $buttonText = ($isSubscribed) ? "SUBSCRIBED" : "SUBSCRIBE";
        $buttonText .= " " . $userObj->getSubscribers();

        $buttonClass = $isSubscribed ? "unsubscribe button" : "subscribe button";
        $action = "subscribe(\"$userTo\", \"$loginUser\", this)";

        $button = ButtonProvider::button($buttonClass, $action, null, $buttonText);

        return "<div class='subscribeButtonContainer'>
            $button
            </div>";
    }

    public static function userProfileNavigationButton($cn, $username) {
        if(User::userLoggedIn()) {
            return ButtonProvider::userProfileButton($cn, $username);
        } else {
            return "<a href='signin.php'>
                    <span class='signin text-black-50'>SIGN IN</span>
                </a>";
        }
    }
}
?>
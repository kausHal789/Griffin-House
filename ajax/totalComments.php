<?php
require_once("../connection/config.php"); 
require_once("../layout/classes/Video.php");
require_once("../layout/classes/User.php");

if(isset($_POST['videoId'])) {
    $loggedInUser = new User($cn, $_SESSION['username']);
    $video = new Video($cn, $_POST['videoId'], $loggedInUser);
    echo $video->getTotalComments();
}
?>
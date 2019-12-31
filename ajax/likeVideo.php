<?php
require_once("../connection/config.php"); 
require_once("../layout/classes/Video.php"); 
require_once("../layout/classes/User.php"); 

$username = $_SESSION['username'];
$videoId = $_POST['videoId'];

$user = new User($cn, $username);
$video = new Video($cn, $videoId, $user);

echo $video->like();  // return result

?>
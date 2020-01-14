<?php
require_once("../connection/config.php"); 
require_once("../layout/classes/User.php"); 
require_once("../layout/classes/Comment.php"); 

$username = $_SESSION['username'];
$videoId = $_POST['videoId'];
$commentId = $_POST['commentId'];

$user = new User($cn, $username);
$comment = new Comment($cn, $commentId, $user, $videoId);

echo $comment->like();  // return result
?>
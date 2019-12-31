<?php
require_once("../connection/config.php"); 
require_once("../layout/classes/Comment.php");
require_once("../layout/classes/Video.php");
require_once("../layout/classes/User.php");



if(isset($_POST['commentText']) && $_POST['postBy'] && $_POST['videoId']) {
    $loggedInUser = new User($cn, $_SESSION['username']);

    $query = $cn->prepare("INSERT INTO comments (posted_by, video_id, response_to, body) 
    VALUES(:posted_by, :video_id, :response_to, :body)");
    $query->bindParam(":posted_by", $postBy);
    $query->bindParam(":video_id", $videoId);
    $query->bindParam(":response_to", $responseTO);
    $query->bindParam(":body", $commentText);

    $postBy = $_POST['postBy'];
    $videoId = $_POST['videoId'];
    $responseTO = isset($_POST['responseTo']) ? $_POST['responseTo'] : 0;
    $commentText = $_POST['commentText'];
     
    $query->execute();

    $newComment = new Comment($cn, $cn->lastInsertId(), $loggedInUser, $videoId);
    echo $newComment->create();
}

?>
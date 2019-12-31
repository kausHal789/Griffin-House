<?php
require_once("../connection/config.php");

if(isset($_POST['thumbnailId']) && isset($_POST['videoId'])) {
    $videoId = $_POST['videoId'];
    $thumbnailId = $_POST['thumbnailId'];

    $query = $cn->prepare("UPDATE thumbnails SET selected=0 WHERE video_id=:videoId");
    $query->bindParam(":videoId", $videoId);
    $query->execute();

    $query = $cn->prepare("UPDATE thumbnails SET selected=1 WHERE video_id=:videoId AND id=:thumbnailId");
    $query->bindParam(":videoId", $videoId);
    $query->bindParam(":thumbnailId", $thumbnailId);
    $query->execute();
    
}
?>
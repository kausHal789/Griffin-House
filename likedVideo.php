<?php 
require_once("./layout/header.php"); 
require_once("./layout/classes/LikedVideoProvider.php"); 

if(! User::userLoggedIn()) {
    header("Location:signin.php");
}
?>

<div id="mainContentContainer">

    <?php
    $likedVideo = new LikedVideoProvider($cn, $user);
    $videos = $likedVideo->getVideos();
    
    $videoGrid = new VideoGrid($cn, $user);
    ?>
    <div class="largeVideoGridContainer">
        <?php  
        if(sizeof($videos) > 0) {
            echo $videoGrid->createLarge($videos, "New videos from your Liked Video", false);
        } else {
            echo "No Liked Video result found";
        }
        ?>
    </div>

</div>

<?php require_once("./layout/footer.php");?>
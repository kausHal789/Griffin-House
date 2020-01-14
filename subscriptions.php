<?php 
require_once("./layout/header.php"); 

if(! User::userLoggedIn()) {
    header("Location:signin.php");
}
?>

<div id="mainContentContainer">

    <?php
    $Subscription = new SubscriptionProvider($cn, $user);
    $videos = $Subscription->getVideos();
    
    $videoGrid = new VideoGrid($cn, $user);
    ?>
    <div class="largeVideoGridContainer">
        <?php  
        if(sizeof($videos) > 0) {
            echo $videoGrid->createLarge($videos, "New videos from your Subscription", false);
        } else {
            echo "No Subscription result found";
        }
        ?>
    </div>

</div>

<?php require_once("./layout/footer.php");?>
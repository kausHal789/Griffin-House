<?php require_once("./layout/header.php");?>
<div id="mainContentContainer">
    
    <div class="videoSection">

    <?php
    $subscriptionProvider = new SubscriptionProvider($cn, $user);
    $subsVideos = $subscriptionProvider->getVideos();

    $videoGrid = new VideoGrid($cn, $user);
    if(User::userLoggedIn() && sizeof($subsVideos) > 0) {
        echo $videoGrid->create($subsVideos, "Subscriptions", false);
    }
    echo $videoGrid->create(null, "Recommended", false);
    ?>
    </div>

</div>
<?php require_once("./layout/footer.php");?>
        
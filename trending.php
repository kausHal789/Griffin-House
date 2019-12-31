<?php 
require_once("./layout/header.php");
require_once("./layout/classes/TrendingProvider.php");

?>

<div id="mainContentContainer">

    <?php
    $trending = new TrendingProvider($cn, $user);
    $videos = $trending->getVideos();
    
    $videoGrid = new VideoGrid($cn, $user);
    ?>
    <div class="largeVideoGridContainer">
        <?php  
        if(sizeof($videos) > 0) {
            echo $videoGrid->createLarge($videos, "Trending videos uploaded in last week", false);
        } else {
            echo "No trending result found";
        }
        ?>
    </div>

</div>

<?php require_once("./layout/footer.php");?>
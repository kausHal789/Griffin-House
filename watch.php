<?php 
require_once("./layout/header.php");
require_once("./layout/classes/VideoPlayer.php"); 
require_once("./layout/classes/VideoInfoSection.php"); 
require_once("./layout/classes/CommentSection.php"); 

?>
<script src="./assets/js/videoAction.js"></script>
<script src="./assets/js/commentAction.js"></script>
<div id="mainContentContainer">

<?php
if(! isset($_GET['v'])) {
    echo "404 PAGE NOT FOUND";
    exit();
}

$video = new Video($cn, $_GET['v'], $user);

if($video->getUsername() !== $user->getUsername()) {
    $video->incrementViews();
}

?>

<div class="leftVideoColumn">
    <?php 
    $videoPlayer = new VideoPlayer($video);
    echo $videoPlayer->create(0);

    $videoInfoSection = new VideoInfoSection($cn, $video, $user);
    echo $videoInfoSection->create();

    $commentsection = new CommentSection($cn, $video, $user);
    echo $commentsection->create();

    ?>
</div>

<div class="rightSuggestionsColumn pl-2">
    <?php
    $videoGrid = new VideoGrid($cn, $user);
    echo $videoGrid->create(null, null, false);
    ?>
</div>


</div>
<?php require_once("./layout/footer.php");?>
    
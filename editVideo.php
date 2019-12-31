<?php 
require_once("./layout/header.php");
require_once("./layout/classes/VideoPlayer.php"); 
require_once("./layout/classes/UploadVideoFormProvider.php"); 
require_once("./layout/classes/VideoUploadData.php"); 
require_once("./layout/classes/VideoProcessor.php"); 
require_once("./layout/classes/SelectThumbnail.php"); 

if(! User::userLoggedIn()) {
    header("Location:signin.php");
}

if(!isset($_GET['v'])) {
    echo "404 Page not found";
    exit();
}
$videoId = $_GET['v'];
$video = new Video($cn, $videoId, $user);

if($video->getUsername() !== $user->getUsername()) {
    echo "404 Page not found";
    exit();
}

if(isset($_POST['saveButton'])) {
    $videoData = new VideoUploadData(
        null,
        $_POST['title'], 
        $_POST['description'], 
        $_POST['categories'], 
        $_POST['privacyInput'],
        $user->getUsername() 
    );
    $videoProcessor = new VideoProcessor($cn);
    if($videoProcessor->updateVideoData($videoData, $videoId))
        echo "<script>alert('Video details Update Successfully');</script>";
    else {
        echo "<script>alert('Something went wrong, try after sometime');</script>";
    }
}


?>
<script src="assets/js/editVideoAction.js"></script>
<div id="mainContentContainer">

    <div class="editVideoContainer column">
        <div class="topSection">
            <?php
            $videoPlayer = new VideoPlayer($video);   
            echo $videoPlayer->create(false);
            $selectThumbnail = new SelectThumbnail($cn, $video);
            echo $selectThumbnail->create();
            ?>
        </div>
        <div class="bottomSection">
            <?php
                $formProvider = new UploadVideoFormProvider($cn);
                echo $formProvider->createEditVideoForm($video);
            ?>
        </div>
    </div>

</div>

<?php require_once("./layout/footer.php");?>
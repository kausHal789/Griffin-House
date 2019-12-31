<?php 
require_once("./layout/header.php");
require_once("./layout/classes/VideoUploadData.php");
require_once("./layout/classes/VideoProcessor.php");
if(! isset($_POST["uploadButton"])) {
    exit();
}

// create upload data
$videoUploadData = new VideoUploadData(
                    $_FILES["file"], 
                    $_POST["title"], 
                    $_POST["description"], 
                    $_POST["categories"], 
                    $_POST["privacyInput"], 
                    $user->getUsername());

// process video data(upload)
$videoProcessor = new VideoProcessor($cn);
$wasSuccesful = $videoProcessor->upload($videoUploadData); // return bool

// check video is uploaded
if($wasSuccesful) {
    echo "<h3>Upload Successful</h3>";
}
?>
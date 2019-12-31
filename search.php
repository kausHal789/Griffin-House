<?php 
require_once("./layout/header.php"); 
require_once("./layout/classes/SearchResultProvider.php"); 
require_once("./layout/classes/VideoGrid.php"); 

if(! isset($_GET['term']) || $_GET['term'] === "") {
    header("Location:index.php");
} 

$term = $_GET['term'];
if(! isset($_GET['order_by']) || $_GET['order_by'] === 'views') {
    $orderBy = 'views';
} else {
    $orderBy = 'created_at';
}

$searchProvider = new SearchResultProvider($cn, $user);
$videos = $searchProvider->getVideos($term, $orderBy);

$videoGrid = new VideoGrid($cn, $user);


?>
<div id="mainContentContainer">

<div class="largeVideoGridContainer">
    <?php  
    if(sizeof($videos) > 0) {
        echo $videoGrid->createLarge($videos, sizeof($videos) . " results found", true);
    } else {
        echo "No result found";
    }
    ?>
</div>

</div>
<?php require_once("./layout/footer.php");?>
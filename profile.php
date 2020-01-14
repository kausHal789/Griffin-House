<?php 
require_once("./layout/header.php");
require_once("./layout/classes/ProfileProvider.php");

if(isset($_GET['user'])) {
    $profileUsername = $_GET['user'];
} else {
    echo "404 Page not found";
    exit();
}
?>

<div id="mainContentContainer">

<?php
$profileProvider = new ProfileProvider($cn, $user, $profileUsername);
echo $profileProvider->create();

?>

</div>

<?php require_once("./layout/footer.php");?>

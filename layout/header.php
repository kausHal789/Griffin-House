 <?php 
require_once("./connection/config.php"); 
require_once("./layout/classes/User.php");
require_once("./layout/classes/Video.php"); 
require_once("./layout/classes/VideoGrid.php"); 
require_once("./layout/classes/VideoGridItem.php"); 
require_once("./layout/classes/ButtonProvider.php"); 
require_once("./layout/classes/SubscriptionProvider.php"); 
require_once("./layout/classes/NavigationMenuProvider.php"); 

$loggedInUsername = User::userLoggedIn() ? $_SESSION['username'] : "";

$user = new User($cn, $loggedInUsername);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Griffin</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="./assets/css/style.css">

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    
    <script src="./assets/js/commonAction.js"></script>
    <script src="./assets/js/userAction.js"></script>
</head>
<body>
    <div id="pageContainer">
        <div id="massHeadContainer">
            <button class="navShowHide">
                <img src="assets/image/icon/menu_32px.png" alt="menu">
            </button>
            
            <a href="index.php" class="logoContainer">
                <img src="assets/image/icon/henhouse_96px.png" alt="logo">
            </a>

            <div class="searchBarContainer">
                <form action="search.php" method="GET" >
                    <input type="text" class="searchBar" name="term" id="term" placeholder="Search">
                    <button class="searchButton" type="submit">
                        <img src="./assets/image/icon/search.png" alt="search">
                    </button>
                </form>
            </div>
            
            <?php 
            if(User::userLoggedIn()) { 
            ?>
            <div class="uploadButtonContainer">
                <a href="upload.php">
                    <button>
                        <img src="assets/image/icon/upload.png" alt="upload">
                    </button>
                </a>
            </div>
            <?php
            }
            ?>

            <div class="profileButtonContainer">
                <?php
                echo ButtonProvider::userProfileNavigationButton($cn, $user->getUsername());
                ?>
            </div>

        </div>

        <div id="sideNavigationBar" style="display:none;">
            <?php
            $navMenu = new NavigationMenuProvider($cn, $user);
            echo $navMenu->create();
            ?>
        </div>
        
        <div id="mainSectionContainer">
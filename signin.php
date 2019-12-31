<?php 
require_once("./connection/config.php"); 
require_once("./layout/classes/FormSanitizer.php"); 
require_once("./layout/classes/Account.php"); 
require_once("./layout/classes/Constants.php"); 

$account = new Account($cn);

if(isset($_POST['signinButton'])) {
    $username = FormSanitizer::snitizeFormUsername($_POST['username']);
    $password = FormSanitizer::snitizeFormPassword($_POST['password']);
    $wasSuccessful = $account->login($username, $password);

    if($wasSuccessful) {    
        $_SESSION['username'] = $_POST['username'];
        header("Location:index.php");
    }
}

function getInputedData($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Griffin</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/sign.css">

    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="signUpContainer">
        <div class="column p-4">
            <div class="header pt-3 pb-3">
                <div>
                    <img src="assets/image/icon/henhouse_96px.png" alt="logo" class="pb-4">
                    <span class="font-weight-normal h1">Griffin House</span>
                </div>
                <h5 class="font-weight-normal m-0 p-0">Sign In</h5>
                <span class="">to continue to Griffin House</span>
            </div>
            <div class="signupForm">
                <form action="" method="POST">
                    <?php echo $account->getError(Constants::$LOGIN_FAIL);?>
                    <input type="text" name="username" value="<?php getInputedData('username');?>" placeholder="Username" class="form-control-plaintext" autocomplete="off" required> 
                    <input type="password" name="password" placeholder="Password" class="form-control-plaintext" autocomplete="off" required> 
                    <button type="submit" class="btn btn-sm btn-primary" name="signinButton">SIGNIN</button>
                </form>
            </div>
            <a href="signup.php" class="text-black-50">Create an account? Sign up here!</a>
        </div>
    </div>    
</body>
</html>
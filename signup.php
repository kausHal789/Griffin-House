<?php 
require_once("./connection/config.php"); 
require_once("./layout/classes/FormSanitizer.php"); 
require_once("./layout/classes/Account.php"); 
require_once("./layout/classes/Constants.php"); 


$account = new Account($cn);
if(isset($_POST['signupButton'])) {
    $firstName = FormSanitizer::snitizeFormString($_POST['firstName']);
    $lastName = FormSanitizer::snitizeFormString($_POST['lastName']);
    $username = FormSanitizer::snitizeFormUsername($_POST['username']);
    $email = FormSanitizer::snitizeFormEmail($_POST['email']);
    $password = FormSanitizer::snitizeFormPassword($_POST['password']);
    $confirmPassword = FormSanitizer::snitizeFormPassword($_POST['confirmPassword']);

    $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $password, $confirmPassword);

    if($wasSuccessful) {
        // Success
        // redirect to index.php       
        $_SESSION['username'] = $username;
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
        <div class="column p-5">
            <div class="header pt-3 pb-3">
                <div>
                    <img src="assets/image/icon/henhouse_96px.png" alt="logo" class="pb-4">
                    <span class="font-weight-normal h2">Griffin House</span>
                </div>
                <h5 class="font-weight-normal m-0 p-0">Sign Up</h5>
                <span class="">to continue to Griffin House</span>
            </div>
            <div class="signupForm">
                <form action="" method="POST">

                    <?php echo $account->getError(Constants::$FIRST_NAME_CHARACHER);?>
                    <?php echo $account->getError(Constants::$FIRST_NAME_ONLY_CHARACHER);?>
                    <input type="text" name="firstName" class="form-control-plaintext" value="<?php getInputedData('firstName');?>" placeholder="First Name" autocomplete="off" required> 
                    
                    <?php echo $account->getError(Constants::$LAST_NAME_CHARACHER);?>
                    <?php echo $account->getError(Constants::$LAST_NAME_ONLY_CHARACHER);?>
                    <input type="text" name="lastName" value="<?php getInputedData('lastName');?>" placeholder="Last Name" class="form-control-plaintext" autocomplete="off" required> 
                    
                    <?php echo $account->getError(Constants::$USERNAME_TAKEN);?>
                    <?php echo $account->getError(Constants::$USERNAME_CHARACHER);?>
                    <input type="text" name="username" value="<?php getInputedData('username');?>" placeholder="Username" class="form-control-plaintext" autocomplete="off" required> 
                    
                    <?php echo $account->getError(Constants::$EMAIL_INVALID);?>
                    <?php echo $account->getError(Constants::$EMAIL_TAKEN);?>
                    <input type="email" name="email" value="<?php getInputedData('email');?>" placeholder="email" class="form-control-plaintext" autocomplete="off" required> 
                    
                    <?php echo $account->getError(Constants::$PASSWORD_CHARACHER);?>
                    <input type="password" name="password" placeholder="Password" class="form-control-plaintext" autocomplete="off" required> 
                    
                    <?php echo $account->getError(Constants::$PASSWORD_NOT_MATCH);?>
                    <input type="password" name="confirmPassword" placeholder="Re-enter Password" class="form-control-plaintext" autocomplete="off" required> 

                    <button type="submit" class="btn btn-sm btn-primary" name="signupButton">SIGNUP</button>
                </form>
            </div>
            <a href="signin.php" class="text-black-50">Already have an account? Sign in here!</a>
        </div>
    </div>    
</body>
</html>
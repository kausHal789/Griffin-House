<?php 
require_once("./layout/header.php");
require_once("./layout/classes/FormSanitizer.php"); 
require_once("./layout/classes/Account.php"); 
require_once("./layout/classes/Constants.php"); 
require_once("./layout/classes/SettingsFormProvider.php"); 

if(!User::userLoggedIn()) {
    header("Location:signin.php");
}

$account = new Account($cn);

if(isset($_POST['detailSubmitButton'])) {
    $firstName = FormSanitizer::snitizeFormString($_POST['firstname']);
    $lastName = FormSanitizer::snitizeFormString($_POST['lastname']);
    $email = FormSanitizer::snitizeFormEmail($_POST['email']);
    if($account->updateDetails($firstName, $lastName, $email, $user->getUsername())) {
        echo "<script>alert('Details Update Successfully');</script>";
        header("Location:settings.php");
    }
}

if(isset($_POST['passwordSubmitButton'])) {
    $oldpassword = FormSanitizer::snitizeFormPassword($_POST['oldPassword']);
    $newpassword = FormSanitizer::snitizeFormPassword($_POST['newPassword']);
    $confirmNewPassword = FormSanitizer::snitizeFormPassword($_POST['confrimNewPassword']);
    if($account->updatePassword($oldpassword, $newpassword, $confirmNewPassword, $user->getUsername())) {
        echo "<script>alert('Password Update Successfully');</script>";
        header("Location:settings.php");
    } 
}
?>

<div id="mainContentContainer">

<div class="settingContainer column">
    <div class="formSection offset-2 col-8">
        <div class="error">
            <?php 
            echo $account->getError(Constants::$FIRST_NAME_CHARACHER) . "\n";
            echo $account->getError(Constants::$FIRST_NAME_ONLY_CHARACHER) . "<br>";
            echo $account->getError(Constants::$LAST_NAME_CHARACHER). "\n";
            echo $account->getError(Constants::$LAST_NAME_ONLY_CHARACHER) . "<br>";
            echo $account->getError(Constants::$EMAIL_INVALID) . "\n";
            echo $account->getError(Constants::$EMAIL_TAKEN);
            ?>
        </div>
        <?php
        $form = new SettingsFormProvider();
        echo $form->createUserDetailForm(
            isset($_POST['firstname']) ? $_POST['firstname'] : $user->getFirstname(),
            isset($_POST['lastname']) ? $_POST['lastname'] : $user->getLastname(),
            isset($_POST['email']) ? $_POST['email'] : $user->getEmail()
        );
        echo "<hr>";
        echo $account->getError(Constants::$PASSWORD_NOT_MATCH) . "\n";
        echo $account->getError(Constants::$PASSWORD_CHARACHER);
        echo $form->createUserPasswordForm();
        ?>
    </div>
</div>


</div>

<?php require_once("./layout/footer.php");?>
<?php
class SettingsFormProvider {
    
    public function createUserDetailForm($firstName, $lastName, $email) {
        $firstNameInput = $this->firstNameInput($firstName);
        $lastNameInput = $this->lastNameInput($lastName);
        $emailInput = $this->emailInput($email);
        $saveButton = $this->saveButton("detailSubmitButton", "Update");

        return "
            <form action='#' name='videoUploadForm' method='POST'>
                <div class='mb-2 mt-3'>User Details</div>
                $firstNameInput
                $lastNameInput
                $emailInput
                $saveButton
                </form>";
    }

    public function createUserPasswordForm() {
        $oldInput = $this->passwordInput("oldPassword", "Old Password");
        $newInput = $this->passwordInput("newPassword", "New Password");
        $confirmInput = $this->passwordInput("confrimNewPassword", "Confirm New Password");
        $saveButton = $this->saveButton("passwordSubmitButton", "Update Password");

        return "
            <form action='#' name='passwordUploadForm' method='POST'>
                <div class='mb-2 mt-3'>Update Password</div>
                $oldInput
                $newInput
                $confirmInput
                $saveButton
                </form>";
    }

    private function firstNameInput($val) {
        if($val == null) $val = "";
        return "<div class='form-group'>
                <input type='text' class='form-control' value='$val' name='firstname' id='firstname' placeholder='First name' required>
            </div>";
    }

    private function lastNameInput($val) {
        if($val == null) $val = "";
        return "<div class='form-group'>
                <input type='text' class='form-control' value='$val' name='lastname' id='lastname' placeholder='Last name' required>
            </div>";
    }

    private function emailInput($val) {
        if($val == null) $val = "";
        return "<div class='form-group'>
                <input type='email' class='form-control' value='$val' name='email' id='email' placeholder='Email' required>
            </div>";
    }

    private function saveButton($name, $text) {
        return "<div class='form-group'>
                <button type='submit' class='btn btn-primary' name='$name'>$text</button>
            </div>";
    }

    private function passwordInput($name, $placeholder) {
        return "<div class='form-group'>
                <input type='password' class='form-control' name='$name' id='$name' placeholder='$placeholder' required>
            </div>";
    }
}
?>
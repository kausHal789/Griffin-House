<?php
require_once("./layout/classes/Constants.php"); 

class Account {
    private $cn;
    private $errors = array();

    public function __construct($cn) {
        $this->cn = $cn;
    }

    public function logIn($username, $password) {
        $password = hash("sha512", $password);
        
        $query = $this->cn->prepare("SELECT * FROM users 
            WHERE username=:username AND password=:password");

        $query->bindParam(":username", $username);
        $query->bindParam(":password", $password);
        $query->execute();

        if($query->rowCount() == 1) {
            return true;
        } else {
            array_push($this->errors, Constants::$LOGIN_FAIL);
            return false;
        }
    }

    public function register($firstName, $lastName, $username, $email, $password, $confirmPassword) {
        $this->validateFirstName($firstName);
        $this->validateLastName($lastName);
        $this->validateUsername($username);
        $this->validateEmail($email);
        $this->validatePassword($password);
        $this->commparePassword($password, $confirmPassword);

        if(empty($this->errors)) {
            return $this->insertUserData($firstName, $lastName, $username, $email, $password); // return bool
        } else {
            return false;
        }
    }

    public function updateDetails($firstName, $lastName, $email, $username) {
        $this->validateFirstName($firstName);
        $this->validateLastName($lastName);
        $this->validateNewUpdatedEmail($email, $username);

        if(empty($this->errors)) {
            return $this->updateUserData($firstName, $lastName, $email, $username);
        } else {
            return false;
        }
    }

    public function updatePassword($oldpassword, $newpassword, $confirmNewPassword, $username) {
        $newOldPassword = hash("sha512", $oldpassword);
        $query = $this->cn->prepare("SELECT * FROM users WHERE password=:password AND username=:username");
        $query->bindParam(":password", $newOldPassword);
        $query->bindParam(":username", $username);
        $query->execute();

        if(! $query->rowCount() > 0) {
            echo "<script>alert('Old Password does not match');</script>";
            header("Location:settings.php");
            return false;
        }
        
        $this->validatePassword($oldpassword);
        $this->validatePassword($newpassword);
        $this->validatePassword($confirmNewPassword);
        $this->commparePassword($newpassword, $confirmNewPassword);

        if(empty($this->errors)) {
            $newPassword = hash("sha512", $newpassword);
            return $this->updatePasswordData($newOldPassword, $newPassword, $username);
        }
    }

    private function updatePasswordData($oldpassword, $newPassword, $username) {
        $query = $this->cn->prepare("UPDATE users SET password=:newpassword WHERE password=:oldpassword AND username=:username");
        $query->bindParam(":newpassword", $newPassword);
        $query->bindParam(":oldpassword", $oldpassword);
        $query->bindParam(":username", $username);
        return $query->execute();
    }

    private function updateUserData($firstName, $lastName, $email, $username) {
        $query = $this->cn->prepare("UPDATE users SET firstname=:firstname, lastname=:lastname, email=:email WHERE username=:username");
        $query->bindParam(":username", $username);
        $query->bindParam(":firstname", $firstName);
        $query->bindParam(":lastname", $lastName);
        $query->bindParam(":email", $email);
        $query->execute();
        return true;
    }
    
    private function insertUserData($firstName, $lastName, $username, $email, $password) {
        $newPassword = hash("sha512", $password);
        $profile = "assets/image/profile image/cat_profile_96px.png";
        $query = $this->cn->prepare("INSERT INTO users (username, firstname, lastname, email, password, profile) 
            VALUES (:username, :firstname, :lastname, :email, :password, :profile)"); 
        $query->bindParam(":username", $username);
        $query->bindParam(":firstname", $firstName);
        $query->bindParam(":lastname", $lastName);
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $newPassword);
        $query->bindParam(":profile", $profile);
        $query->execute(); 
        return true;        
    }

    private function validateFirstName($name) {
        if(strlen($name) > 25 || strlen($name) < 2) {
            array_push($this->errors, Constants::$FIRST_NAME_CHARACHER);
            return;
        }
        if(preg_match("/[^a-zA-Z]/", $name)) {
            array_push($this->errors, Constants::$FIRST_NAME_ONLY_CHARACHER);
        }

    }

    private function validateLastName($name) {
        if(strlen($name) > 25 || strlen($name) < 2) {
            array_push($this->errors, Constants::$LAST_NAME_CHARACHER);
        }
        if(preg_match("/[^a-zA-Z]/", $name)) {
            array_push($this->errors, Constants::$LAST_NAME_ONLY_CHARACHER);
        }
    }

    private function validateUsername($username) {
        if(strlen($username) > 25 || strlen($username) <= 5) {
            array_push($this->errors, Constants::$USERNAME_CHARACHER);
            return;
        }

        $query = $this->cn->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam(":username", $username);
        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errors, Constants::$USERNAME_TAKEN);
            return;
        }
    }

    private function validateEmail($email) {
        if(! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, Constants::$EMAIL_INVALID);
            return;
        }

        $query = $this->cn->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindParam(":email", $email);
        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errors, Constants::$EMAIL_TAKEN);
            return;
        }
    }

    private function validateNewUpdatedEmail($email, $username) {
        if(! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, Constants::$EMAIL_INVALID);
            return;
        }

        $query = $this->cn->prepare("SELECT * FROM users WHERE email=:email AND username!=:username ");
        $query->bindParam(":email", $email);
        $query->bindParam(":username", $username);
        $query->execute();

        if($query->rowCount() != 0) {
            array_push($this->errors, Constants::$EMAIL_TAKEN);
            return;
        }
    }

    private function validatePassword($password) {
        if(strlen($password) > 25 || strlen($password) <= 8) {
            array_push($this->errors, Constants::$PASSWORD_CHARACHER);
            return;
        }
    }

    private function commparePassword($p1, $p2) {
        if($p1 != $p2) {
            array_push($this->errors, Constants::$PASSWORD_NOT_MATCH);
            return;
        }
    }

    public function getError($error) {
        if(in_array($error, $this->errors)) {
            return "<span class='error'>$error</span>";
        }
    }

}
?>
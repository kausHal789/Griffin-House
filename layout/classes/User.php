<?php
class User {
    private $cn, $sqlData;

    public function __construct($cn, $username) {
        $this->cn = $cn;

        $query = $this->cn->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam(":username", $username);
        $query->execute();

        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
    }

    public function isSubscribedTo($userTo) {
        // userTo is owner 
        $query = $this->cn->prepare("SELECT * FROM subscribers WHERE user_to=:userTo AND user_from=:userFrom");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $username);
        $username = $this->getUsername();
        $query->execute();

        return $query->rowCount() > 0;  // return bool
    }

    public function getSubscribers() {
        $query = $this->cn->prepare("SELECT * FROM subscribers WHERE user_to=:userTo");
        $query->bindParam(":userTo", $username);
        $username = $this->getUsername();
        $query->execute();

        return $query->rowCount();
    }

    public function getSubscription() {
        $query = $this->cn->prepare("SELECT * FROM subscribers WHERE user_from=:userFrom");
        $query->bindParam(":userFrom", $username);
        $username = $this->getUsername();
        $query->execute();

        $subs = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($this->cn, $row['user_to']);
            array_push($subs, $user);
        }
        return $subs;
    }

    public function getTotalViews() {
        $query = $this->cn->prepare("SELECT sum(views) AS 'views' FROM videos WHERE username=:username");
        $query->bindParam(":username", $username);
        $username = $this->getUsername();
        $query->execute();
        
        return $query->fetchColumn();
    }

    public static function userLoggedIn() {
        return isset($_SESSION['username']); // return bool
    }

    public function getUsername() {
        return $this->sqlData['username'];
    }

    public function getName() {
        return $this->sqlData['firstname'] . " " . $this->sqlData['lastname'];
    }

    public function getFirstname() {
        return $this->sqlData['firstname'];
    }

    public function getLastname() {
        return $this->sqlData['lastname'];
    }

    public function getEmail() {
        return $this->sqlData['email'];
    }

    public function getProfileImage() {
        return $this->sqlData['profile'];
    }

    public function getJoinData() {
        return date("F jS Y", strtotime($this->sqlData['created_at']));
    }
}
?>
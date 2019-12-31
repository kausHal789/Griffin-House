<?php

class SubscriptionProvider {

    private $cn, $loggedinUser;

    public function __construct($cn, $loggedinUser) {
        $this->cn = $cn;
        $this->loggedinUser = $loggedinUser;
    }

    public function getVideos() {
        $videos = array();
        $subscriptions = $this->loggedinUser->getSubscription();

        if(sizeof($subscriptions) > 0) {
            $condition = "";
            $i = 0;

            while ($i < sizeof($subscriptions)) {
                if($i == 0)
                    $condition .= "WHERE username=?";
                else
                    $condition .= " OR username=?";
                $i++;
            }
            $query = "SELECT * FROM videos $condition ORDER BY created_at DESC";
            $query = $this->cn->prepare($query);
            
            $i=1;
            foreach ($subscriptions as $sub) {
                $username = $sub->getUsername();
                $query->bindValue($i, $username);
                $i++;
            }

            $query->execute();
            
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $video = new Video($this->cn, $row, $this->loggedinUser);
                array_push($videos, $video);
            }
            

        } 
        return $videos;

    }

}

?>
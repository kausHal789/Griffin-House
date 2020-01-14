<?php
require_once("../connection/config.php"); 


if(isset($_POST['userTo']) && isset($_POST['userFrom'])) {
    $userTo = $_POST['userTo'];
    $userFrom = $_POST['userFrom'];

    // Check user is sub
    // if Yes - delete
    // if no - insert
    // return new subs
    // Check user is subbed
    $query = $cn->prepare("SELECT * FROM subscribers 
        WHERE user_to=:userTo AND user_from=:userFrom");
    $query->bindParam(":userTo", $userTo);
    $query->bindParam(":userFrom", $userFrom);
    $query->execute();
    $query->rowCount();    

    if($query->rowCount() === 0) {
        // No - insert
        $query = $cn->prepare("INSERT INTO subscribers(user_to, user_from) 
            VALUES(:userTo, :userFrom)");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();
    } else {
        // Yes - delete
        $query = $cn->prepare("DELETE FROM subscribers 
            WHERE user_to=:userTo AND user_from=:userFrom");
        $query->bindParam(":userTo", $userTo);
        $query->bindParam(":userFrom", $userFrom);
        $query->execute();
    }

    $query = $cn->prepare("SELECT * FROM subscribers 
        WHERE user_to=:userTo");
    $query->bindParam(":userTo", $userTo);
    $query->execute();

    // return new subs
    echo $query->rowCount();
    
} else {
    echo "This is Subscribe.php file you may make some mistack";
}

?>
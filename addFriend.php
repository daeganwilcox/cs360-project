<?php
include_once("db_connect.php");
$uid = $_SESSION['username'];
$userFriend = $_POST['userFriend'];

$qStr = "SELECT username FROM user WHERE username='$userFriend';";
$qRes = $db->query($qStr);

if($qRes-> rowCount() == 0){
    print "user does not exist, please try again";
}
else{
    $qStr = "INSERT INTO friend ('user1', 'user2') VALUES ('$uid', '$userFriend');";
    $qRes = $db->query($qStr);
    if($qRes == FALSE){
        print "Failure to add $userFriend";
    }
    else{
        print "Successfully added $userFriend, go back to your homepage to see an updated friends list";
    }
}
?>
<!--
Created by: Ricky Miranda
A function that attempts to add friends
from the userhome page.

file in sequence as a result of successful action: userhome.php
-->
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$userFriend = $_POST['userFriend'];

$qStr = "SELECT username FROM user WHERE username='$userFriend';";
$qRes = $db->query($qStr);

if($qRes == FALSE){
    include_once("base.php");
    printSQLError("for adding friends");
}

if($qRes-> rowCount() == 0){
    include_once("base.php");
    print "<div class='center'><H1>'$userFriend' does not exist</H1>";
    print "<H3>Please try sending another friend request on your home page.</H3></div>";
}
else{
    $qStr = "INSERT INTO `friend` (`user1`, `user2`) VALUES ('$uid', '$userFriend');";
    $qRes = $db->query($qStr);
    if($qRes == FALSE){
        include_once("base.php");
        printSQLError("for adding friends");
    }
    else{
        header("Location: http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/userhome.php"); //redirects to home page
    }
}
?>

<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$ouid = $_GET['friend'];

function checkFriends($db, $u1, $u2) {
    if ($u1 == null){
        print "<H5> You are not logged in. Please log in <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>here</a> </H5>";
        return FALSE;
    }
    if ($u2 == null ) {
        print "<H5>Invalid url format</H5>";
        return FALSE;
    }
    $qStr = "SELECT * FROM friend WHERE (user1='$u1' AND user2='$u2') OR (user1='$u2' AND user2='$u1');";
    $qRes = $db->query($qStr);
    if ($qRes == FALSE){
        printSQLError("for checking friendship");
        return FALSE;
    }

    if ($qRes->rowCount() != 2){
        print "<H5> You are not friends with $u2. </H5>";
        return FALSE;
    }
    return TRUE;
}
// needs to check the user accessing this page, and should have a POST where the user is given. right here should probably re indentify if they are still friends

// - user1 and user2 have a specific user message log in the database, pull here every 5 seconds
// - when a user sends a message, add to message log
?>


<!doctype html>
<html lang="en">

<?php include("base.php"); ?>

<?php 



?>

  

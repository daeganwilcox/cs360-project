<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$newWeight = $_POST['newWeight'];


$qStr = "UPDATE user SET weight = '$newWeight' WHERE username = '$uid';";
$qRes = $db->query($qStr);
if ($qRes == FALSE) {
    print "Failure to change weight";
} else {
    print "Successfully changed weight, go back to your homepage to see your change.";
}
?>

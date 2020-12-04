<!-- 
Created by: Ricky Miranda
A function that allows the user to 
change their weight that is stored 
in the database.

file in sequence as a result of successful action: userhome.php
-->
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$newWeight = $_POST['newWeight'];
?>

<!doctype html>
<html lang="en">
<?php include("base.php") ?>

<?php
$qStr = "UPDATE user SET weight = '$newWeight' WHERE username = '$uid';";
$qRes = $db->query($qStr);
if ($qRes == FALSE) {
    print "Failure to change weight";
} else {
    print "Successfully changed weight, go back to your homepage to see your change.";
}
?>

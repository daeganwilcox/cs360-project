<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$newHeight = $_POST['newHeight'];
?>
<!doctype html>
<html lang="en">
<?php include("base.php") ?>

<?php
$qStr = "UPDATE user SET height = '$newHeight' WHERE username = '$uid';";
$qRes = $db->query($qStr);
if ($qRes == FALSE) {
    print "Failure to change height";
} else {
    print "Successfully changed height, go back to your homepage to see your change.";
}
?>

<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
// needs to check the user accessing this page, and should have a POST where the user is given. right here should probably re indentify if they are still friends

// - user1 and user2 have a specific user message log in the database, pull here every 5 seconds
// - when a user sends a message, add to message log
?>


<!doctype html>
<html lang="en">

<?php include("base.php"); ?>
  

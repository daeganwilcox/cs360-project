<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
// needs to check the user accessing this page, and should have a POST where the user is given. right here should probably re indentify if they are still friends

// - user1 and user2 have a specific user message log in the database, pull here every 5 seconds
// - when a user sends a message, add to message log

// when user starts the page, it gets the dialogue. thus, when they send a message, it should update the dialogue
?>




<!doctype html>
<html lang="en">

<?php include("base.php"); ?>
  
<?php 
  print "<div style='width: 80%; height: 80%; overflow: auto;";
  
  
  
  print "<div>"
    
    
  print "<form class='form-signin' method='post' action='message.php'>";
  print "<textarea id='msgInput' class='form-control' placeholder='Message text' required></textarea>";
  print "<button class='btn btn-lg btn-primary btn-block' type='submit'>Send Message</button>";
  print "</form>";
  
?>
  

<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$friend = $_POST['friend'];
// needs to check the user accessing this page, and should have a POST where the user is given. right here should probably re indentify if they are still friends

$qStr1 = "SELECT * FROM friend WHERE user1 = '$uid' AND user2 = '$friend'";
$qStr2 = "SELECT * FROM friend WHERE user2 = '$uid' AND user1 = '$friend'";
// - user1 and user2 have a specific user message log in the database, pull here every 5 seconds
// - when a user sends a message, add to message log
$qRes1 = $db->query($qStr1);
$qRes2 = $db->query($qStr2);

if ($qRes1-> rowCount() == 0) {
  print "You have not friended this person yet.";
} else if ($qRes2 ->rowCount() == 0) {
  print "This person has not friended you yet.";
} else {
  include("base.php");
  print "<div style='width: 80%; height: 80%; overflow: auto;"; 
  print "</div>";
  print "<form class='form-signin' method='post' action='message.php'>";
  print "<textarea id='msgInput' class='form-control' placeholder='Message text' required></textarea>";
  print "<button class='btn btn-lg btn-primary btn-block' type='submit'>Send Message</button>";
  print "</form>";
}
 

// row count = 0
// when user starts the page, it gets the dialogue. thus, when they send a message, it should update the dialogue
?>


   
  

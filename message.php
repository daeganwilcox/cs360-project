<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$friend = $_GET['friend'];
$msg = $_GET['inputMsg'];
// needs to check the user accessing this page, and should have a POST where the user is given. right here should probably re indentify if they are still friends
$userpresent = $uid != NULL;


$qStr1 = "SELECT * FROM friend WHERE user1 = '$uid' AND user2 = '$friend'";
$qStr2 = "SELECT * FROM friend WHERE user2 = '$uid' AND user1 = '$friend'";
// - user1 and user2 have a specific user message log in the database, pull here every 5 seconds
// - when a user sends a message, add to message log

// when user starts the page, it gets the dialogue. thus, when they send a message, it should update the dialogue

$qRes1 = $db->query($qStr1);
$qRes2 = $db->query($qStr2);

if ($msg != NULL) {
  $currTime = date("Y-m-d H:i:s");
  $qIn = "INSERT INTO text('sender', 'receiver', 'time', 'msg') VALUES ('$uid', '$friend', '$currTime', '$msg');";
  $qInRes = db->query(qIn);
}


if ($qRes1-> rowCount() == 0) {
  print "You have not friended this person yet.";
  print "$uid";
  print "$friend";
} else if ($qRes2 ->rowCount() == 0) {
  print "This person has not friended you yet.";
} else {  
  include("base.php");
  $qStr = "SELECT * FROM texts WHERE (sender='$uid' AND receiver='$friend') OR (sender='$friend' AND receiver='$uid');"; 
  $qRes = $db->query($qStr);

  print "<div style='width: 80%; height: 80%; overflow: auto; margin: auto;'>"; 
  while ($row = $qRes->fetch()) {
    $message = $row['msg'];
    $sender = $row['sender'];
    $receiver = $row['receiver'];
    $date = $row['date'];
    
    if ($sender==$uid) {
      print "<h1 style='text-align: right;'>$message</h1>";
    } else if ($sender==$friend) {
      print "<h1 style='text-align: left;'>$message</h1>"; 
    }
  }
  
  print "</div>";
  
  
  print "<form class='form-signin' method='post' action='message.php/?friend=$friend'>";
  print "<textarea id='msgInput' class='form-control' placeholder='Message text' required></textarea>";
  print "<button class='btn btn-lg btn-primary btn-block' type='submit'>Send Message</button>";
  print "</form>";
}
 

// row count = 0
// when user starts the page, it gets the dialogue. thus, when they send a message, it should update the dialogue
?>


   
  

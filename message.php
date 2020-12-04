<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$friend = $_GET['friend'];
// needs to check the user accessing this page, and should have a POST where the user is given. right here should probably re indentify if they are still friends
$userpresent = $uid != NULL;
$msg = $_POST['msgInput'];

if ($msg != NULL) {
  $currTime = date("Y-m-d H:i:s");
  $qIn = "INSERT INTO `texts`(`sender`, `receiver`, `time`, `msg`) VALUES ('$uid','$friend','$currTime','$msg');";
  $qInRes = $db->query($qIn);
} 

$qStr1 = "SELECT * FROM friend WHERE user1 = '$uid' AND user2 = '$friend'";
$qStr2 = "SELECT * FROM friend WHERE user2 = '$uid' AND user1 = '$friend'";
// - user1 and user2 have a specific user message log in the database, pull here every 5 seconds
// - when a user sends a message, add to message log

// when user starts the page, it gets the dialogue. thus, when they send a message, it should update the dialogue

$qRes1 = $db->query($qStr1);
$qRes2 = $db->query($qStr2);

if ($qRes1-> rowCount() == 0) {
  print "You have not friended this person yet.";
  print "$uid";
  print "$friend";
} else if ($qRes2 ->rowCount() == 0) {
  print "This person has not friended you yet.";
} else {  
  include("base.php");
  print "<container>";
  print "<h2 style='text-align: center; margin: auto; width: 64%;'>You are speaking with $friend.<h2>";
  print "<br>";
  
  
  printChat($uid, $friend, $db);
  

  
  
  print "<form class='form-signin' method='post' action='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/message.php/?friend=$friend'>";
  print "<textarea style='width: 64%; margin: auto;' name='msgInput' class='form-control' placeholder='Message text' required></textarea>";
  print "<button class='btn btn-lg btn-primary btn-block' style='width: 64%; margin: auto;'type='submit'>Send Message</button>";
  print "</form>";
  
  print "<form class='form-signin' method='post' action='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/message.php/?friend=$friend'>";
  print "<button class='btn btn-lg btn-secondary btn-block' style='width: 64%; margin: auto;'type='submit'>Refresh Chat</button>";
  print "</form>";
  
  print "</container>";
  
//   while (TRUE) {
//     sleep(5);
//     printChat($uid, $friend, $db);
//   }
}
 
  function printChat($uid, $friend, $db) {
    print "<div style='max-height: 80%; overflow: auto; margin: auto;'>"; 
    $qStr = "SELECT * FROM texts WHERE (sender='$uid' AND receiver='$friend') OR (sender='$friend' AND receiver='$uid') ORDER BY time;"; 
    $qRes = $db->query($qStr);
    while ($row = $qRes->fetch()) {
      $message = $row['msg'];
      $sender = $row['sender'];
      $receiver = $row['receiver'];
      $date = $row['date'];
    
      if ($sender==$uid) {
        print "<ul class='list-group' style='width: 64%; margin: auto;'><li class='list-group-item'><h3 style='text-align: right; margin: auto;'>$message</h3></li></ul>";
        print "<h3>: You</h3>";
        print "<br>";
      } else if ($sender==$friend) {
        print "<h3>$friend:</h3>";
        print "<ul class='list-group' style='width: 64%; margin: auto;'><li class='list-group-item'><h3 style='text-align: left; margin: auto'>$message</h3></li></ul>";
        print "<br>";
      }
    }
  
  print "</div>"; 
  }
// row count = 0
// when user starts the page, it gets the dialogue. thus, when they send a message, it should update the dialogue
?>


   
  

<!-- 
Created by: Daegan Wilcox
this file allows a user to message someone else 
that is on their friend list. If the user tries 
to send a message to someone they are not friended 
yet, they are given that notification 

file in sequence: message-action.php
-->
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$friend = $_GET['friend'];
// needs to check the user accessing this page, and should have a POST where the user is given. 
$userpresent = $uid != NULL;
$msg = $_POST['msgInput']; // message from send message

if ($msg != NULL) { // if message exists (user clicked on submit message), it adds it to the table
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

if ($qRes1-> rowCount() == 0) { // not yet friended
  print "You have not friended this person yet.";
  print "$uid";
  print "$friend";
} else if ($qRes2 ->rowCount() == 0) { // not yet been friended
  print "This person has not friended you yet.";
} else {  // if both are friends
  include("base.php");
  
  print "<container>";
  print "<h2 style='text-align: center; margin: auto; width: 64%;'>You are speaking with $friend.<h2>";
  print "<br>";
  
  // prints the chat from the database
  printChat($uid, $friend, $db);
  
  print "<form class='form-signin' method='post' action='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/message.php/?friend=$friend'>";
  print "<textarea style='width: 64%; margin: auto;  margin-top: 5px;' name='msgInput' class='form-control' placeholder='Message text' required></textarea>";
  print "<button class='btn btn-lg btn-primary btn-block' style='margin: auto; margin-top: 5px; width: 64%;'type='submit'>Send Message</button>";
  print "</form>";
  
  print "<form class='form-signin' method='post' action='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/message.php/?friend=$friend'>";
  print "<button class='btn btn-lg btn-secondary btn-block' style='width: 64%; margin: auto; margin-top: 5px;'type='submit'>Refresh Chat</button>";
  print "</form>";
  
  print "</container>";
  
  // an attempt at live messaging that proved dangerous. oddly, the sleep function would not work
//   while (TRUE) {
//     sleep(5);
//     printChat($uid, $friend, $db);
//   }
}

  // prints the chat directly from the database. the chat must be manually refreshed
  function printChat($uid, $friend, $db) {
    print "<div style='max-height: 80%; overflow: auto; margin: auto;'>"; 
    $qStr = "SELECT * FROM texts WHERE (sender='$uid' AND receiver='$friend') OR (sender='$friend' AND receiver='$uid') ORDER BY time;"; 
    $qRes = $db->query($qStr);
    
    // for all messages between user and friend, prints them in order of time
    while ($row = $qRes->fetch()) {
      $message = $row['msg'];
      $sender = $row['sender'];
      $receiver = $row['receiver'];
      $date = $row['date'];
    
      if ($sender==$uid) { // if the tuple is of the user
        print "<ul class='list-group' style='width: 64%; margin: auto;'><li class='list-group-item'><h3 style='text-align: right; margin: auto;'>$message</h3></li></ul>";
        print "<br>";
      } else if ($sender==$friend) { // if the tuple is of the friend
        print "<ul class='list-group' style='background-color: #292b2c; width: 64%; margin: auto;'><li class='list-group-item'><h3 style='text-align: left; color: #808080; margin: auto'>$message</h3></li></ul>";
        print "<br>";
      }
    }
  
  print "</div>"; 
  }
?>


   
  

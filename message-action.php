<!-- 
Created by: Daegan Wilcox
this file deals with the process 
of sending a message to someone and 
saving that message to the database.

-->
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$msg = $_POST['inputMsg'];

if ($msg != NULL) {
  print "$msg";
  $currTime = date("Y-m-d H:i:s");
  $qIn = "INSERT INTO `texts`(`sender`, `receiver`, `time`, `msg`) VALUES ('$uid','$friend','$currTime','$msg');";
  
  $qInRes = $db->query($qIn);
}

?>
<!-- 
Created by: Collin Presser
Allows users edit their information 

file in sequence as a result of successful action: change-pass.php, change-img.php, or editSettings.php
-->
<?php
session_start();
$uid = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">
  <?php include("base.php"); ?>
  <body>
    <?php
    if($uid == NULL){
      printNotLoggedIn();
    }
    else{
      //prints the settings page
      print "<container>";
      print "<div style='text-align: center; margin: auto; width: 80%'>";
      print "<H1>Account Settings for $uid</H1>";
      print "<UL>";
      print "<LI><H3><A href=http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/change-pass.php>Change Password</A></H3></LI>";
      print "<LI><H3><A href=http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/change-img.php>Change Profile Picture</A></H3></LI>";
      print "<LI><H3><A href=http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/editSettings.php>Change Height/Weight</A></H3></LI>";
      print "</UL>";
      print "</container>";
    }
    ?>
  </body>
</html>

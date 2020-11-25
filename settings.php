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
      print "<H1>Account Settings for $uid</H1>";
      print "<UL>";
      print "<LI><H3><A href=http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/change-pass.php>Change Password</A></H3></LI>";
      print "<LI><H3><A href=http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/change-img.php>Change Profile Picture</A></H3></LI>";
      print "<LI><H3><A href=http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/editSettings.php>Change Height/Weight</A></H3></LI>";
      print "</UL>";
    }
    ?>
  </body>
</html>

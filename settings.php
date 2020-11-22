<?php
session_start();
$uid = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">
  <?php include("base.php") ?>
  <body>
    <?php
    if($uid == NULL){
      print "<H1>Not Logged In</H1>";
      print "<H3>Please try logging in <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>here</a>.</H3>";
    }
    else{
      print "<H1>Account Settings for $uid</H1>";
      print "<UL>";
      print "<LI><H3><A href=http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/change-pass.php>Change Password</A></H3></LI>";
      print "<LI><H3><A href=http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/change-img.php>Change Profile Picture</A></H3></LI>";
      print "<LI><H3><A href=http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/change-h.php>Change Height</A></H3></LI>";
      print "<LI><H3><A href=http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/change-w.php>Change Weight</A></H3></LI>";
      print "</UL>";
    }
    ?>
  </body>
</html>

<!-- 
Created by: Collin Presser
A function that allows the user to 
change their profile image that is 
stored in the database.

file in sequence as a result of successful action: userhome.php
-->
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$img = $_POST['img'];
?>

<!doctype html>
<html lang="en">
  <?php include("base.php") ?>
  <body>
    <?php
    //updates the profile image in SQL db
    function changeImageURL($url, $uid, $db){
      if (@GetImageSize($url) == FALSE) {
        printOpError("The given url is not a valid image.");
        return FALSE;
      }
      $qStr = "UPDATE user SET img = '$url' WHERE username = '$uid';";
      $qRes = $db->query($qStr);

      if($qRes == FALSE){
        printSQLError("for image update");
        return FALSE;
      }

      print "<H6>Profile Image Updated!</H6>";
      return TRUE;
    }
    //creates the page
    function showPage($img, $uid, $db){
      if($uid == NULL){
        print "<H1>Not Logged In</H1>";
        print "<H3>Please try logging in <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>here</a>.</H3>";
        return FALSE;
      }
      if($img != NULL){
        changeImageURL($img, $uid, $db);
      }
      print "<H1>Update Profile Image:</H1>";
      print "<FORM method='POST' action='change-img.php'>";
      print "<p>URL for image: <input type='text' name='img' required></p>";
      print "<p><input type='submit' value='Update Image'></p>";
      print "</FORM>";

    }
    showPage($img, $uid, $db);
    ?>
  </body>
</html>

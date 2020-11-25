<?php
include_once("db_connect.php");
include_once("login-signup-utils.php");
session_start();
$uid = $_SESSION['username'];
$old = $_POST['old'];
$new = $_POST['new'];
?>

<!doctype html>
<html lang="en">
  <?php include("base.php") ?>

  <?php
  //changes password
  function changePassword($db, $uid, $old, $new){
    $checkRes = checkUser($db, $uid, $old);
    if($checkRes == -3){
      printOpError("Incorrect previous password!");
      return FALSE;
    }
    else if($checkRes != 1){
      printOpError("Password verification error!");
      return FALSE;
    }
    $hash = md5($new);

    $qStr = "UPDATE user SET pHash = '$hash' WHERE username = '$uid';";
    $qRes = $db->query($qStr);

    if($qRes == FALSE){
      printSQLError("for password update");
      return FALSE;
    }

    print "<H6>Password Updated!</H6>";
    return TRUE;
  }

  //prints the page
  function printPage(){
    print "<H1>Update Password:</H1>";
    print "<FORM method='POST' action='change-pass.php'>";
    print "<p>Old Password: <input type='password' name='old' required></p>";
    print "<p>New Password: <input type='password' name='new' required></p>";
    print "<p><input type='submit' value='Update Password'></p>";
    print "</FORM>";
  }
  ?>

  <?php
  if($old != NULL && $new != NULL && $uid != NULL) changePassword($db, $uid, $old, $new);
  ?>
  <body>
    <?php
    if($uid == NULL){
      printNotLoggedIn();
    }
    else printPage();
    ?>
  </body>
</html>

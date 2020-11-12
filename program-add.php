<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$worked = TRUE;
if($_POST['name'] != NULL){
  $name = $_POST['name'];
  $desc = $_POST['desc'];
  $date = date("Y-m-d");
  $qStr = "INSERT INTO program VALUES('$uid', NULL, $name, $desc, $date)";
  $qRes = $db->query($qStr);
  if($qRes == FALSE){
    $worked = FALSE;
  }
  else{
    $pid = $db->lastInsertId();
    header("Location: http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/program-view.php/?id=$pid");
  }
}
?>

<!doctype html>
<html lang="en">
<?php include("base.php") ?>
<body>
  <main role="main">
    <?php
    if(!$worked){
      printOpError("Insert query failed");
    }
    if($uid == NULL){
      print "<H1>Not signed in!</H1>";
      print "<H3>Please <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>login</a> or <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/signup.html'>sign up</a> before creating a program.</H3>";
    }
    else{
      print "<form class='form-signin' method='post' action='program-add.php/'>";
      print "<img src='https://img.icons8.com/windows/64/000000/dumbbell.png' />";
      print "<h1 class='h3 mb-3 font-weight-normal'>Create a new program!</h1>";
      print "<label for='inputName' class='sr-only'>Program Name</label>";
      print "<input type='text' name='name' class='form-control' required autofocus>";
      print "<label for='inputDescription' class='sr-only'>Program Description</label>";
      print "<textarea class='form-control' name='desc' required></textarea>";
      print "<button class='btn btn-lg btn-primary btn-block' type='submit'>Create New Program!</button>";
      print "<p class='mt-5 mb-3 text-muted'>&copy; 2020-2020</p>";
      print "</form>";
    }
    ?>
  </main>
</body>
</html>

<?php
//gets the 5 most recent programs this user has used for their home page (less than 5 if they have done less than 5).
function getStartedPrograms(){
  $uid = $_SESSION['username'];
  $qStr = "SELECT name, programID AS id FROM ((SELECT DISTINCT programID FROM completed WHERE userID = '$uid' ORDER BY date_time) NATURAL JOIN program);";
  $qRes = $db->query($qStr);
  if($qRes == FALSE){
    print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
    return FALSE;
  }
  if($qRes-> rowCount() == 0){
    print "<H5>You haven't started any programs yet.</H5>";
    return TRUE;
  }
  for($i = 0; $i < 5 && $row = $qRes->fetch(); $i++){
    $name = $row['name'];
    $id = $row['id'];
    print "<div class="card-body">";
    print "<A href=http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/program-view.php/?id=$id>";
    print "<H4 class="card-text">$name</H4>";
    print "</A>";
    print "<div class="d-flex justify-content-between align-items-center">";
    print "</div>";
    print "</div>";
  }
  return TRUE;
}
?>

<?php
//gets the 5 most recent programs this user has used for their home page (less than 5 if they have done less than 5).
function getStartedPrograms(){
  $uid = $_SESSION['username'];
  $qStr = "SELECT name, programID AS id FROM ((SELECT DISTINCT programID FROM completed WHERE userID = '$uid' ORDER BY date_time) NATURAL JOIN program);";
  $qRes = $db->query($qStr);
  return $qRes;
}
?>

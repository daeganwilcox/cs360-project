<?php
include_once("db_connect.php");
?>

<!doctype html>
<html lang="en">
  <?php include("base.php") ?>
  <body>
    <?php
    $eid = $_GET['id'];
    if($eid == NULL){
      print "<H1>Missing Exercise ID</H1>";
      print "<H5>This link doesn't point to a specific exercise. Please make sure you have the correct address.</H5>";
    }
    else{
      $qStr = "SELECT * FROM exercise WHERE exerciseID = $eid;";
      $qRes = $db->query($qStr);

      //broken Query
      if($qRes == FALSE){
        printSQLError(1);
      }
      else{
        if($qRes->rowCount() == 0){
          print "<H1>Exercise Does Not Exist</H1>";
          print "<H5>This link points to a exercise which doesn't exist. Please make sure you have the correct address.</H5>";
        }
        else{
          $row = $qRes->fetch();
          $name = $row['name'];
          $desc = $row['description'];
          $met = $row['met'];
          $usesReps = $row['usesReps'] ? "" : "n't";
          $usesWeight = $row['usesWeight'] ? "" : "n't";
          print "<div style='text-align: center; margin: auto;'>";
          print "<H1>$name</H1>";
          print "<H5>$desc</H5>";
          print "<H6>Metabolic Equivalent of Task (MET): $met</H6>";
          print "<H6>This exercise <strong>does$usesReps</strong> use reps.</H6>";
          print "<H6>This exercise <strong>does$usesWeight</strong> use weight.</H6>";
          print "</div>";
        }
      }
    }
    ?>
  </body>
</html>

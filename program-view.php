<?php
include_once("db_connect.php");
session_start();
//$uid = $_SESSION['username']
//$userpresent = $uid != NULL;
?>

<!doctype html>
<html lang="en">
<?php include("base.php") ?>
<body>
  <main role="main">
    <?php
    function printSQLError($qnum){
      print "<H5>MySQL Error</H5>";
      print "<H5>There was a MySQL query error with query $qnum. Please contact one of our developers using our Contact Us page.</H5>";
    }
    function printPage(){
      $pid = $_GET['id'];
      //missing get input
      if($pid == NULL){
        print "<H1>Missing Program ID</H1>";
        print "<H5>This link doesn't point to a specific program. Please make sure you have the correct address.</H5>";
        return FALSE;
      }
      //query to get all basic information for heading
      $qstr1 = "SELECT name, description, creatorID, date_created FROM programs WHERE programID = $pid;";
      $qres1 = $db->query($qstr1);
      print "<H1>Made it!</H1>"; //debug
      //problem with query 1
      if($qres1 == FALSE){
        printSQLError(1);
        return FALSE;
      }
      $q1row = $qres1->fetch();
      //program does not exist
      if($q1row == FALSE){
        print "<H1>Program Does Not Exist</H1>";
        print "<H5>This link points to a program which doesn't exist. Please make sure you have the correct address.</H5>";
        return FALSE;
      }

      //heading variables
      $title = $q1row['name'];
      $desc = $q1row['description'];
      $creator = $q1row['creatorID'];
      $date = $q1row['date_created'];

      //print heading
      print "<H1>$title</H1>";
      print "<H3>Created by $creator on $date</H3>";
      print "<H5>$desc</H5>";

      //query to get the number of days of the program
      $qstr2 = "SELECT MAX(day) AS numDays FROM contains WHERE programID = $pid;";
      $qres2 = $db->query($qStr2);

      //problem with query 2
      if($qres2 == FALSE){
        printSQLError(2);
        return FALSE;
      }

      $q2row = $qres2->fetch();

      //program is empty
      if($q2row == FALSE){
        print "<H6>This program is empty.</H6>";
        return FALSE;
      }

      //holds the number of days this program is
      $days = $q2row['numDays'];

      //for each day print a table of the exercises
      for($i = 1; $i <= $days; $i++){
        //query to get table information
        $qstr3 = "SELECT name, reps, duration, weight, sets FROM contains NATURAL JOIN exercise WHERE programID = $pid AND day = $i;";
        $qres3 = $db->query($qStr3);

        //problem with query 3
        if($qres3 == FALSE){
          printSQLError(3);
          return FALSE;
        }

        //check if the day is empty
        if($qres->rowCount() == 0){
          print "<H6>Day $i is empty.</H6>";
        }
        else{
          print "<H6>Day $i:</H6>";
          print "<TABLE border='1'>";
          print "<TR><TH>Exercise</TH><TH>Reps</TH><TH>Duration</TH><TH>Weight</TH><TH>Sets</TH></TR>";
          while($row = $qres3->fetch()){
            //row values
            $exer = $row['name'];
            $reps = $row['reps'];
            $dur = $row['duration'];
            $weight = $row['weight'];
            $sets = $row['sets'];

            //rephrase nulls
            if($reps == NULL){
              $reps = "N/A";
            }
            if($dur == NULL){
              $dur = "N/A";
            }
            if($weight == NULL){
              $weight = "N/A";
            }

            //print row
            print "<TR><TD>$exer</TD>><TD>$reps</TD>><TD>$dur</TD>><TD>$weight</TD>><TD>$sets</TD></TR>";
          }
          print "</TABLE>";
        }
      }
    }
    printPage(); // prints the page
    ?>
  </main>
</body>

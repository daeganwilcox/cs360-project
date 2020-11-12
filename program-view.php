<?php
include_once("db_connect.php");
//session_start();
//$uid = $_SESSION['username'];
//$userpresent = $uid != NULL;
$userpresent = FALSE;
?>

<!doctype html>
<html lang="en">
<?php include("base.php") ?>
<body>
  <main role="main">
    <?php
    //make changes if called
    $op = $_GET['op'];
    if($op != NULL){
      $day = $_GET['day'];
      $pid = $_GET['id'];
      if($day == NULL || $pid == NULL){
        printOpError("URL formatted incorrectly");
      }
      else if($op == 'add'){
        $exer = $_POST['exercise'];
        $reps = $_POST['reps'];
        $dur = $_POST['duration'];
        $weight = $_POST['weight'];
        $sets = $_POST['sets'];
        if($exer == NULL || $reps == NULL || $dur == NULL || $weight == NULL || $sets == NULL){
          print "<H6 style='color:red'>ERROR processing your request: incorrect POST</H6>";
        }
        else{
          $qStrID = "SELECT exerciseID, usesReps, usesWeight FROM exercise WHERE name = $exer;";
          $qResID = $db->query($qStrID);

          if($qresID == FALSE){
            printOpError("ID query error");
          }

          else{
            $row = $qResID->fetch();
            $eid = $row['exerciseID'];

            if($row['usesReps']){
              $dur = "NULL";
            }
            else{
              $reps = "NULL";
            }
            if(!$row['usesWeight']){
              $weight = "NULL";
            }
            $qStrAdd = "INSERT INTO contains VALUES ($pid, $eid, $day, $reps, $dur, $weight, $sets);";
            $qResAdd = $db->query($qStrAdd);

            if($qresAdd == FALSE){
              printOpError("Add query error");
            }
            else{
              print "<H6>New exercise successfully added!</H6>";
            }
          }

        }
      }
      else if($op == 'del'){
        $worked = TRUE;
        foreach($_POST['key[]'] AS $eid){
          $qStrDel = "DELETE FROM contains WHERE exerciseID = $eid AND day = $day AND programID = $pid;";
          $qResDel = $db->query($qStrDel);
          if($qResDel == FALSE){
            printOpError("Delete query error");
            $worked = FALSE;
            break;
          }
        }
        if($worked){
          print "<H6>Exercises successfully removed!</H6>";
        }
      }
    }
    //prints which SQL query had an error when called
    function printSQLError($qnum){
      print "<H5>MySQL Error</H5>";
      print "<H5>There was a MySQL query error with query $qnum. Please contact one of our developers using our Contact Us page.</H5>";
    }
    //returns a string for the new exercise html form row
    function printNewExcerciseRow($exercises){
      $res = "<TR>";
      $res .= "<TD>";
      $res .= "<input list='exercises' name='exercise' required>";
      $res .= "<datalist id='exercises'>";
      foreach($exercises as $e){
        $res .= "<option value='$e'>";
      }
      $res .= "</datalist>";
      $res .= "</TD>";
      $res .= "<TD><input type='text' name='reps' placeholder='N/A'></TD>";
      $res .= "<TD><input type='text' name='duration' placeholder='N/A'></TD>";
      $res .= "<TD><input type='text' name='weight' placeholder='N/A'></TD>";
      $res .= "<TD><input type='text' name='sets' required></TD>";
      $res .= "<TD><input type='submit'></TD>";
      $res .= "</TR>";
      return $res;
    }
    //prints the page as it is supposed to be
    function printPage($db, $userpresent){
      $pid = $_GET['id'];
      //missing get input
      if($pid == NULL){
        print "<H1>Missing Program ID</H1>";
        print "<H5>This link doesn't point to a specific program. Please make sure you have the correct address.</H5>";
        return FALSE;
      }
      //query to get all basic information for heading
      $qstr1 = "SELECT name, description, creatorID, date_created FROM program WHERE programID = $pid;";
      $qres1 = $db->query($qstr1);
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

      //check if in edit mode
      $creatorpresent = FALSE;
      if($userpresent){
        $creatorpresent = $uid == $creator;
      }

      //get list of exercises for HTML forms
      $eList = [];
      if($creatorpresent){
        $qstrExer = "SELECT name, exerciseID FROM exercise;";
        $qresExer = $db->query($qstrExer);

        //problem with query for exercises
        if($qresExer == FALSE){
          printSQLError("'Exercise List'");
          return FALSE;
        }

        while($row = $qresExer->fetch() == FALSE){
          array_push($eList, $row['name']);
        }
      }

      //print heading
      print "<H1>$title</H1>";
      print "<H3>Created by $creator on $date</H3>";
      print "<H5>$desc</H5>";

      //query to get the number of days of the program
      $qstr2 = "SELECT MAX(day) AS numDays FROM contains WHERE programID = $pid;";
      $qres2 = $db->query($qstr2);

      //problem with query 2
      if($qres2 == FALSE){
        printSQLError(2);
        return FALSE;
      }

      $q2row = $qres2->fetch();
      $days = 0;

      //program is empty
      if($q2row == FALSE){
        print "<H6>This program is empty.</H6>";
        if(!$creatorpresent){
          return FALSE;
        }
      }
      else{
        //holds the number of days this program is
        $days = $q2row['numDays'];
        //print "<H6>Days = $days</H6>"; Debug

        //for each day print a table of the exercises
        for($i = 1; $i <= $days; $i++){
          //query to get table information
          $qstr3 = "SELECT name, reps, duration, weight, sets, exerciseID FROM contains NATURAL JOIN exercise WHERE programID = $pid AND day = $i;";
          $qres3 = $db->query($qstr3);

          //problem with query 3
          if($qres3 == FALSE){
            printSQLError(3);
            return FALSE;
          }

          //check if the day is empty
          if($qres3->rowCount() == 0){
            print "<H6>Day $i is empty.</H6>";
            if($creatorpresent){
              print "<H6>Add some exercises?</H6>";
              print "<TABLE border='1'>";
              print "<TR><TH>Exercise</TH><TH>Reps</TH><TH>Duration</TH><TH>Weight</TH><TH>Sets</TH><TH>Change</TH></TR>";
            }
          }
          else{
            print "<H6>Day $i:</H6>";
            print "<TABLE border='1'>";
            if($creatorpresent){
              print "<TR><TH>Exercise</TH><TH>Reps</TH><TH>Duration</TH><TH>Weight</TH><TH>Sets</TH><TH>Change</TH></TR>";
              print "<FORM action='program-view.php/?day=$i&id=$pid&op=del' method='POST'>";
            }
            else{
              print "<TR><TH>Exercise</TH><TH>Reps</TH><TH>Duration</TH><TH>Weight</TH><TH>Sets</TH></TR>";
            }
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
              print "<TR><TD>$exer</TD><TD>$reps</TD><TD>$dur</TD><TD>$weight</TD><TD>$sets</TD>";
              if($creatorpresent){
                $eid = $row['exerciseID'];
                print "<TD><INPUT type='checkbox' name='key[]' value='$eid'></TD>";
                print "</TR>";
              }
              print "</TR>";
            }
            if(!$creatorpresent){
              print "</TABLE>";
            }
            else{
              print "<TR></TR><TR></TR><TR></TR><TR></TR><TR></TR><TR><INPUT type='submit' value='remove'></TR>";
              print "</FORM>";
            }
          }
          if($creatorpresent){
            print "<FORM action='program-view.php/?day=$i&id=$pid&op=add' method='POST'>";
            print printNewExcerciseRow($eList);
            print "</FORM>";
            print "</TABLE>";
          }
        }
      }
      //edit mode (if creator is present): add day
      if($creatorpresent){
        $days++;
        print "<H6>Add Day $days?</H6>";
        print "<TABLE border='1'>";
        print "<TR><TH>Exercise</TH><TH>Reps</TH><TH>Duration</TH><TH>Weight</TH><TH>Sets</TH><TH>Change</TH></TR>";
        print "<FORM action='program-view.php/?day=$days&id=$pid&op=add' method='POST'>";
        print printNewExcerciseRow($eList);
        print "</FORM>";
        print "</TABLE>";
      }
    }
    printPage($db, $userpresent); // prints the page
    ?>
  </main>
</body>

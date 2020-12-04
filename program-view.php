<!--
Created by: Collin Presser
Allows users to view their current programs
and input information regarding program
completition.
If logged in as a program owner/editor,
the user can edit information regarding
exercise schemes for any day which will
apply the changes to everyone with that
program.

file in sequence as a result of successful action: program-view.php
-->
<script>
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'] . "?id=" . $_GET['id'];?>');
    }
</script>
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$userpresent = $uid != NULL;
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
      else if($op == 'save'){
        if(!$userpresent){
          //should never happen, but this is just in case
          printOpError("You must be logged in to save a program.");
        }
        $qStrSave = "INSERT INTO saved VALUES ($pid, '$uid');";
        $qResSave = $db->query($qStrSave);
        if($qResSave == FALSE){
          printOpError("You have already saved this program.");
        }
        else{
          print "<H6>Program Saved!</H6>";
        }
      }
      else if($op == 'review'){
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
        if($comment == NULL){
          $comment = "NULL";
        }
        else{
          $comment = "'" . $comment . "'";
        }
        if(!$userpresent){
          //should never happen, but this is just in case
          printOpError("You must be logged in to make a review.");
        }
        else if($rating == NULL){
          printOpError("POST formatted incorrectly");
        }
        else{
          $qStrAddReview = "INSERT INTO reviews VALUES ($pid, '$uid', $rating, $comment)";
          $qResAddReview = $db->query($qStrAddReview);

          if($qResAddReview == FALSE){
            printOpError("Add review query error");
          }
          else{
            print "<H6>Review added!</H6>";
          }

        }
      }
      else if($op == 'complete'){
        $opEid = $_GET['eid'];
        $time = $_POST['time'];
        if($opEid == NULL || $time == NULL){
          printOpError("URL formatted incorrectly");
        }
        else{
          $qStrMET = "SELECT met FROM exercise WHERE exerciseID = $opEid;";
          $qResMET = $db->query($qStrMET);

          if($qResMET == FALSE){
            printOpError("MET query error");
          }
          else if($qResMET->rowCount() == 0){
            printOpError("Invalid Exercise ID");
          }
          else{
            $METrow = $qResMET->fetch();
            $met = $METrow['met'];
            $qStrWeight = "SELECT weight FROM user WHERE username = '$uid';";
            $qResWeight = $db->query($qStrWeight);

            if($qResWeight == FALSE){
              printOpError("Weight query error");
            }
            else if($qResWeight->rowCount() == 0){
              printOpError("Invalid User ID");
            }
            else{
              $weightRow = $qResWeight->fetch();
              $weight = $weightRow['weight'];
              //pounds to kg
              $weight *= 0.453592;
              $cal = $weight*$met*$time/3600;
              $date_time = date("Y-m-d H:i:s");
              $qStrComplete = "INSERT INTO completed VALUES ('$uid', $day, $opEid, $pid, '$date_time', $cal);";
              $qResComplete = $db->query($qStrComplete);

              if($qResComplete == FALSE){
                printOpError("Complete query error");
              }
              else{
                print "<H6>Exercise completion recorded!</H6>";
              }
            }
          }
        }
      }
      else if($op == 'add'){
        $exer = $_POST['exercise'];
        $reps = $_POST['reps'];
        $dur = $_POST['duration'];
        $weight = $_POST['weight'];
        $sets = $_POST['sets'];
        if($exer == NULL || ($reps == NULL && $dur == NULL && $weight == NULL) || $sets == NULL){
          printOpError("incorrect POST");
        }
	       else{
          $qStrID = "SELECT exerciseID, usesReps, usesWeight FROM exercise WHERE name = '$exer';";
          $qResID = $db->query($qStrID);
          if($qResID == FALSE){
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

            if($qResAdd == FALSE){
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
        foreach($_POST['key'] AS $eid){
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
      $res .= "<TD><input type='text' name='sets' required></TD>";
      $res .= "<TD><input type='text' name='reps' placeholder='N/A'></TD>";
      $res .= "<TD><input type='text' name='duration' placeholder='N/A'></TD>";
      $res .= "<TD><input type='text' name='weight' placeholder='N/A'></TD>";
      $res .= "<TD>N/A</TD>";
      $res .= "<TD><input type='submit' value='Add Exercise'></TD>";
      $res .= "</TR>";
      return $res;
    }
    //prints the page as it is supposed to be
    function printPage($db, $userpresent, $uid){
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
      $eList = array();

      if($creatorpresent){
        $qstrExer = "SELECT name FROM exercise;";
        $qresExer = $db->query($qstrExer);

        //problem with query for exercises
        if($qresExer == FALSE){
          printSQLError("'Exercise List'");
          return FALSE;
        }

	       while($row = $qresExer->fetch()){
		         $exName = $row['name'];
             array_push($eList, $exName);
	       }

      }

      //print heading
      print "<div style='margin: auto; text-align: center;'>";
      print "<H1>$title</H1>";
      print "<H3>Created by $creator on $date</H3>";
      print "<H5>$desc</H5>";
      if($userpresent){
        print "<FORM method='post' action='program-view.php/?day=N/A&id=$pid&op=save'>";
        print "<input type='submit' value='Save Program'>";
        print "</FORM>";
      }
      print "</div>";

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
        $buttonReady = TRUE;
        $nextDay = -1;
        $nextExer = "";
        $nextEid = -1;
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
              print "<TABLE border='1' class='table'>";
              print "<TR><TH>Exercise</TH><TH>Sets</TH><TH>Reps</TH><TH>Duration</TH><TH>Weight</TH><TH>Change</TH></TR>";
            }
          }
          else{
            print "<H6>Day $i:</H6>";
            print "<TABLE border='1' class='table'>";
            if($creatorpresent){
              print "<TR><TH>Exercise</TH><TH>Sets</TH><TH>Reps</TH><TH>Duration</TH><TH>Weight</TH><TH>Completed</TH><TH>Add/Delete</TH></TR>";
              print "<FORM action='program-view.php/?day=$i&id=$pid&op=del' method='POST'>";

            }
            else if($userpresent){
              print "<TR><TH>Exercise</TH><TH>Sets</TH><TH>Reps</TH><TH>Duration</TH><TH>Weight</TH><TH>Completed</TH></TR>";
            }
            else{
              print "<TR><TH>Exercise</TH><TH>Sets</TH><TH>Reps</TH><TH>Duration</TH><TH>Weight</TH></TR>";
            }
            $done = array();
            if($userpresent){
              //query to get completed info
              $qstr4 = "SELECT exerciseID, calories FROM completed WHERE userID = '$uid' AND programID = $pid AND day = $i;";
              $qres4 = $db->query($qstr4);

              //problem with query 4
              if($qres4 == FALSE){
                printSQLError(4);
                return FALSE;
              }
              while($row = $qres4->fetch()){
                $exer = $row['exerciseID'];
                $cal = $row['calories'];
                $done[$exer] = $cal;
              }

            }
            while($row = $qres3->fetch()){
              //row values
              $eid = $row['exerciseID'];
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
              print "<TR><TD><a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/exercise-view.php/?id=$eid'>$exer</a></TD><TD>$sets</TD><TD>$reps</TD><TD>$dur</TD><TD>$weight</TD>";
              if($userpresent){
                $thisCal = $done[$eid];
                if($thisCal != NULL){
                  print "<TD>completed ($thisCal calories)</TD>";
                }
                else if($buttonReady){
                  print "<TD>NEXT TO COMPLETE</TD>";
                  $nextDay = $i;
                  $nextExer = $exer;
                  $nextEid = $eid;
                  $buttonReady = FALSE;
                }
                else{
                  print "<TD>not completed</TD>";
                }
              }
              if($creatorpresent){
                print "<TD><INPUT type='checkbox' name='key[]' value='$eid'></TD>";
              }
              print "</TR>";
            }
            if(!$creatorpresent){
              print "</TABLE>";
            }
            else{
              $col = $userpresent ? 7 : 6;
              print "<TR><TD colspan='$col'><INPUT type='submit' value='Remove Exercises'></TD></TR>";
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
        //complete button
        if($userpresent && $nextDay != -1){
          print "<div style='margin: auto; text-align: center;'>";
          print "<FORM action='program-view.php/?day=$nextDay&id=$pid&eid=$nextEid&op=complete' method='POST'>";
          print "<p>Time taken to complete $nextExer for day $nextDay (in seconds): <input type='text' name='time' required></p>";
          print "<p><INPUT type='submit' value='Submit Completion'></p>";
          print "</FORM>";
          print "</div>";
        }
      }
      //edit mode (if creator is present): add day
      if($creatorpresent){
        $days++;
        print "<H6>Add Day $days?</H6>";
        print "<TABLE border='1'>";
        print "<TR><TH>Exercise</TH><TH>Sets</TH><TH>Reps</TH><TH>Duration</TH><TH>Weight</TH><TH>Completed</TH><TH>Change</TH></TR>";
        print "<FORM action='program-view.php/?day=$days&id=$pid&op=add' method='POST'>";
        print printNewExcerciseRow($eList);
        print "</FORM>";
        print "</TABLE>";
      }

      //prints reviews:
      print "<H5>Reviews:</H5>";
      $qStrReview = "SELECT userID, rating, comment FROM reviews WHERE programID = $pid;";
      $qResReview = $db->query($qStrReview);

      //problem with review query
      if($qResReview == FALSE){
        printSQLError("for reviews");
        return FALSE;
      }


      if($userpresent){
	print "<div class='row'>";
	print "<div class='col-md-4'>";
        print "<FORM method='post' action='program-view.php/?day=N/A&id=$pid&op=review'>";
        print "<H6>Add a Review:</H6>";
        print "<p>Rating (1-10): <INPUT type='number' name='rating' min='1' max='10' required/></p>";
        print "<p>Comment: <textarea name='comment'></textarea></p>";
        print "<p><input type='submit' value='Add Review'></p>";
        print "</FORM>";
	print "</div>";
      }

      if($qResReview->rowCount() == 0){
        print "<H6>There are no reviews for this program.</H6>";
      }
      else{
	print "<div class='col-md-4'>";
        print "<DL>";
        while($row = $qResReview->fetch()){
          $user = $row['userID'];
          $rating = $row['rating'];
          $comment = $row['comment'];
          print "<DT>$user</DT>";
          print "<DD>- Rating: $rating";
          if($comment != NULL){
            print "<DD>- \"$comment\"";
          }
        }
        print "</DL>";
	print "</div>";
	print "</div>";
      }
   }
    printPage($db, $userpresent, $uid); // prints the page
    ?>
  </main>
</body>

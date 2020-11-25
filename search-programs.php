<?php
include_once("db_connect.php");
$search = $_POST['search'];
?>

<!doctype html>
<html lang="en">
  <?php include("base.php"); ?>

  <?php
    function printList($db, $search){
      //if search is null, search is empty so I don't have to check it
      $qStr = "SELECT name, program.programID AS id, date_created, AVG(rating) AS avg FROM program LEFT JOIN reviews ON program.programID = reviews.programID WHERE `name` LIKE '%%' GROUP BY program.programID ORDER BY AVG(rating) DESC";
      $qRes = $db->query($qStr);
      if($qRes == FALSE){
        printSQLError("for searching");
        return FALSE;
      }
      if($qRes->rowCount() == 0){
        print "<H3>None of the programs in our database have a name similar to your search request.</H3>";
        return TRUE;
      }
      print "<TABLE border='1' class='table'>";
      print "<TR><TH>Program Name</TH><TH>Average Rating</TH><TH>Date Created</TH></TR>";
      while($row = $qRes->fetch()){
        $id = $row['id'];
        $name = $row['name'];
        $avg = round($row['avg'], 2);
        $date = $row['date_created'];
        print "<TR>";
        print "<TD><a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/program-view.php/?id=$id'>$name</a></TD>";
        print "<TD>$avg</TD>";
        print "<TD>$date</TD>";
        print "</TR>";
      }
      print "</TABLE>";
    }
  ?>
  <body>
    <H1>Search for Programs:</H1>
    <p>
      <FORM method='post' action='search-programs.php'>
        Search Term: <INPUT type='text' name='search'/></INPUT type='submit' value='Search'/>
      </FORM>
    </p>
    <?php
    printList($db, $search);
    ?>
  </body>
</html>

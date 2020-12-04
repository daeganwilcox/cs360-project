<!-- 
Created by: Ricky Miranda
Allows users to view their current programs as well 
as view the programs they have created.

file in sequence as a result of successful action: program-view.php
-->
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
        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <h2>Programs you are a part of:</h2>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>description</th>
                                <th>Last Used</th>
                            </tr>
                            <?php
                            $qStr = "SELECT name, description, programID as id, max_date FROM (SELECT programID, MAX(date_time) AS max_date FROM completed WHERE userID = '$uid' GROUP BY programID) AS uComp NATURAL JOIN program ORDER BY max_date DESC;";
                            $qRes = $db->query($qStr);
                            if ($qRes == FALSE) {
                                print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                            } else if ($qRes->rowCount() == 0) {
                                print "<H5>You haven't started any programs yet.</H5>";
                            } else {
                                while ($row = $qRes->fetch()) {
                                    $name = $row['name'];
                                    $description = $row['description'];
                                    $date = $row['max_date'];
                                    $id = $row['id'];
                                    print "<tr>";
                                    print "<td>";
                                    print "<A href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/program-view.php/?id=$id'>";
                                    print "$name";
                                    print "</A>";
                                    print "</td>";
                                    print "<td>$description</td>";
                                    print "<td>$date</td>";
                                    print "</tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <h2>Programs you created:</h2>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>description</th>
                                <th>Date Created</th>
                            </tr>
                            <?php
                            $qStr = "SELECT name, programID as id, description, date_created AS date FROM program WHERE creatorID = '$uid';";
                            $qRes = $db->query($qStr);
                            if ($qRes == FALSE) {
                                print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                            } else if ($qRes->rowCount() == 0) {
                                print "<H5>You haven't started any programs yet.</H5>";
                            } else {
                                while ($row = $qRes->fetch()) {
                                    $name = $row['name'];
                                    $description = $row['description'];
                                    $date = $row['date'];
                                    $id = $row['id'];
                                    print "<tr>";
                                    print "<td>";
                                    print "<A href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/program-view.php/?id=$id'>";
                                    print "$name";
                                    print "</A>";
                                    print "</td>";
                                    print "<td>$description</td>";
                                    print "<td>$date</td>";
                                    print "</tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <h2>Programs you saved:</h2>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>description</th>
                                <th>Made by</th>
                                <th>Date Created</th>
                            </tr>
                            <?php
                            $qStr = "SELECT name, description, creatorID, date_created FROM program NATURAL JOIN saved WHERE traineeID = '$uid';";
                            $qRes = $db->query($qStr);
                            if ($qRes == FALSE) {
                                print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                            } else if ($qRes->rowCount() == 0) {
                                print "<H5>You haven't saved any programs yet.</H5>";
                            } else {
                                while ($row = $qRes->fetch()) {
                                    $name = $row['name'];
                                    $description = $row['description'];
                                    $creator = $row['creatorID'];
                                    $date = $row['date'];
                                    $id = $row['id'];
                                    print "<tr>";
                                    print "<td>";
                                    print "<A href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/program-view.php/?id=$id'>";
                                    print "$name";
                                    print "</A>";
                                    print "</td>";
                                    print "<td>$description</td>";
                                    print "<td>$creator</td>";
                                    print "<td>$date</td>";
                                    print "</tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </main>
</body>
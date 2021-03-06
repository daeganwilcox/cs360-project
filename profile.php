<!--
Created by: Ricky Miranda and Daegan Wilcox
Shows the selected friend's public profile page by
choosing the friend from the userhome page.
This shows the users information as well as
the programs that they are a part of.

file in sequence as a result of successful action: message.php (if messaging the user)
-->
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
$eid = $_GET['user']
?>


<!doctype html>
<html lang="en">

<?php include("base.php") ?>

<body>
    <main role="main">

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row" style="text-align: center; margin: auto;">
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img style="margin: auto;" id="userIcon" src="<?php
                                                                            //get img url
                                                                            $qStr = "SELECT img FROM user WHERE username='$eid';";
                                                                            $qRes = $db->query($qStr);
                                                                            if ($qRes == FALSE) {
                                                                                printSQLError("image");
                                                                            } else {
                                                                                $row = $qRes->fetch();
                                                                                $img = $row['img'];
                                                                                print "$img";
                                                                            }
                                                                            ?>" alt="" width="100px" height="100px">
                            <div class="card-object">
                                <h2><?php print $eid ?></h2>
                                <h5>Calories Burned: <?php
                                                        //for getting the total calories burned
                                                        $qStr = "SELECT SUM(calories) AS cals FROM `completed` WHERE userID = '$eid';";
                                                        $qRes = $db->query($qStr);
                                                        if ($qRes == FALSE) {
                                                            printSQLError("calories");
                                                        } else {
                                                            $row = $qRes->fetch();
                                                            $cals = $row['cals'];
                                                            print $cals != null ? "$cals" : 0;;
                                                        }
                                                        ?></h5>
                                <h5>Weight: <?php
                                            $qStr = "SELECT weight FROM user WHERE username='$eid';";
                                            $qRes = $db->query($qStr);
                                            if ($qRes == FALSE) {
                                                printSQLError("weight");
                                            } else {
                                                $row = $qRes->fetch();
                                                $weight = $row['weight'];
                                                print "$weight";
                                            }
                                            ?></h5>
                                <h5> Height: <?php
                                                $qStr = "SELECT height FROM user WHERE username='$eid';";
                                                $qRes = $db->query($qStr);
                                                if ($qRes == FALSE) {
                                                    printSQLError("height");
                                                } else {
                                                    $row = $qRes->fetch();
                                                    $height = $row['height'];
                                                    print "$height";
                                                }
                                                ?> inches</h5>
                                <div class="card-body">

                                    <a href="http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/message.php/?friend=<?php print $eid ?>">
                                        <h5 class="card-text">Message me!</h5>
                                    </a>

                                    <div class="d-flex justify-content-between align-items-center">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-object">
                                <h2> Most Recently Used Programs </h2>
                            </div>
                            <div>
                                <?php
                                $qStr = "SELECT name, programID AS id FROM (SELECT DISTINCT programID FROM completed WHERE userID = '$eid' ORDER BY date_time DESC) AS uComp NATURAL JOIN program;";
                                $qRes = $db->query($qStr);
                                if ($qRes == FALSE) {
                                    print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                                } else if ($qRes->rowCount() == 0) {
                                    print "<H5>They haven't started any programs yet.</H5>";
                                } else {
                                    for ($i = 0; $i < 5 && $row = $qRes->fetch(); $i++) {
                                        $name = $row['name'];
                                        $id = $row['id'];
                                        print "<div class='card-body'>";
                                        print "<A href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/program-view.php/?id=$id'>";
                                        print "<H4 class='card-tex'>$name</H4>";
                                        print "</A>";
                                        print "<div class='d-flex justify-content-between align-items-center'>";
                                        print "</div>";
                                        print "</div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-4 shadow-sm">
                            <h2>Programs Saved:</h2>
                            <table>
                                <tr>
                                    <th>Name</th>
                                    <th>description</th>
                                    <th>Made by</th>
                                    <th>Date Created</th>
                                </tr>
                                <?php
                                $qStr = "SELECT name, description, programID as id, creatorID, date_created FROM program NATURAL JOIN saved WHERE traineeID = '$eid';";
                                $qRes = $db->query($qStr);
                                if ($qRes == FALSE) {
                                    print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                                } else if ($qRes->rowCount() == 0) {
                                    print "<H5>They haven't saved any programs yet.</H5>";
                                } else {
                                    while ($row = $qRes->fetch()) {
                                        $name = $row['name'];
                                        $description = $row['description'];
                                        $creator = $row['creatorID'];
                                        $date = $row['date_created'];
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
        </div>
        </div>
    </main>
</body>

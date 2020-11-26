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
        <div class="row">
            <div class="col-md-2">
                <div class="card mb-2 shadow-sm">
                    <img id="userIcon" src="<?php
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
                                                    print "$cals";
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

                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card mb-2 shadow-sm">
                        <h2> Programs </h2>
                        <div>
                            <?php
                            $qStr = "SELECT name, programID AS id FROM (SELECT DISTINCT programID FROM completed WHERE userID = '$uid' ORDER BY date_time DESC) AS uComp NATURAL JOIN program;";
                            $qRes = $db->query($qStr);
                            if ($qRes == FALSE) {
                                print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                            } else if ($qRes->rowCount() == 0) {
                                print "<H5>You haven't started any programs yet.</H5>";
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
            </div>
        </div>
    </main>
</body>
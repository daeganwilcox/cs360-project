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
        <div class="row">
            <div class="col-md-2">
                <div class="card mb-4 shadow-sm">
                    <div class="card-object">
                        <h2>Programs you are a part of:</h2>
                    </div>
                    <?php
                    $qStr = "SELECT name, programID AS id FROM (SELECT DISTINCT programID FROM completed WHERE userID = '$uid' ORDER BY date_time) AS uComp NATURAL JOIN program;";
                    $qRes = $db->query($qStr);
                    if ($qRes == FALSE) {
                        print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                    } else if ($qRes->rowCount() == 0) {
                        print "<H5>You haven't started any programs yet.</H5>";
                    } else {
                        while ($qRes->fetch()) {
                            $row = $qRes->fetch();
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

            <div class="col-md-2">
                <div class="card mb-4 shadow-sm">
                    <div class="card-object">
                        <h2>Programs you have created:</h2>
                    </div>
                    <?php
                    $qStr = "SELECT name, programID AS id FROM program WHERE creatorID = '$uid';";
                    $qRes = $db->query($qStr);
                    if ($qRes == FALSE) {
                        print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                    } else if ($qRes->rowCount() == 0) {
                        print "<H5>You haven't started any programs yet.</H5>";
                    } else {
                        while ($qRes->fetch()) {
                            $row = $qRes->fetch();
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
    </main>
</body>
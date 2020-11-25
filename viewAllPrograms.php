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
            <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <h2>Programs you are a part of:</h2>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>description</th>
                        <th>Last Used</th>
                    </tr>
                    <?php
                    $qStr = "SELECT name, programID as id, description, MAX(date_time) AS date FROM (SELECT DISTINCT programID, date_time FROM completed WHERE userID = '$uid' ORDER BY date_time) AS uComp NATURAL JOIN program;";
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
        </div>
        </div>
    </main>
</body>

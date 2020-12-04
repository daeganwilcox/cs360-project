<!-- 
Created by: Ricky Miranda
A file that displays the current height 
and weight of the user and allows them 
input their new height or weight. 

file in sequence as a result of successful action: change-h.php OR change-w.php
-->
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">
<?php include("base.php") ?>

<body>
    <?php
    $qStr = "SELECT weight, height FROM user WHERE username='$uid';";
    $qRes = $db->query($qStr);
    if ($qRes == FALSE) {
        print "SQL error. Please contact one of our developers.";
    } else {
        $row = $qRes->fetch();
        $weight = $row['weight'];
        $height = $row['height'];
        print "<h5> Weight: ";
        print "$weight ";
        print "</h5>";
        print "<h5> Height: ";
        print "$height ";
        print "</h5>";
    }
    ?>
    <div>
        <form action="change-h.php" method="post">
            <p>
                New Height:<input type="text" id="newHeight" name="newHeight">
            </p>
            <button class="btn btn-outline-success btn-block" type="submit">Change Height</button>
        </form>
    </div>
    <div>
        <form action="change-w.php" method="post">
            <p>
                New Weight:<input type="text" id="newWeight" name="newWeight">
</p>
            <button class="btn btn-outline-success btn-block" type="submit">Change Weight</button>
        </form>
    </div>

</body>

</html>
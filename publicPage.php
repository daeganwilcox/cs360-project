<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
?>


<!doctype html>
<html lang="en">

<?php include("base.php") ?>

<body>
    <main role="main">
        <div class="row">
            <div class="col-md-2">
                <div class="card mb-2 shadow-sm">
                    <h2> Users </h2>
                    <?php
                    $qStr = "SELECT username FROM user";
                    $qRes = $db->query($qStr);
                    if($qRes == FALSE){
                        print "<H5> SQL ERROR. Please contact one of our developers. </H5>";
                    }
                    else{
                        while($row = $qRes->fetch()){
                            $username = $row['username'];
                            print "<div class= 'card-body'>";
                            print "<a href = http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/profile.php/?user=$username>";
                            print "<p> $username </p>";
                            print "</a>";
                            print "</div>";
                        }
                    }
                    ?>
                </div>
            </div>
    </main>
</body>
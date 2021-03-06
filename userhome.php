<!--
Created by: Collin Presser, Daegan Wilcox, and Ricky Miranda
Allows users to view their current dashboard that
displays their current programs, their personal information,
and their friends as well as have the ability to add friends.

file in sequence as a result of successful action: program-view.php
-->
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
if ($uid == null){
  header("Location: http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html");
}
?>


<!doctype html>
<html lang="en">

<?php include("base.php"); ?>

<body>
  <main role="main">

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">

          <!-- Programs -->
          <div class="col-md-6">
            <div class="card mb-6 shadow-sm">
              <div class="card-object">
                <h2>Programs</h2>
              </div>
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
            <div class='card-object'>
              <form action='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/program-add.php' method='post'>
                <button class="btn btn-outline-primary btn-block" type="submit">Make New Program</button>
              </form>
            </div>
            <div class='card-object'>
              <form action='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/search-programs.php' method='post'>
                <button class="btn btn-outline-primary btn-block" type="submit">Find New Programs</button>
              </form>
            </div>
            <div class='card-object'>
              <form action = 'http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/viewAllPrograms.php' method='post'>
                <button class="btn btn-outline-primary btn-block" type="submit">View Your Programs</button>
              </form>
            </div>
          </div>



          <div class="col-md-6">
            <div class="card mb-6 shadow-sm">
              <img id="userIcon" src="<?php
              //get img url
              $qStr = "SELECT img FROM user WHERE username='$uid';";
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
	      <h2><?php print $uid?></h2>
                <h5>Calories Burned: <?php
                //for getting the total calories burned
                $qStr = "SELECT SUM(calories) AS cals FROM `completed` WHERE userID = '$uid';";
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
                            $qStr = "SELECT weight FROM user WHERE username='$uid';";
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
                $qStr = "SELECT height FROM user WHERE username='$uid';";
                $qRes = $db->query($qStr);
                if ($qRes == FALSE){
                  printSQLError("height");
                }
                else{
                  $row = $qRes->fetch();
                  $height = $row['height'];
                  print "$height";
                }
                ?> inches</h5>

		<div class="card-body">
                	<a href="http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/settings.php">
                 	 <h5 class="card-text">Account Settings</h5>
                	</a>
                	<div class="d-flex justify-content-between align-items-center">

                	</div>
              	</div>
		<form class="" action="logout.php" method="post">
                  <button class="btn btn-outline-danger btn-block" type="submit">Log Out</button>
                </form>
              </div>


            </div>
            <div class="card mb-6 shadow-sm" style="margin-top: 5px;">
              <div class="card-object">
                <h2>Friends
                  <?php
                  $qStr = "SELECT COUNT(A.user2) AS count FROM friend AS A JOIN friend AS B ON A.user1 = B.user2 AND A.user2 = B.user1 WHERE A.user1='$uid';";
                  $qRes = $db->query($qStr);
                  if ($qRes == FALSE) {
                    print "(error)";
                  } else {
                    $row = $qRes->fetch();
                    $count = $row['count'];
                    print "($count)";
                  }
                  ?>
                </h2>
                <?php
                $qStr = "SELECT F1.user1, F1.user2 FROM friend AS F1 JOIN friend AS F2 ON F1.user1 = F2.user2 AND F1.user2 = F2.user1 WHERE F1.user1 = '$uid';";
                $qRes = $db->query($qStr);
                if ($qRes == FALSE) {
                  print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                } else if ($qRes->rowCount() == 0) {
                  print "<H5>You don't have any friends yet :(</H5>";
                } else {
                  while($row = $qRes->fetch()) {
                    $name = $row['user2'];
                    print "<div>";
                    print "<A href= 'http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/profile.php/?user=$name'>";
                    print "<H5 class='card-tex'>$name</H5>";
                    print "</A>";
                    print "</div>";

                  }
                }
                ?>
                <h2> Outgoing Requests: <h2>
                    <?php
                    $qStr = "SELECT * FROM friend WHERE user1 = '$uid' AND user2 NOT IN
                (SELECT F1.user2 FROM friend AS F1
                JOIN friend AS F2
                ON F1.user1 = F2.user2 AND F1.user2 = F2.user1
                WHERE F1.user1 = '$uid');";
                    $qRes = $db->query($qStr);
                    if ($qRes == FALSE) {
                      print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                    } else if ($qRes->rowCount() == 0) {
                      print "<H5>No Requests Sent</H5>";
                    } else {
                      for ($i = 0; $i < 5 && $row = $qRes->fetch(); $i++) {
                        $name = $row['user2'];
                        print "<H5 class='card-tex'>$name</H5>";
                      }
                    }
                    ?>
                    <h2> Incoming Requests: <h2>
                        <?php
                        $qStr = "SELECT * FROM friend WHERE user2 = '$uid' AND user1 NOT IN
                (SELECT F1.user2 FROM friend AS F1
                JOIN friend AS F2
                ON F1.user1 = F2.user2 AND F1.user2 = F2.user1
                WHERE F1.user1 = '$uid');";
                $qRes = $db->query($qStr);
                if($qRes == FALSE){
                  print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                }
                else if($qRes-> rowCount() == 0){
                  print "<H5>No Requests Received</H5>";
                }
                else{
                  for($i = 0; $i < 5 && $row = $qRes->fetch(); $i++){
                    $name = $row['user1'];
                    print "<H5 class='card-tex'>$name</H5>";
                  }
                }
                ?>

                <div>
                  <form action="addFriend.php" method="post">
                    <h5>
                      <input type="text" id ="userFriend" name="userFriend" required>
                    </h5>
                    <button class="btn btn-outline-success btn-block" type="submit">Add Friend</button>
                  </form>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>

  </main>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</body>

</html>

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
      <H1><?php print "Login = " . $uid;?><H1>

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">

          <!-- Programs -->
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <div class="programs">
                <h2>Programs</h2>
              </div>
              <?php
              $qStr = "SELECT name, programID AS id FROM (SELECT DISTINCT programID FROM completed WHERE userID = '$uid' ORDER BY date_time) AS uComp NATURAL JOIN program;";
              $qRes = $db->query($qStr);
              if($qRes == FALSE){
                print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
              }
              else if($qRes-> rowCount() == 0){
                print "<H5>You haven't started any programs yet.</H5>";
              }
              else{
                for($i = 0; $i < 5 && $row = $qRes->fetch(); $i++){
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
            <button class="btn btn-lg btn-primary btn-block" type="submit">Make New Program</button>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Find New Programs</button>
          </div>




          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <div class="programs">
                <h2>Teams</h2>
              </div>
              <div class="card-body">
                <a href="coderswholift.html">
                  <h4 class="card-text">Coders Who Lift</h4>
                </a>
                <div class="d-flex justify-content-between align-items-center">

                </div>
              </div>
              <div class="card-body">
                <a href="gettysburgcyclingclub.html">
                  <h4 class="card-text">Gettysburg Cycling Club</h4>
                </a>
                <div class="d-flex justify-content-between align-items-center">

                </div>
              </div>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Create New Team</button>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Find New Team</button>
          </div>
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <img id="userIcon" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/1024px-Instagram_icon.png" alt="" width="100px" height="100px">
              <div class="programs">
                <h2>Username</h2>
                <h5>Calories Burned: xx</h5>
                <h5>Weight: xx</h5>
              </div>

              <div class="card-body">
                <a href="gainsfornewbies.html">
                  <h5 class="card-text">Account Settings</h5>
                </a>
                <div class="d-flex justify-content-between align-items-center">

                </div>
              </div>

              <div class="logout">
                <form class="" action="logout.php" method="post">
                  <button class="btn btn-lg btn-primary btn-block" type="submit">Log Out</button>
                </form>

              </div>

            </div>
            <div class="card mb-4 shadow-sm">
              <div class="programs">
                <h2>Friends</h2>
                <?php
                $qStr = "SELECT user1, user2 FROM friend WHERE user1 = '$uid';";
                $qRes = $db->query($qStr);
                if($qRes == FALSE){
                  print "<H5>There was a MySQL query error. Please contact one of our developers using our Contact Us page.</H5>";
                }
                else if($qRes-> rowCount() == 0){
                  print "<H5>You don't have any friends yet :(</H5>";
                }
                else{
                  for($i = 0; $i < 5 && $row = $qRes->fetch(); $i++){
                    $name = $row['user2'];
                    print "<H5 class='card-tex'>$name</H5>";
                  }
                }
                ?>
                <div>
                  <form action="addFriend.php" method="post">
                    <input type="text" id ="userFriend" name="userFriend" size="10" style="width: 10px;">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Add Friend</button>
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

<!-- 
Created by: Daegan Wilcox and Ricky Miranda
This is the index.php file which checks to see if a user is 
logged in and either shows the home site if no user is logged 
in, or redirects to the userhome page.

file in sequence as a result of successful action: login.html, signup.html or userhome.php
-->
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
if ($uid != null) {
    header("Location: http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/userhome.php");
}
?>
<!doctype html>
<html lang="en">

<?php include("base.php"); ?>

<body>
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1>Enhance your workout experience</h1>
                <p class="lead text-muted">An advanced, user-friendly workout app that allows gym-goers to pick and choose their favorite programs. Make gains like never before.</p>
                <p>
                    <a href="html/signup.html" class="btn btn-primary my-2">Sign up!</a>
                    <a href="html/login.html" class="btn btn-secondary my-2">Log in</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    <?php
                    $qStr = "SELECT name, description, program.programID AS id, date_created, AVG(rating) AS avg FROM program LEFT JOIN reviews ON program.programID = reviews.programID GROUP BY program.programID ORDER BY AVG(rating) DESC;";
                    $qRes = $db->query($qStr);
                    for ($i = 0; $i < 6 && $row = $qRes->fetch(); $i++) {
                        $name = $row['name'];
                        $date = $row['date_created'];
                        $rating = round($row['avg'], 2);
                        $description = $row['description'];
                        $id = $row['id'];
                        print "<div class='col-md-4'> \r\n";
                        print "<div class='card mb-4 shadow-sm'> \r\n";
                        print "<svg class='bd-placeholder-img card-img-top' width='100%' height='225' xmlns='http://www.w3.org/2000/svg' preserveAspectRatio='xMidYMid slice' focusable='false' role='img' aria-label='Placeholder: Thumbnail'> \r\n";
                        print "<title>Placeholder</title>\r\n";
                        print "<rect width='100%' height='100%' fill='#55595c' /><text x='50%' y='50%' fill='#eceeef' dy='.3em'>$name</text> \r\n";
                        print "</svg> \r\n";
                        print "<div class='card-body'>\r\n";
                        print "<p class='card-text'>$description (This program has a rating of $rating!</p>\r\n";
                        print "<div class='d-flex justify-content-between align-items-center'> \r\n";
                        print "<div class='btn-group'> \r\n";
                        print "<a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/program-view.php/?id=$id'>Try for free!</a> \r\n";
                        print "</div> \r\n";
                        print "<small class='text-muted'>Created: $date</small> \r\n";
                        print "</div>\r\n";
                        print "</div>\r\n";
                        print "</div>\r\n";
                        print "</div>\r\n";
                    }



                    ?>

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
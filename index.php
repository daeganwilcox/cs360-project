<!-- 
Created by: Daegan Wilcox and Ricky Miranda
This is the index.php file which checks to see if a user is 
logged in and either shows the home site if no user is logged 
in, or redirects to the userhome page.

file in sequence as a result of successful action: login.html, signup.html or userhome.php
-->
<?php
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
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Gainz for Newbies</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">A program built for beginners looking to bulk fast.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Try for free!</button>
                                    </div>
                                    <small class="text-muted">Created: Oct 11, 2020</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Gainz for Newbies</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">A program built for beginners looking to bulk fast.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Try for free!</button>
                                    </div>
                                    <small class="text-muted">Created: Oct 11, 2020</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Gainz for Newbies</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">A program built for beginners looking to bulk fast.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Try for free!</button>
                                    </div>
                                    <small class="text-muted">Created: Oct 11, 2020</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Gainz for Newbies</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">A program built for beginners looking to bulk fast.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Try for free!</button>
                                    </div>
                                    <small class="text-muted">Created: Oct 11, 2020</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Gainz for Newbies</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">A program built for beginners looking to bulk fast.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Try for free!</button>
                                    </div>
                                    <small class="text-muted">Created: Oct 11, 2020</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Gainz for Newbies</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">A program built for beginners looking to bulk fast.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Try for free!</button>
                                    </div>
                                    <small class="text-muted">Created: Oct 11, 2020</small>
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
<<?php
include_once("db_connect.php");
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <title>Workout Website</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
  <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
  <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="/css/userhome.css" rel="stylesheet">
</head>

<body>
  <header>
    <div class="collapse bg-dark" id="navbarHeader">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-7 py-4">
            <h4 class="text-white">About</h4>
            <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites
              or contact information.</p>
          </div>
          <div class="col-sm-4 offset-md-1 py-4">
            <h4 class="text-white">Contact</h4>
            <ul class="list-unstyled">
              <li><a href="#" class="text-white">Follow on Twitter</a></li>
              <li><a href="#" class="text-white">Like on Facebook</a></li>
              <li><a href="#" class="text-white">Email me</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container d-flex justify-content-between">
        <a href="#" class="navbar-brand d-flex align-items-center">
          <img src="https://img.icons8.com/windows/32/000000/dumbbell.png" />
          <strong>Workout</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>
  </header>

  <main role="main">
      <H1><?php echo $_SESSION['username'];?><H1>

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">

          <!-- Programs -->
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <div class="programs">
                <h2>Programs</h2>
              </div>
              <div class="card-body">
                <a href="momcardio.html">
                  <h4 class="card-text">Mom Cardio</h4>
                </a>
                <div class="d-flex justify-content-between align-items-center">

                </div>
              </div>
              <div class="card-body">
                <a href="gainsfornewbies.html">
                  <h4 class="card-text">Gainz for Newbies</h4>
                </a>
                <div class="d-flex justify-content-between align-items-center">

                </div>
              </div>
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

            </div>
            <div class="card mb-4 shadow-sm">
              <div class="programs">
                <h2>Friends</h2>
                <h5>superkingjunior</h5>
                <h5>skim</h5>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Add Friend</button>
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
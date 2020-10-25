<!DOCTYPE html>
<HTML>
<BODY>
<?php
include_once ("db_connect.php");
?>

<HTML>
<HEAD><TITLE>Signup Attempt</TITLE></HEAD>
<BODY>

<?php
include ("login-signup-utils.php");

$missing = FALSE;

foreach ($x as $key => $_POST) {
  if($x == ""){
    $missing = TRUE;
  }
}

if($missing){
  print "<H2>Invalid Form</H2>";
  print "<p>You did not fill out all required fields. Please try signing up again using <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/signup.html'>this</a> link.</p></p>";
}

$res = registerUser($db, $_POST);

  //$res = true;

if($res){ //page if registration successful:
  print "<H2>New Account Created</H2>";
  print "<p>Your account has been successfully created and a verification email have been sent to your email address. Please verify your email, then log in using <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>this</a> link.</p>";
}
else{ //page if registration unsuccessful:
  print "<H2>Account already exists!</H2>";
  print "<p>The login you entered already exists. Try logging in <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>here</a>, or try signing up with a different login <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/signup.html'>here</a>.</p>";
}
?>
</BODY>
</HTML>

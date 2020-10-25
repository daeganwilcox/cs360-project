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
print_r($_POST);
print("\n");
$input = $_POST;
$login = $input['inputUsername'];
$pass = $input['inputPassword'];
$fname = $input['inputFName'];
$lname = $input['inputLName'];
$email = $input['inputEmail'];
$dob = $input['inputDOB'];
$height = $input['inputHeight'];
$weight = $input['inputWeight'];
$res = addUser($db, $login, $pass, $fname, $lname, $email, $dob, $height, $weight);
print($res);
/*
$res = registerUser($db, $_POST);

  //$res = true;

if($res){ //page if registration successful:
  print "<H2>New Account Created</H2>";
  print "<p>Your account has been successfully created and a verification email have been sent to your email address. Please verify your email, then log in using <a href='http://wilcda01-workout-app.herokuapp.com/html/login.html'>this</a> link.</p>";
}
else{ //page if registration unsuccessful:
  print "<H2>Account already exists!</H2>";
  print "<p>The login you entered already exists. Try logging in <a href='http://wilcda01-workout-app.herokuapp.com/html/login.html'>here</a>, or try signing up with a different login <a href='http://wilcda01-workout-app.herokuapp.com/html/signup.html'>here</a>.</p>";
}
*/
?>
</BODY>
</HTML>

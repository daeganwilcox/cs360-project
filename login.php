<!DOCTYPE html>
<HTML>
<BODY>
<?php
include_once ("db_connect.php");
include ("login-signup-utils.php");
?>

<HTML>
<HEAD><TITLE>Login Attempt</TITLE></HEAD>
<BODY>

<?php
$login = $_POST['inputUsername'];
$pass = $_POST['inputPassword'];
print($pass);
print(md5($pass));
$checkRes = checkUser($db, $login, $pass);
switch($checkRes){
  case 1: //page if the login was successful
  print "<H2>Successfully logged in!</H2>";
  print "<p>Congratulations! You can now access this site which does absolutely nothing!</p>";
  print "<p>Give yourself a pat on the back for enduring the rigors of account registration to make it to this point.</p>";
  print "<p>If you want to go through this experience again, why not <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/signup.html'>make another account</a>!</p>";
  break;

  case -1: //page if the login does not exist in the db
  print "<H2>Invalid Login</H2>";
  print "<p>Sign up <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/signup.html'>here</a>, or return to the login screen by clicking <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>this</a>.</p>";
  break;

  case -2: //page if the account has not been verified
  print "<H2>Account not verified!</H2>";
  print "<p>Please check your email to verify your account.</p>";
  break;

  case -3: //page if the password was wrong
  print "<H2>Invalid Password</H2>";
  print "<p>Please try logging in again <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>here</a>.</p>";
  break;

  case -4: //page if SQL query failed
  print "<H2>SQL Query Failed</H2>";
  print "<p>Unfortunately, something has gone wrong with our SQL query. Please contact one of our developers by using our Contact Us page.</p>";
  break;
}
?>
</BODY>
</HTML>

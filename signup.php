<!DOCTYPE html>
<HTML>
<BODY>
<?php
include_once ("../db_connect.php");
include ("login-signup-utils.php");
?>

<HTML>
<HEAD><TITLE>Signup Attempt</TITLE></HEAD>
<BODY>

<?php
$res = registerUser($db, $_POST);

if($res){ //page if registration successful:
  print "<H2>New Account Created</H2>";
  print "<p>Your account has been successfully created and a verification email have been sent to your email address. Please verify your email, then log in using <a href='login.html'>this</a> link.</p>"; //TODO change login link
}
else{ //page if registration unsuccessful:
  print "<H2>Account already exists!</H2>";
  print "<p>The login you entered already exists. Try logging in <a href='login.html'>here</a>, or try signing up with a different login <a href='signup.html'>here</a>.</p>"; //TODO change login and signup link
}

?>
</BODY>
</HTML>

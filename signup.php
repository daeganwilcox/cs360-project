<!-- 
Created by: Collin Presser
This is the action page that attempts to sign a user up. 
If successful, the user will be sent a verification 
email in order to confirm their account. Currently, 
verification emails are only sent to @gettysburg.edu 
domains. 

file in sequence as a result of successful action: verify.php
-->
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
include ("base.php");

$res = registerUser($db, $_POST);

  //$res = true;

if($res){ //page if registration successful:
  print "<div style='margin: auto; text-align: center; width: 80%;'>";
  print "<H2>New Account Created</H2>";
  print "<p>Your account has been successfully created and a verification email have been sent to your email address. Please verify your email, then log in using <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>this</a> link.</p>";
  print "</div>";
}
else{ //page if registration unsuccessful:
  print "<div style='margin: auto; text-align: center; width: 80%;'>";
  print "<H2>Account already exists!</H2>";
  print "<p>The login you entered already exists. Try logging in <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>here</a>, or try signing up with a different login <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/signup.html'>here</a>.</p>";
  print "</div>";
}
?>
</BODY>
</HTML>

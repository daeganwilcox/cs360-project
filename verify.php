<!-- 
Created by: Collin Presser
This is the action page that attempts to log a user in. 
If successful, the user will be redirected accordingly, 
otherwise, a notification will be printed describing
the issue that was encountered. 

file in sequence as a result of successful action: login.html
-->

<!DOCTYPE html>
<HTML>
<BODY>
<?php
include_once ("db_connect.php");
include ("login-signup-utils.php");
?>

<HTML>
<HEAD><TITLE>Email Verification</TITLE></HEAD>
<BODY>

<?php
$login = $_GET['login'];
$res = verifyEmail($db, $login);
if($res){//verified page
  print "<H2>Email Verified</H2>";
  print "<p>The email for your account has been successfully verified. Click <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>here</a> to login to your account</p>";
}
else{//unverified page
  print "<H2>Email Verification Error</H2>";
  print "<p>An error has occurred while processing your request. If you have already verified your account, use <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/login.html'>this</a> link to login. Otherwise, try to signup using <a href='http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/html/signup.html'>this</a> link.</p>";
}
?>
</BODY>
</HTML>

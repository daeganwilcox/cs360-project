<!-- HTML components: form, input, text field, text area -->
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
?>

<?php 

   include("base.php"); 
       
   print "<container>";
   print "<div style='text-align: center; margin: auto;'>";
   print "<H2>Contact us!</H2>";
   print "<FORM name='fmMail' method='POST' action='contactAction.php'>";
   print "Name: <INPUT style='width: 50%; margin: auto;' type='text' name='tfName' size='30' placeholder='Enter your name' /><BR /><BR />";
   print "Email: <INPUT style='width: 50%; margin: auto;' type='email' name='tfEmail' size='30' placeholder='Enter your email' /><BR /><BR />";
   print "Message:";
   print "<TEXTAREA name='taContent' rows='5' cols='60'> </TEXTAREA>";    
   print "<button class='btn btn-lg btn-primary btn-block' style='width: 50%; margin: auto; margin-top: 5px;'type='submit'>Email Us!</button>";
   print "</FORM>";
   print "</div>";
   print "</container>";
       
       
       
       
       
?>


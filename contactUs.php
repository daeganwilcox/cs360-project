<!-- HTML components: form, input, text field, text area -->
<?php
include_once("db_connect.php");
session_start();
$uid = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">

<?php include("base.php"); ?>

<BODY>
<H2>Contact us!</H2>

<FORM name='fmMail' method='POST' action='contactAction.php'>
<INPUT type='text' name='tfName' size='30'
       placeholder='Enter your name' /><BR /><BR />
<INPUT type='text' name='tfEmail' size='30'
       placeholder='Enter your email' /><BR /><BR />

Content: <BR />
<TEXTAREA name='taContent' rows='5' cols='60'> </TEXTAREA>
<BR />
<BR />

<INPUT type='submit' value='Email us!' />
</FORM>

</BODY>
</HTML>

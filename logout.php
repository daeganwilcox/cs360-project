<!-- 
Created by: Collin Presser
A function that allows the user to 
log out of the current session and is 
redirected to the index page.

file in sequence as a result of successful action: index.php
-->
<<?php
session_start();
session_unset();
session_destroy();
header("Location: http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/"); //redirects to original page
?>

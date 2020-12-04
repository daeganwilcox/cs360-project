<!-- 
Created by: Daegan Wilcox and Ricky Miranda
This is the index.php file which checks to see if a user is 
logged in and either shows the home site if no user is logged 
in, or redirects to the userhome page.

file in sequence as a result of successful action: userhome.php
-->
<?php
session_start();
$uid = $_SESSION['username'];
if ($uid != null){
    header("Location: http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/userhome.php");
}
include_once("html/index.html");
?>

<?php
session_start();
$uid = $_SESSION['username'];
if ($uid != null){
    header("Location: http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/userhome.php");
}
include_once("html/index.html");
?>

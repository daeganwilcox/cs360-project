<<?php
session_start();
session_unset();
session_destroy();
header("Location: http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/index.php"); //redirects to original page
?>

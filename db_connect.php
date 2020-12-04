<!-- 
Created by: Collin Presser
connects the current session to the database on MYSQL
-->
<?php

$host = "ada.cc.gettysburg.edu";
$dbase = "f20_4";
$user = "presco01";
$pass = "presco01";

try{
  $db = new PDO("mysql:host=$host;dbname=$dbase", $user, $pass);
}
catch (PDOException $e){
  die("ERROR connecting to MySQL database " . $e->getMessage());
}

?>

<?php

include_once ("db_connect.php");

//Checks the user to see if they exist already/if they are unverified/if their password is wrong/or if everything is good
function checkUser($db, $login, $pass){

  $qRes = $db->query("SELECT * FROM user LEFT JOIN unverified ON username = ulogin WHERE username = '$login'");

  if($qRes == FALSE){
    return -4; //SQL Error Has Occurred
  }

  return -4;

  if($qRes.rowCount() == 0){ //non-existent account
    return -1;
  }

  $userRow = $qRes->fetch();

  if($userRow['ulogin'] != NULL){//unverified account
    return -2;
  }
  if($userRow['pHash'] != md5($pass)){//wrong password
    return -3;
  }
  return 1; //user confirmed and verified
}

//adds a new user to the database
function addUser($db, $login, $pass, $fname, $lname, $email, $dob, $height, $weight){
  $hash = md5($pass);

  $q = $db->query("INSERT INTO user VALUE('$login', '$hash', '$fname', '$lname', '$email', '$dob', '$height', '$weight');");

  if($q == FALSE){
    return FALSE;
  }

  $q = $db->query("INSERT INTO unverified VALUE('$login');");

  if($q == FALSE){
    return FALSE;
  }
  else{
    return TRUE;
  }
}

//registers a new user to the database if it is possible to do so
function registerUser($db, $input){
  //get attributes:
  $login = $input['inputUsername'];
  $pass = $input['inputPassword'];
  $fname = $input['inputFName'];
  $lname = $input['inputLName'];
  $email = $input['inputEmail'];
  $dob = $input['inputDOB'];
  $height = $input['inputHeight'];
  $weight = $input['inputWeight'];

  if(checkUser($db, $login, $pass) != -1){ //uses checkUser to make sure the account does not exist (which is error response -1)
    return FALSE;
  }
  $res = addUser($db, $login, $pass, $fname, $lname, $email, $dob, $height, $weight); //adds user

  if(!$res){
    return FALSE;
  }

  $url = "http://www.cs.gettysburg.edu/~mirari01/cs360project/cs360-project/verify.php/?login='$login'";

  $subject = "Verify Account Registration";
  $message = "<HTML><HEAD><TITLE>Account Verfication</TITLE></HEAD><BODY>Hello $login,<BR />Please verify your email for our fitness site by clicking on <a href='$url'>this</a> link.</BODY></HTML>";

  //This part allows the email to be in HTML:
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  $headers .= "From: Fitness Site <notARealEmail@gettysburg.edu>" . "\r\n";

  mail($email, $subject, $message, $headers); //sends the email

  return TRUE;
}

//verifies the user's email
function verifyEmail($db, $userLogin){
  $checkRes = $db->query("SELECT * FROM unverified WHERE ulogin = '$userLogin';"); //checks login

  if($checkRes == FALSE || $checkRes->rowCount() == 0){ //if the query is empty or invalid, then the account can't be verified
    return FALSE;
  }

  $res = $db->query("DELETE FROM unverified WHERE ulogin = '$userLogin';");

  if($res == FALSE){
    return FALSE;
  }

  return TRUE;
}

?>

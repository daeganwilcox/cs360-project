<?php

include_once ("db_connect.php");

function checkUser($db, $login, $pass){

  $qRes = $db->query("SELECT * FROM user LEFT JOIN unverified ON username = ulogin");
  $userRow = NULL;

  if($qRes != FALSE) {
    while($userRow == NULL && $row = $qRes->fetch()){
      if($row['username'] == $login){
        $userRow = $row;
      }
    }
  }
  if($userRow == NULL){ //non-existent account
    return -1;
  }
  if($userRow['ulogin'] != NULL){//unverified account
    return -2;
  }
  if($userRow['pHash'] != md5($pass)){//wrong password
    return -3;
  }
  return 1; //user confirmed and verified
}

function addUser($db, $login, $pass, $fname, $lname, $email, $dob, $height, $weight){
  $hash = md5($pass);

  $db->query("INSERT INTO user VALUE('$login', '$hash', '$fname', '$lname', '$email', '$dob', '$height', '$weight');");

  $db->query("INSERT INTO unverified VALUE('$login');");
}

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
  addUser($db, $login, $pass, $fname, $lname, $email, $dob, $height, $weight); //adds user

  $url = "TODO"; //TODO: PUT IN VERIFY URL HERE

  $subject = "Verify Account Registration";
  $message = "<HTML><HEAD><TITLE>Account Verfication</TITLE></HEAD><BODY>Hello $login,<BR />Please verify your email for our fitness site by clicking on <a href='$url'>this</a> link.</BODY></HTML>";

  //This part allows the email to be in HTML:
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  $headers .= "From: Fitness Site <DO NOT REPLY!>" . "\r\n";

  mail($email, $subject, $message, $headers); //sends the email

  return TRUE;
}

function verifyEmail($db, $userLogin){
  $checkRes = $db->query("SELECT * FROM unverified WHERE ulogin = '$userLogin';"); //checks login

  if($checkRes->rowCount() == 0){ //if the query is empty, then the account can't be verified
    return FALSE;
  }

  $db->query("DELETE FROM unverified WHERE ulogin = '$userLogin';");

  return TRUE;
}

?>

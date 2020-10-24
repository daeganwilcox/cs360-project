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

?>

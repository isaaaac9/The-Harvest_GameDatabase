<?php
  $con = mysqli_connect('localhost', 'root', '', 'unity backend');

  if(mysqli_connect_errno())
  {
    echo "1: Connect failed"; //error code  1 
    exit(); 
  }
  $username = $_POST["Username"];
  $password = $_POST["Password"];

  $namecheckquery = "SELECT username,hash, salt FROM users WHERE username = '". $username . "'";
  $namecheck = mysqli_query($con, $namecheckquery) or die("2:Name check query failed"); //error code 2 namecheck
  if (mysqli_num_rows($namecheck) != 1  )
  {
    echo "5: Either no user with name, ot more than one"; //error 3 name exit
    exit();
  }

  $existinginfo  = mysqli_fetch_assoc($namecheck);
  $salt = $logininfo["salt"];
  $hash = $logininfo["hash"];

  $loginhash = crypt($loginPass, $salt);
  if($hash != $loginhash)
  {
    echo "6: Incorrect Password";
    exit(); 

  }
  echo "0\t" .$existinginfo["score"];

?>
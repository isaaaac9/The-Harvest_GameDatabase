<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unity backend";

//Variables submited by user
$loginUser = $_POST["loginUser"];
$loginPass = $_POST["loginPass"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully show user <br> " ;

$sql = "SELECT username FROM users WHERE username = '". $loginUser . "'";

$result = $conn->query($sql);

$salt = "\$5\$rounds=5000\$" . "steamedhams" . $loginUser . "\$";
$hash = crypt($loginPass, $salt);

if ($result->num_rows > 0) {
   // tell user that name already taken
   echo "Username is already taken.";

  
    
} else {
  echo "Create user...";
  //Insert user and password into the database 
  $sql2 = "INSERT INTO users (username, hash, password, salt) VALUES ('". $loginUser . "', '" . $hash . "' , '" . $loginPass . "', '" . $salt . "')";
  if ($conn->query($sql2) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }

}


$conn->close();





?>


<?php
  $con = mysqli_connect('localhost', 'root', 'root', 'unity backend');

  if(mysqli_connect_errno())
  {
    echo "1"; //error code  1 
    exit(); 
  }
  $username = $_POST["Username"];
  $password = $_POST["Passwrod"];

  $namecheckquery = "SELECT username FROM users WHERE username = '". $username . "'";
  $namecheck = mysqli_query($con, $namecheckquery) or die("2"); //error code 2 namecheck
  if (mysqli_num_rows($namecheck) > 0 )
  {
    echo "3: Name already exist"; //error 3 name exit
    exit();
  }

  $salt = "\$5\$rounds=5000\$" . "steamedhams" . $username . "\$";
  $hash = crypt($password, $salt);
  $insertquery = "INSERT INTO users (username, hash, password, salt) VALUES ('". $username . "', '" . $hash . "' , '" . $password . "', '" . $salt . "')";
  mysqli_query($con, $insertquery) or die("4: insert player query failed "); //error 4 insert query failed
  echo("0");
    
?>
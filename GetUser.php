<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unity backend";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully show user <br> " ;

$sql = "SELECT username, score FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "username: " . $row["username"]. " - score: " . $row["score"].  "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();

?>
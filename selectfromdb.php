<?php
$servername = "localhost";
$username = "cybr_hun7r";
$password = "fuckoff";
$dbname = "phpTest";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection faild: " . $conn->connect_error);
}
echo "Connection Successfull <br>";




// insert data  

$sql = "SELECT id, firstname, lastname FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();

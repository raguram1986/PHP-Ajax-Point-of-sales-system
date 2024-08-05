<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO record (firstname,lastname)
VALUES ('John', 'example')";

if ($conn->query($sql) === TRUE) {
  echo  $last_id = $conn->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
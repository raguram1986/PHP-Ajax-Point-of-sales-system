<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $stmt = $conn->prepare("INSERT INTO brand (brand_name,status)
    VALUES (?,?)");
    $stmt->bind_param("ss",$brand_name,$status);

    $brand_name = $_POST["brandname"];
    $status= $_POST["status"];


    if ($stmt->execute()) {

        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();

}

?>
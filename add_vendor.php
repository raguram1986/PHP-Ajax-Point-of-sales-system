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

    $stmt = $conn->prepare("INSERT INTO vendor (vname,contactno,email,address,status)
    VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss",$vanme,$contactno,$email,$address,$status);

    $vanme = $_POST["vendorName"];
    $contactno= $_POST["contactno"];
    $email = $_POST["email"];
    $address= $_POST["address"];
    $status= $_POST["status"];






    if ($stmt->execute()) {

        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();

}

?>
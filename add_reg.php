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

    $stmt = $conn->prepare("INSERT INTO product (p_name,p_description,cat_id,brand_id,warranty,cost_price,retail_price,reorderlevel,barcode,add_date,status)
    VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssss", $p_name,$p_description,$cat_id,$brand_id,$warranty,$cost_price,$retail_price,$reorderlevel,$barcode,$add_date,$status);

    $p_name = $_POST["productname"];
    $p_description= $_POST["productdescription"];
    $cat_id = $_POST["category"];
    $brand_id= $_POST["brand"];
    $warranty = $_POST["warranty"];
    $cost_price= $_POST["costprice"];
    $retail_price = $_POST["retailprice"];

    $reorderlevel = $_POST["reorderlevel"];
    $barcode= $_POST["barcode"];
    $add_date = $_POST["start_date"];
    $status = $_POST["status"];

    if ($stmt->execute()) {

        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();

}

?>
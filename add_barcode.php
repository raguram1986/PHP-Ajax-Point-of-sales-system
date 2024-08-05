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

    $stmt = $conn->prepare("INSERT INTO discount (barcode_id,product_name,price,discount_name,discount_type,amount,cal_amount)
    VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss",$barcode_id,$productname,$price,$discount_name,$discount_type,$amount,$cal_amount);

    $barcode_id = $_POST["barcode"];
    $productname = $_POST["productname"];
    $price = $_POST["price"];
    $discount_name= $_POST["discountname"];
    $discount_type = $_POST["discount"];
    $amount= $_POST["amount"];
    $cal_amount= $_POST["calamount"];
    if ($stmt->execute()) {
        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();

}

?>
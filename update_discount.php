<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include("db.php");
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $stmt = $conn->prepare("Update discount set discount_name=?, discount_type=? ,amount=?  ,cal_amount=?  where id=?");


    $stmt->bind_param("sssss", $discount_name, $discount_type,$amount,$cal_amount, $project_id);

    $discount_name = $_POST["discountname"];
    $discount_type = $_POST["discount"];
    $amount = $_POST["amount"];
    $cal_amount = $_POST["calamount"];
    $project_id = $_POST["project_id"];



    if ($stmt->execute()) {

        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();

}


?>
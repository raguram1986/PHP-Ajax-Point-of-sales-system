<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

include("db.php");
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $stmt = $conn->prepare("Update product set p_name=?, p_description=? ,cat_id=?, brand_id=? , warranty=?, cost_price=? ,retail_price=?, reorderlevel=? ,barcode=?, add_date=?,status=? where id=?");


    $stmt->bind_param("ssssssssssss", $p_name, $p_description,$cat_id,$brand_id ,$warranty,$cost_price, $retail_price,$reorderlevel,$barcode,$add_date,$status, $project_id);

    $p_name = $_POST["productname"];
    $p_description = $_POST["productdescription"];
    $cat_id = $_POST["category"];
    $brand_id = $_POST["brand"];
    $warranty = $_POST["warranty"];
    $cost_price = $_POST["costprice"];
    $retail_price = $_POST["retailprice"];
    $reorderlevel = $_POST["reorderlevel"];
    $barcode = $_POST["barcode"];
    $add_date = $_POST["start_date"];
    $status = $_POST["status"];
    $project_id = $_POST["project_id"];



    if ($stmt->execute()) {

        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();

}


?>
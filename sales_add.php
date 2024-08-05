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
    $relative_list = $_POST['data'];
    $stmt = $conn->prepare("INSERT INTO sales(date,subtotal,discount_toal,grand_total,pay,balance,payment_type)
    VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss",$date,$subtotal,$discount_toal,$grand_total,$pay,$balance,$payment_type);

    $datecurrect = date("Y/m/d");
    $date = $datecurrect;
    $subtotal= $_POST["total"];
    $discount_toal= $_POST["discounttotal"];
    $grand_total= $_POST["grandtotal"];
    $pay= $_POST["pay"];
    $balance = $_POST["balance"];
    $payment_type = $_POST["payment"];

    if ($stmt->execute()) {
        $last_id = $conn->insert_id;
    } else {
    }
    for($x = 0; $x < count($relative_list); $x++)
    {
        $product_id= $relative_list[$x]['barcode'];
        $qty= $relative_list[$x]['qty'];

        $stmt2 = $conn->prepare("Update product set qty =qty-? where barcode=?");
        $stmt2->bind_param("ss", $qty,$product_id);
        if ($stmt2->execute()) {

           // echo 1;
        } else {
           // echo 0;
        }


        $stm = $conn->prepare("INSERT INTO sales_product(sales_id,product_id,price,qty,discount,total)
          VALUES (?,?,?,?,?,?)");
        $stm->bind_param("iiiiii",$last_id,$product_id,$price,$qty,$discount,$total);
        $product_id= $relative_list[$x]['barcode'];
        $price= $relative_list[$x]['pro_price'];
        $qty= $relative_list[$x]['qty'];
        $discount= $relative_list[$x]['discount'];
        $total= $relative_list[$x]['total_cost'];
        if ($stm->execute()) {
            //  echo 1;


        }
        else {
            echo $conn->error;
        }

        $stm->close();
        $stmt2->close();
    }
    echo json_encode(array ("last_id"=>$last_id));
    $stmt->close();
}
?>
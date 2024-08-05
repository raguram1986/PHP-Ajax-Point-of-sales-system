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

    $stmt = $conn->prepare("INSERT INTO purs(vendor_id,date,total,pay,due,payment_type)
    VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss",$vendor_id,$date,$total,$pay,$due,$payment_type);

    $datecurrect = date("Y-m-d");
    $vendor_id = $_POST["vendor"];
    $date = $datecurrect;
    $total= $_POST["total"];
    $pay= $_POST["pay"];
    $due= $_POST["due"];
    $payment_type = $_POST["payment"];






    if ($stmt->execute()) {
    //    echo 1;
        $last_id = $conn->insert_id;
    } else {

    }
    for($x = 0; $x < count($relative_list); $x++)
    {

        $prod_id= $relative_list[$x]['barcode'];
        $qty= $relative_list[$x]['qty'];

        $stmt2 = $conn->prepare("Update product set qty =qty+? where barcode=?");
        $stmt2->bind_param("ss", $qty,$prod_id);
        if ($stmt2->execute()) {

            // echo 1;
        } else {
            // echo 0;
        }


        $stm = $conn->prepare("INSERT INTO purchase_item(pur_id,prod_id,buyprice,qty,total)
          VALUES (?,?,?,?,?)");
        $stm->bind_param("issss",$last_id,$prod_id,$buyprice,$qty,$total);
        $prod_id= $relative_list[$x]['barcode'];
        $buyprice= $relative_list[$x]['pro_price'];
        $qty= $relative_list[$x]['qty'];
        $total= $relative_list[$x]['total_cost'];
        if ($stm->execute()) {
         //   echo 1;

        }
        else {
            echo $conn->error;
        }

        $stm->close();
}
    echo json_encode(array ("last_id"=>$last_id));
    $stmt->close();
}
?>
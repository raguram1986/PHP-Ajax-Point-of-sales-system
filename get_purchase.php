<?php
include("db.php");

$stmt = $conn->prepare("select p.id,p.p_name,p.retail_price,i.qty,d.amount from product p join purchase_item i on p.barcode = i.prod_id join discount d on i.prod_id = d.barcode_id where p.barcode = ?");

$barcode= $_POST["barcode"];
$stmt->bind_param("s", $barcode);
$stmt->bind_result($id,$p_name,$retail_price,$qty,$amount);

if ($stmt->execute()) {

    while ( $stmt->fetch() ) {
        $output[] = array ("id"=>$id, "p_name"=>$p_name,"retail_price"=>$retail_price ,"qty"=>$qty,"amount"=>$amount);
    }

    echo json_encode($output);
}
$stmt->close();



?>




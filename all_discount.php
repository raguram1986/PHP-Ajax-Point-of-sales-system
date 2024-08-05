<?php
include("db.php");

$stmt = $conn->prepare("select id,barcode_id,product_name,price,discount_name,discount_type,amount,cal_amount from discount order by id DESC ");
$stmt->bind_result($id,$barcode_id,$product_name,$price,$discount_name,$discount_type,$amount,$cal_amount);

if ($stmt->execute()) {
    while ( $stmt->fetch() ) {
        $output[] = array ("id"=>$id,"barcode_id"=>$barcode_id,"product_name"=>$product_name,"price"=>$price, "discount_name"=>$discount_name,"discount_type"=>$discount_type,"amount"=>$amount,"cal_amount"=>$cal_amount);
    }

    echo json_encode( $output );
}
$stmt->close();

//}



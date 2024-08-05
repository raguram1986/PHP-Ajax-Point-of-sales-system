<?php

include("db.php");

$stmt = $conn->prepare("select v.vname,p.id,p.date,p.total,p.pay,p.due,p.payment_type from purs p, vendor v WHERE p.vendor_id = v.id and p.id = ?");
$invoice= $_POST["invoice"];
$stmt->bind_param("s", $invoice);
$stmt->bind_result($vendor_id,$id,$date,$total,$pay,$due,$payment_type);

if ($stmt->execute()) {
    while ( $stmt->fetch() ) {
        $output[] = array("vendor_id" => $vendor_id,"invoice" => $id, "date" => $date, "total" => $total, "pay" => $pay, "due" => $due, "payment_type" => $payment_type);
    }
    echo json_encode($output);
}
$stmt->close();


?>
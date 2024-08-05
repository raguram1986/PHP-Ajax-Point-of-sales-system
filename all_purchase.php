<?php


include("db.php");



if(isset($_POST["from_date"], $_POST["to_date"])){

    $fdate = $_POST["from_date"];
    $todate = $_POST["to_date"];

  //  $stmt = $conn->prepare("SELECT v.vname,p.id,p.date,p.total,p.pay,p.due,p.payment_type FROM purs p INNER JOIN vendor v ON p.vendor_id = v.id AND p.date BETWEEN'" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "' ");

    $stmt = $conn->prepare("select v.vname,p.id,p.date,p.total,p.pay,p.due,p.payment_type from purs p, vendor v WHERE p.vendor_id = v.id and  p.date BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "' ");
    $stmt->bind_result($vendor_id,$id,$date,$total,$pay,$due,$payment_type);

    if ($stmt->execute()) {
        while ($stmt->fetch()) {
            $output[] = array("vendor_id" => $vendor_id,"Invoice_id" => $id, "date" => $date, "total" => $total, "pay" => $pay, "due" => $due, "payment_type" => $payment_type);
        }

        echo json_encode($output);
    }
    $stmt->close();
}



//}
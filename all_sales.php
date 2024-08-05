<?php

include("db.php");
if(isset($_POST["from_date"], $_POST["to_date"]))
{

    $fdate = $_POST["from_date"];
    $todate = $_POST["to_date"];

    $stmt = $conn->prepare("select id,date,subtotal,discount_toal,grand_total,pay,balance from sales WHERE date BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "' ");
    $stmt->bind_result($id,$date,$subtotal,$discount_toal,$grand_total,$pay,$balance);

    if ($stmt->execute()) {
        while ($stmt->fetch()) {
            $output[] = array("id" => $id,"date" => $date, "subtotal" => $subtotal, "discount_toal" => $discount_toal, "grand_total" => $grand_total, "pay" => $pay, "balance" => $balance);
        }

        echo json_encode($output);
    }
    $stmt->close();

}


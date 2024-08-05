<?php
/**
 * Created by PhpStorm.
 * User: Virtualmist
 * Date: 9/24/2017
 * Time: 5:33 PM
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include("db.php");

    $stmt = $conn->prepare("update purs set due=? where id=?");
    $stmt->bind_param("ss",  $amount,$invoiceno);

     $invoiceno= $_POST["invoice"];
    $due= $_POST["due"];
    $payamount= $_POST["payamount"];
    $amount= $due - $payamount;

    if ($stmt->execute()) {

        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();

}
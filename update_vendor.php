<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include("db.php");
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $stmt = $conn->prepare("Update vendor set vname=?, contactno=? ,email=?, address=? , status=? where id=?");


    $stmt->bind_param("ssssss", $vname, $contactno,$email,$address ,$status, $project_id);

    $vname = $_POST["vendorName"];
    $contactno = $_POST["contactno"];
    $email = $_POST["email"];
    $address = $_POST["address"];
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
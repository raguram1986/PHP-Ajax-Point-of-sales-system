<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "upos";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $stmt = $conn->prepare("Update category set catname=?, status=? where id=?");
    $stmt->bind_param("sss", $catname, $status,$project_id);

    $catname = $_POST["categoryname"];
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
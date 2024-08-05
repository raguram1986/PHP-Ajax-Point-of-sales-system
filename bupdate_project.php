<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "upos";

//$servername = "innovationlk.ipagemysql.com";
//$username = "cta_db";
//$password = "zM;(~dR6qy>fnN3}";
//$dbname = "cta_db";


// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);







    $stmt = $conn->prepare("Update brand set brand_name=?, status=? where id=?");


    $stmt->bind_param("sss", $brand_name, $status,$project_id);

    $brand_name = $_POST["brandname"];
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
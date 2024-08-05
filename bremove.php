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




    $stmt = $conn->prepare("delete from brand where id=?");
    $stmt->bind_param("s", $id);

    $id = $_POST["id"];

    if ($stmt->execute()) {

        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();

}
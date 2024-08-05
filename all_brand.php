<?php
include("db.php");
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("select id,brand_name,status from brand order by id DESC ");
$stmt->bind_result($id,$brand_name,$status);

if ($stmt->execute()) {
    while ( $stmt->fetch() ) {
        $output[] = array ("id"=>$id, "brand_name"=>$brand_name,"status"=>$status);
    }

    echo json_encode( $output );
}
$stmt->close();

//}